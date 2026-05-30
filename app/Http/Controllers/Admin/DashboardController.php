<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ObjetTrouve;
use App\Models\DeclarationPerte;
use App\Models\DemandeAssistance;
use App\Models\User;
use App\Models\JournalAdmin;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Stats ──
        $stats = [
            'objets_trouves'  => ObjetTrouve::count(),
            'objets_perdus'   => DeclarationPerte::count(),
            'objets_restitues'=> ObjetTrouve::where('statut', 'restitue')->count(),
            'utilisateurs'    => User::where('role', 'proprietaire')->count(),
        ];

        // ── Activités récentes ──
        $journaux = JournalAdmin::with('admin')
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();

        // ── Objets en attente ──
        $objetsEnAttente = ObjetTrouve::where('statut', 'en_attente')
                           ->orderBy('created_at', 'desc')
                           ->take(4)
                           ->get();

        // ── Journaliser la consultation ──
        JournalAdmin::logger(
            Auth::id(),
            'consultation',
            'Consultation du tableau de bord admin'
        );

        return view('admin.dashboard', compact('stats', 'journaux', 'objetsEnAttente'));
    }
}