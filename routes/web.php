<?php

use App\Http\Controllers\EmployeController;
use App\Http\Controllers\VehiculeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('employes', EmployeController::class);

Route::resource('voitures', VehiculeController::class);
Route::get('voitures-recherche', [VehiculeController::class, 'rechercherParModele'])->name('voitures.recherche');
Route::get('voitures-disponibles', [VehiculeController::class, 'voituresDisponibles'])->name('voitures.disponibles');
