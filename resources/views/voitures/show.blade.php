@extends('layouts.app')

@section('title', 'Détails de la voiture')

@section('content')
    <h1>{{ $voiture->modele }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>ID :</strong> {{ $voiture->id }}</p>
            <p><strong>Modèle :</strong> {{ $voiture->modele }}</p>
            <p><strong>Nombre de places :</strong> {{ $voiture->nb_places }}</p>
            <p><strong>Propriétaire :</strong> {{ $voiture->employe->prenom }} {{ $voiture->employe->nom }}</p>
            <p><strong>Nombre de trajets effectués :</strong> {{ $voiture->trajets->count() }}</p>
        </div>
    </div>

    @if($voiture->trajets->count() > 0)
        <h3>Trajets effectués</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Départ</th>
                    <th>Arrivée</th>
                </tr>
            </thead>
            <tbody>
                @foreach($voiture->trajets as $trajet)
                    <tr>
                        <td>{{ $trajet->id }}</td>
                        <td>{{ $trajet->date_time_depart }}</td>
                        <td>{{ $trajet->date_time_arrivee }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('voitures.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('voitures.edit', $voiture) }}" class="btn btn-warning">Modifier</a>
@endsection