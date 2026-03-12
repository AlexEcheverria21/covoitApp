@extends('layouts.app')

@section('title', 'Liste des voitures')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Liste des voitures</h1>
        <div>
            <a href="{{ route('voitures.recherche') }}" class="btn btn-outline-primary">Rechercher par modèle</a>
            <a href="{{ route('voitures.disponibles') }}" class="btn btn-outline-success">Voitures disponibles</a>
            <a href="{{ route('voitures.create') }}" class="btn btn-primary">Ajouter une voiture</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Modèle</th>
                <th>Nb Places</th>
                <th>Propriétaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($voitures as $voiture)
                <tr>
                    <td>{{ $voiture->id }}</td>
                    <td>{{ $voiture->modele }}</td>
                    <td>{{ $voiture->nb_places }}</td>
                    <td>{{ $voiture->employe->prenom }} {{ $voiture->employe->nom }}</td>
                    <td>
                        <a href="{{ route('voitures.show', $voiture) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('voitures.edit', $voiture) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('voitures.destroy', $voiture) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune voiture trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection