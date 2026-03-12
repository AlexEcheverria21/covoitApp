@extends('layouts.app')

@section('title', 'Rechercher par modèle')

@section('content')
    <h1>Rechercher des voitures par modèle</h1>

    <form action="{{ route('voitures.recherche') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="modele" value="{{ $modele }}"
                placeholder="Entrez un modèle (ex: Ferrari)">
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </div>
    </form>

    @if($modele)
        <p>Résultats pour "<strong>{{ $modele }}</strong>" : {{ $voitures->count() }} voiture(s) trouvée(s)</p>
    @endif

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
                    <td colspan="4" class="text-center">Aucune voiture trouvée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('voitures.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection