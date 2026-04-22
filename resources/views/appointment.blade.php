@extends('layouts.main')
@section('title', 'Rusky Vet - Detalhes da Consulta')
@section('content')
    <section class="py-6 border-bottom">
        <div class="container text-center">
            <h1>Consulta #{{ $appointment->id }}</h1>

            <div class="row mt-4 justify-content-center">
                <div class="col-md-10 text-left">

                    <div class="text-center mb-4">
                        <img src="{{ $appointment->patient->image ? asset('storage/' . $appointment->patient->image) : 'https://via.placeholder.com/140' }}" class="radius" height="140">
                    </div>

                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Status</th>
                                <td><span class="badge {{ $appointment->status == 'finalizada' ? 'badge-success' : 'badge-warning' }}">{{ strtoupper($appointment->status) }}</span></td>
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
                            <tr>
                                <th>Observações</th>
                                <td>{{ $appointment->notes ?? 'Nenhuma observação registrada.' }}</td>
                            </tr>
                            <tr>
                                <th>Veterinário responsável</th>
                                <td>{{ $appointment->vet->name ?? 'Aguardando definição' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection