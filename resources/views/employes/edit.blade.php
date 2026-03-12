@extends('layouts.app')

@section('title', 'Modifier l\'employé')

@section('content')
    <h1>Modifier l'employé : {{ $employe->prenom }} {{ $employe->nom }}</h1>

    <form action="{{ route('employes.update', $employe) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom"
                value="{{ old('nom', $employe->nom) }}" required>
            @error('nom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom"
                value="{{ old('prenom', $employe->prenom) }}" required>
            @error('prenom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email', $employe->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('employes.index') }}" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection