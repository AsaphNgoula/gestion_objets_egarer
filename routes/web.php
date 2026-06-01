<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ObjetTrouveController;
use App\Http\Controllers\ProprietaireController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CoffreFortController;
use App\Http\Controllers\Admin\ComparaisonController;
use App\Http\Controllers\Admin\DemandesController;
use App\Http\Controllers\Admin\JournalController;
use App\Http\Controllers\Admin\MiseEnRelationController;
use App\Http\Controllers\PageController;


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



// Page dépôt anonyme
Route::get('/deposer', [ObjetTrouveController::class, 'create'])->name('deposer');
Route::post('/deposer', [ObjetTrouveController::class, 'store'])->name('deposer.store');
Route::get('/confirmation', [ObjetTrouveController::class, 'confirmation'])->name('confirmation');


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Coffre-fort
    Route::get('/coffre-fort', [CoffreFortController::class, 'index'])->name('coffre-fort');
    Route::patch('/coffre-fort/{objet}/statut', [CoffreFortController::class, 'updateStatut'])->name('coffre-fort.statut');

    // Comparaison
    Route::get('/comparaison', [ComparaisonController::class, 'index'])->name('comparaison');

    // Demandes
    Route::get('/demandes', [DemandesController::class, 'index'])->name('demandes');
    Route::patch('/demandes/{demande}/statut', [DemandesController::class, 'updateStatut'])->name('demandes.statut');
    Route::post('/demandes/{demande}/repondre', [DemandesController::class, 'repondre'])->name('demandes.repondre');

    // Journal
    Route::get('/journal', [JournalController::class, 'index'])->name('journal');

    // Mise en relation
    Route::get('/mise-en-relation', [MiseEnRelationController::class, 'index'])->name('mise-en-relation');
    Route::post('/mise-en-relation', [MiseEnRelationController::class, 'store'])->name('mise-en-relation.store');
    Route::patch('/mise-en-relation/{mer}/statut', [MiseEnRelationController::class, 'updateStatut'])->name('mise-en-relation.statut');
});



Route::get('/objets-trouves', [ObjetTrouveController::class, 'index'])->name('objets.index');
Route::get('/objets-trouves/{objet}', [ObjetTrouveController::class, 'show'])->name('objets.show');


Route::get('/comment-ca-marche', [PageController::class, 'comment'])->name('comment');