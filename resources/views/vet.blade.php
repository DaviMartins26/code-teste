@extends('layouts.main')
@section('title', 'Rusky Vet - Painel do Veterinário')
@section('content')
    <section class="py-6 border-bottom">
        <div class="container text-center">
            <h1>Olá {{ explode(' ', trim(auth()->user()->name))[0] }}!</h1>
        </div>
    </section>

    <section class="py-5 border-bottom">
        <div class="container text-center">
            <h3>Consultas agendadas</h3>
            <div class="row mt-5 justify-content-center">
                <div class="col-12 col-lg-10">
                <table class="table" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Nome do dono</th>
                            <th>Nome do cachorro</th>
                            <th>Data da consulta</th>
                            <th>Horário</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- O loop percorre cada consulta vinda do banco --}}
                        @forelse($appointments as $appointment)
                            <tr>
                                <td>
                                    <span class="badge {{ $appointment->status == 'finalized' ? 'badge-success' : 'badge-warning' }}">
                                        {{ $appointment->status == 'finalized' ? 'FINALIZADA' : 'AGENDADA' }}
                                    </span>
                                </td>
                                <td>{{ $appointment->user->name }}</td>
                                <td>{{ $appointment->patient->name }}</td>
                                {{-- Usamos o Carbon para formatar a data e hora --}}
                                <td>{{ $appointment->date->format('d/m/Y') }}</td>
                                <td>{{ $appointment->date->format('H:i') }}</td>
                                <td>
                                    {{-- O link agora leva o ID real da consulta --}}
                                    <a href="{{ route('vet.edit-appointment', $appointment->id) }}" class="btn btn-primary btn-sm">Abrir</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Nenhuma consulta agendada para hoje.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </section>
@endsection