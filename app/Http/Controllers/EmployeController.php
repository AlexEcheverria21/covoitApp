<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Afficher la liste de tous les employés
     */
    public function index()
    {
        $employes = Employe::all();
        return view('employes.index', compact('employes'));
    }

    /**
     * Afficher le formulaire de création d'un employé
     */
    public function create()
    {
        return view('employes.create');
    }

    /**
     * Enregistrer un nouvel employé
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:employes,email',
        ]);

        Employe::create($request->only(['nom', 'prenom', 'email']));

        return redirect()->route('employes.index')
            ->with('success', 'Employé créé avec succès.');
    }

    /**
     * Afficher les détails d'un employé
     */
    public function show(Employe $employe)
    {
        $employe->load('voitures', 'campus');
        return view('employes.show', compact('employe'));
    }

    /**
     * Afficher le formulaire d'édition d'un employé
     */
    public function edit(Employe $employe)
    {
        return view('employes.edit', compact('employe'));
    }

    /**
     * Mettre à jour un employé
     */
    public function update(Request $request, Employe $employe)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:employes,email,' . $employe->id,
        ]);

        $employe->update($request->only(['nom', 'prenom', 'email']));

        return redirect()->route('employes.index')
            ->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Supprimer un employé
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();

        return redirect()->route('employes.index')
            ->with('success', 'Employé supprimé avec succès.');
    }
}
