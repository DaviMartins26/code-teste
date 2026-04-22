<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patient;

use Carbon\Carbon;

use App\Models\Appointment; // para botão de agendamento

class SiteController extends Controller {

    public function getIndex(Request $request) {
		return view('index');
	}

	// ------------------ Cliente ------------------
	public function getClient(Request $request) {
		return view('client');
	}

	public function getEditPatient($patient_id = null) {
		$user = auth()->User();
		if (!$patient_id) {
			$patient = Patient::where([ 'user_id' => $user->id, 'name' => null ])->first();

			if (!$patient) {
				$patient = Patient::create([ 'user_id' => $user->id ]);
			}

			return redirect()->route('client.edit-patient', $patient->id);
		}
		else {
			$patient = Patient::where([ 'id' => $patient_id ])->first();
		}

		return view('edit-patient', [ 'patient' => $patient ]);
	}

	public function postEditPatient($patient_id, Request $request) {
    $patient = Patient::find($patient_id);
    
    // Coleta os dados, exceto a data que precisa de tratamento
    $data = array_merge($request->except('birthdate'), [ 
        'birthdate' => \Carbon\Carbon::createFromFormat('d/m/Y', $request->birthdate) 
    ]);

    // Lógica da Foto
	if ($request->hasFile('image')) {
		$file = $request->file('image');
		
		// Gera um nome único: ex: 1619100000_bob.jpg
		$filename = time() . '_' . $file->getClientOriginalName();
		
		// Caminho físico direto na pasta public: public/img/patients
		$publicPath = public_path('img/patients');

		// Garante que a pasta existe, senão cria
		if (!file_exists($publicPath)) {
			mkdir($publicPath, 0755, true);
		}

		// Move o arquivo fisicamente para public/img/patients
		$file->move($publicPath, $filename);
		
		// Salva o caminho relativo no banco: 'img/patients/1619100000_bob.jpg'
		$data['image'] = 'img/patients/' . $filename;
	}

    $patient->update($data);

    return redirect()->route('client')->with('toast', 'Paciente salvo com sucesso.');
}

	public function getRemovePatient($patient_id) {
		$patient = Patient::find($patient_id);
		$patient->delete();

		return redirect()->route('client')->with('toast', 'Paciente removido com sucesso.');
	}

	public function getAppointment($appointment_id) {
    // Busca a consulta com os dados do paciente, do dono (user) e do veterinário (vet)
    $appointment = Appointment::with(['patient', 'user', 'vet'])->findOrFail($appointment_id);

    return view('client.view-appointment', compact('appointment'));
}

	public function getCreateAppointment() {
		return view('create-appointment');
	}

	public function postCreateAppointment(Request $request) {
		//Pegamos o ID do pet (patient_id) e a data que vem da View
   		 $request->validate([
			'patient' => 'required',
			'date' => 'required',
			'time' => 'required',
		 ]);

		//juntando a data com horario pq estão separados 
		$dateTimeString = $request->date . ' ' . $request->time;
    	$dateTime = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $dateTimeString);

		// Criando o agendamento
		\App\Models\Appointment::create([
        'user_id' => auth()->id(),
        'patient_id' => $request->patient, // O nome no select é 'patient'
        'date' => $dateTime,
        'status' => 'pending',
    	'notes' => null // Notas o veterinario preenche depois
		]);

		return redirect()->route('client')->with('toast', 'Consulta agendada com sucesso!');
	}

	// ------------------ Veterinário ------------------
	public function getVet() {
    // Busca todas as consultas agendadas
    	$appointments = Appointment::with('patient', 'user')->orderBy('date', 'asc')->get();
    
    	return view('vet', compact('appointments'));  // remoção do .dashboard
	}

	public function getEditAppointment($appointment_id) {
    	$appointment = \App\Models\Appointment::with(['patient', 'user'])->findOrFail($appointment_id);
    	return view('edit-appointment', compact('appointment'));
	}

	public function postEditAppointment($appointment_id, Request $request) {
    $appointment = \App\Models\Appointment::findOrFail($appointment_id);

    // O veterinário escreve as notas e o sistema marca como finalizada
    $appointment->update([
        'notes' => $request->notes,
        'status' => 'finalized'
    ]);

    return redirect()->route('vet')->with('toast', 'Consulta finalizada com sucesso.');
	}

}
