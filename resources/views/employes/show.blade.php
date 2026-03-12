@extends('layouts.app')

@section('title', 'Détails de l\'employé')

@section('content')
    <h1>{{ $employe->prenom }} {{ $employe->nom }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>ID :</strong> {{ $employe->id }}</p>
            <p><strong>Nom :</strong> {{ $employe->nom }}</p>
            <p><strong>Prénom :</strong> {{ $employe->prenom }}</p>
            <p><strong>Email :</strong> {{ $employe->email }}</p>
            <p><strong>Statut :</strong> {{ $employe->statut() }}</p>
            <p><strong>Nombre de voitures :</strong> {{ $employe->compterVoitures() }}</p>
        </div>
    </div>

    @if($employe->voitures->count() > 0)
        <h3>Voitures</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modèle</th>
                    <th>Nombre de places</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employe->voitures as $voiture)
                    <tr>
                        <td>{{ $voiture->id }}</td>
                        <td>{{ $voiture->modele }}</td>
                        <td>{{ $voiture->nb_places }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($employe->campus->count() > 0)
        <h3>Campus fréquentés</h3>
        <ul class="list-group mb-3">
            @foreach($employe->campus as $campus)
                <li class="list-group-item">{{ $campus->description }} - {{ $campus->adresse }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('employes.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('employes.edit', $employe) }}" class="btn btn-warning">Modifier</a>
@endsection