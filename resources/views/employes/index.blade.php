@extends('layouts.app')

@section('title', 'Liste des employés')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Liste des employés</h1>
        <a href="{{ route('employes.create') }}" class="btn btn-primary">Ajouter un employé</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Statut</th>
                <th>Nb Voitures</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employes as $employe)
                <tr>
                    <td>{{ $employe->id }}</td>
                    <td>{{ $employe->nom }}</td>
                    <td>{{ $employe->prenom }}</td>
                    <td>{{ $employe->email }}</td>
                    <td>{{ $employe->statut() }}</td>
                    <td>{{ $employe->compterVoitures() }}</td>
                    <td>
                        <a href="{{ route('employes.show', $employe) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('employes.edit', $employe) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('employes.destroy', $employe) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Aucun employé trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection