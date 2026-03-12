@extends('layouts.app')

@section('title', 'Voitures disponibles')

@section('content')
    <h1>Voitures disponibles</h1>
    <p class="text-muted">Voitures avec un nombre de places suffisant pour le covoiturage</p>

    <form action="{{ route('voitures.disponibles') }}" method="GET" class="mb-4">
        <div class="input-group" style="max-width: 400px;">
            <span class="input-group-text">Nb places minimum</span>
            <input type="number" class="form-control" name="nb_places_min" value="{{ $nbPlacesMin }}" min="1">
            <button type="submit" class="btn btn-success">Filtrer</button>
        </div>
    </form>

    <p>{{ $voitures->count() }} voiture(s) avec au moins {{ $nbPlacesMin }} place(s)</p>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modèle</th>
                <th>Nb Places</th>
                <th>Propriétaire</th>
            </tr>
        </thead>
        <tbody>
            @forelse($voitures as $voiture)
                <tr>
                    <td>{{ $voiture->id }}</td>
                    <td>{{ $voiture->modele }}</td>
                    <td>{{ $voiture->nb_places }}</td>
                    <td>{{ $voiture->employe->prenom }} {{ $voiture->employe->nom }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Aucune voiture disponible avec ce critère.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('voitures.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection