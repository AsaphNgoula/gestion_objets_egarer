<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ObjetTrouve;
use App\Models\JournalAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoffreFortController extends Controller
{
    public function index(Request $request)
    {
        $query = ObjetTrouve::orderBy('created_at', 'desc');

        // Filtres
        if ($request->categorie) {
            $query->where('categorie', $request->categorie);
        }
        if ($request->statut) {
            $query->where('statut', $request->statut);
        }
        if ($request->lieu) {
            $query->where('lieu', $request->lieu);
        }
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nom', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        $objets = $query->paginate(10);

        // Stats
        $stats = [
            'total'     => ObjetTrouve::count(),
            'attente'   => ObjetTrouve::where('statut', 'en_attente')->count(),
            'en_cours'  => ObjetTrouve::where('statut', 'en_cours')->count(),
            'restitue'  => ObjetTrouve::where('statut', 'restitue')->count(),
        ];

        // Journaliser
        JournalAdmin::logger(
            Auth::id(),
            'consultation',
            'Consultation du coffre-fort'
        );

        return view('admin.coffre-fort', compact('objets', 'stats'));
    }

    public function updateStatut(Request $request, ObjetTrouve $objet)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,en_cours,restitue'
        ]);

        $objet->update(['statut' => $request->statut]);

        JournalAdmin::logger(
            Auth::id(),
            'validation',
            'Mise à jour statut objet : '.$objet->nom.' → '.$request->statut,
            $objet->id
        );

        return back()->with('success', 'Statut mis à jour avec succès !');
    }
}