@extends('layouts.main')
@section('title', 'Editar Paciente - Rusky Vet')
@section('content')
<section class="py-6 border-bottom">
    <div class="container text-center">
        <h1>Editar Paciente</h1>
        <div class="row mt-4 justify-content-center">
            <div class="col-md-6 text-left">
                {{-- O enctype é obrigatório para enviar a foto --}}
                <form action="{{ route('client.edit-patient', $patient->id ?? '') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome do Pet</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name', $patient->name ?? '') }}">
                        @error('name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="breed">Raça</label>
                        <input type="text" name="breed" class="form-control @error('breed') is-invalid @enderror" id="breed" value="{{ old('breed', $patient->breed ?? '') }}">
                        @error('breed')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="birthdate">Data de Nascimento</label>
                        <input type="text" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" value="{{ old('birthdate', isset($patient->birthdate) ? $patient->birthdate->format('d/m/Y') : '') }}">
                    </div>

                    <div class="form-group">
                        <label for="image">Foto do Pet</label>
                        {{-- Se o pet já tiver foto, mostra uma miniatura --}}
                        @if(isset($patient->image))
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $patient->image) }}" alt="Foto atual" height="80" class="radius">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="image">
                        @error('image')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-4">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection