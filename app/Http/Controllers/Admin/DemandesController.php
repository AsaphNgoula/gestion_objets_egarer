<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemandeAssistance;
use App\Models\JournalAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandesController extends Controller
{
    public function index()
    {
        $demandes = DemandeAssistance::with(['user', 'declaration'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        $stats = [
            'total'   => DemandeAssistance::count(),
            'non_lu'  => DemandeAssistance::where('statut', 'non_lu')->count(),
            'lu'      => DemandeAssistance::where('statut', 'lu')->count(),
            'traite'  => DemandeAssistance::where('statut', 'traite')->count(),
        ];

        return view('admin.demandes', compact('demandes', 'stats'));
    }

    public function updateStatut(Request $request, DemandeAssistance $demande)
    {
        $request->validate([
            'statut' => 'required|in:non_lu,lu,traite'
        ]);

        $demande->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut mis à jour !');
    }

    public function repondre(Request $request, DemandeAssistance $demande)
    {
        $request->validate([
            'reponse_admin' => 'required|string|min:5'
        ]);

        $demande->update([
            'reponse_admin' => $request->reponse_admin,
            'reponse_at'    => now(),
            'statut'        => 'traite',
        ]);

        JournalAdmin::logger(
            Auth::id(),
            'notification',
            'Réponse envoyée à '.$demande->user->name
        );

        return back()->with('success', 'Réponse envoyée avec succès !');
    }
}