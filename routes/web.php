<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Autres pages publiques (on les fera après)
Route::get('/objets-trouves', function () { return view('welcome'); })->name('objets.index');
Route::get('/deposer', function () { return view('welcome'); })->name('deposer');
Route::get('/comment-ca-marche', function () { return view('welcome'); })->name('comment');

// Routes d'authentification
Route::get('/login', function () { return view('welcome'); })->name('login');
Route::get('/register', function () { return view('welcome'); })->name('register');
Route::get('/dashboard', function () { return view('welcome'); })->name('dashboard');