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
		// Gera um nome único para a imagem
		$filename = time() . '.' . $file->getClientOriginalExtension();
		
		// Força o salvamento direto na pasta pública do storage
		// porem não está acontecendo
		$file->move(storage_path('app/public/patients'), $filename);
		
		// Salva o caminho no banco
		$data['image'] = 'patients/' . $filename;
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
		// Validação dos dados que vem do formulário
		$request->validate([
			'patient_id' => 'required',
			'date' => 'required',
		]);

		// Criando o agendamento
		Appointment::create([
			'user_id' => auth()->id(), // ID do cliente logado
			'patient_id' => $request->patient_id,
			'vet_id' => $request->vet_id ?? null, // Opcional, dependendo do seu formulário
			'date' => \Carbon\Carbon::createFromFormat('d/m/Y H:i', $request->date), 
			'notes' => $request->notes,
			'status' => 'pending' // Definindo como pendente por padrão
		]);

		return redirect()->route('client')->with('toast', 'Consulta agendada com sucesso!');
	}

	// ------------------ Veterinário ------------------
	public function getVet() {
    // Busca todas as consultas agendadas
    	$appointments = Appointment::with('patient', 'user')->orderBy('date', 'asc')->get();
    
    	return view('vet.dashboard', compact('appointments')); 
    	// (O nome da view 'vet.dashboard' deve ser o que você tem aí)
	}

	public function getEditAppointment($appointment_id) {
		// - TODO: Retornar consulta
		$appointment = null;
		return view('edit-appointment', [ 'appointment' => $appointment ]);
	}

}
