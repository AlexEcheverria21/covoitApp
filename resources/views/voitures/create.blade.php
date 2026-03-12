@extends('layouts.app')

@section('title', 'Ajouter une voiture')

@section('content')
    <h1>Ajouter une voiture</h1>

    <form action="{{ route('voitures.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="employe_id" class="form-label">Propriétaire</label>
            <select class="form-select @error('employe_id') is-invalid @enderror" id="employe_id" name="employe_id"
                required>
                <option value="">-- Sélectionner un employé --</option>
                @foreach($employes as $employe)
                    <option value="{{ $employe->id }}" {{ old('employe_id') == $employe->id ? 'selected' : '' }}>
                        {{ $employe->prenom }} {{ $employe->nom }}
                    </option>
                @endforeach
            </select>
            @error('employe_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="modele" class="form-label">Modèle</label>
            <input type="text" class="form-control @error('modele') is-invalid @enderror" id="modele" name="modele"
                value="{{ old('modele') }}" required>
            @error('modele')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nb_places" class="form-label">Nombre de places</label>
            <input type="number" class="form-control @error('nb_places') is-invalid @enderror" id="nb_places"
                name="nb_places" value="{{ old('nb_places') }}" min="1" required>
            @error('nb_places')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('voitures.index') }}" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection