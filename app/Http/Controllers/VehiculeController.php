<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Voiture;
use Illuminate\Http\Request;

class VehiculeController extends Controller
{
    /**
     * Afficher la liste de toutes les voitures
     */
    public function index()
    {
        $voitures = Voiture::with('employe')->get();
        return view('voitures.index', compact('voitures'));
    }

    /**
     * Afficher le formulaire de création d'une voiture
     */
    public function create()
    {
        $employes = Employe::all();
        return view('voitures.create', compact('employes'));
    }

    /**
     * Enregistrer une nouvelle voiture
     */
    public function store(Request $request)
    {
        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'modele' => 'required|string|max:255',
            'nb_places' => 'required|integer|min:1',
        ]);

        Voiture::create($request->only(['employe_id', 'modele', 'nb_places']));

        return redirect()->route('voitures.index')
            ->with('success', 'Voiture créée avec succès.');
    }

    /**
     * Afficher les détails d'une voiture
     */
    public function show(Voiture $voiture)
    {
        $voiture->load('employe', 'trajets');
        return view('voitures.show', compact('voiture'));
    }

    /**
     * Afficher le formulaire d'édition d'une voiture
     */
    public function edit(Voiture $voiture)
    {
        $employes = Employe::all();
        return view('voitures.edit', compact('voiture', 'employes'));
    }

    /**
     * Mettre à jour une voiture
     */
    public function update(Request $request, Voiture $voiture)
    {
        $request->validate([
            'employe_id' => 'required|exists:employes,id',
            'modele' => 'required|string|max:255',
            'nb_places' => 'required|integer|min:1',
        ]);

        $voiture->update($request->only(['employe_id', 'modele', 'nb_places']));

        return redirect()->route('voitures.index')
            ->with('success', 'Voiture mise à jour avec succès.');
    }

    /**
     * Supprimer une voiture
     */
    public function destroy(Voiture $voiture)
    {
        $voiture->delete();

        return redirect()->route('voitures.index')
            ->with('success', 'Voiture supprimée avec succès.');
    }

    /**
     * Fonction supplémentaire 1 : Rechercher les voitures par modèle
     */
    public function rechercherParModele(Request $request)
    {
        $modele = $request->input('modele', '');
        $voitures = Voiture::with('employe')
            ->where('modele', 'like', '%' . $modele . '%')
            ->get();

        return view('voitures.recherche', compact('voitures', 'modele'));
    }

    /**
     * Fonction supplémentaire 2 : Lister les voitures disponibles (avec places >= seuil)
     */
    public function voituresDisponibles(Request $request)
    {
        $nbPlacesMin = $request->input('nb_places_min', 2);
        $voitures = Voiture::with('employe')
            ->where('nb_places', '>=', $nbPlacesMin)
            ->orderBy('nb_places', 'desc')
            ->get();

        return view('voitures.disponibles', compact('voitures', 'nbPlacesMin'));
    }
}
