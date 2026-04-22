@extends('layouts.main')
@section('title', 'Rusky Vet - Detalhes da Consulta')
@section('content')
    <section class="py-6 border-bottom">
        <div class="container text-center">
            <h1>Consulta #{{ $appointment->id }}</h1>

            <div class="row mt-4 justify-content-center">
                <div class="col-md-10 text-left">
                    <div class="text-center mb-4">
                        {{-- Foto do Pet vinda do banco --}}
                        <img src="{{ $appointment->patient->image ? asset('storage/' . $appointment->patient->image) : 'https://via.placeholder.com/140' }}" class="radius" height="140">
                    </div>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge {{ $appointment->status == 'finalized' ? 'badge-success' : 'badge-warning' }}">
                                        {{ $appointment->status == 'finalized' ? 'FINALIZADA' : 'AGENDADA' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Data e hora</th>
                                <td>{{ $appointment->date->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Nome do paciente</th>
                                <td>{{ $appointment->patient->name }}</td>
                            </tr>
                            <tr>
                                <th>Raça</th>
                                <td>{{ $appointment->patient->breed }}</td>
                            </tr>
                            <tr>
                                <th>Dono</th>
                                <td>{{ $appointment->user->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-6 justify-content-center">
                <div class="col-md-6 text-left">
                    {{-- O formulário agora envia para a rota de salvar --}}
                    <form action="{{ route('vet.edit-appointment', $appointment->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="notes">Observações do Veterinário</label>
                            <textarea name="notes" rows="7" class="form-control" id="notes">{{ old('notes', $appointment->notes) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mt-4">Salvar e finalizar consulta</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection