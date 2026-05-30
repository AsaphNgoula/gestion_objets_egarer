<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObjetTrouveController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\Admin\DashboardController;

// ── Pages publiques ──
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/objets-trouves', function () { return view('welcome'); })->name('objets.index');
Route::get('/deposer', function () { return view('welcome'); })->name('deposer');
Route::get('/comment-ca-marche', function () { return view('welcome'); })->name('comment');

// ── Routes Propriétaire (connecté) ──
Route::middleware(['auth'])->prefix('mon-espace')->name('proprietaire.')->group(function () {
    Route::get('/dashboard', [ProprietaireController::class, 'dashboard'])->name('dashboard');
    Route::get('/declarer-perte', [ProprietaireController::class, 'declarerPerte'])->name('declarer');
    Route::post('/declarer-perte', [ProprietaireController::class, 'storePerte'])->name('declarer.store');
    Route::get('/mes-alertes', [ProprietaireController::class, 'alertes'])->name('alertes');
    Route::get('/assistance', [ProprietaireController::class, 'assistance'])->name('assistance');
    Route::post('/assistance', [ProprietaireController::class, 'storeAssistance'])->name('assistance.store');
});

// ── Routes Admin (protégées) ──
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/coffre-fort', function () { return view('welcome'); })->name('coffre-fort');
    Route::get('/comparaison', function () { return view('welcome'); })->name('comparaison');
    Route::get('/demandes', function () { return view('welcome'); })->name('demandes');
    Route::get('/mise-en-relation', function () { return view('welcome'); })->name('mise-en-relation');
    Route::get('/journal', function () { return view('welcome'); })->name('journal');
});

require __DIR__.'/auth.php';