<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MiseEnRelation;
use App\Models\ObjetTrouve;
use App\Models\DeclarationPerte;
use App\Models\JournalAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MiseEnRelationController extends Controller
{
    public function index()
    {
        $relations = MiseEnRelation::with([
                        'objetTrouve',
                        'declaration.user',
                        'admin'
                     ])
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);

        $stats = [
            'attente'  => MiseEnRelation::where('statut', 'en_attente')->count(),
            'cours'    => MiseEnRelation::where('statut', 'en_cours')->count(),
            'confirme' => MiseEnRelation::where('statut', 'confirme')->count(),
            'restitue' => MiseEnRelation::where('statut', 'restitue')->count(),
        ];

        return view('admin.mise-en-relation', compact('relations', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'objet_trouve_id'    => 'required|exists:objet_trouves,id',
            'declaration_perte_id' => 'required|exists:declaration_pertes,id',
        ]);

        MiseEnRelation::create([
            'objet_trouve_id'     => $request->objet_trouve_id,
            'declaration_perte_id'=> $request->declaration_perte_id,
            'admin_id'            => Auth::id(),
            'statut'              => 'en_cours',
        ]);

        JournalAdmin::logger(
            Auth::id(),
            'relation',
            'Nouvelle mise en relation créée'
        );

        return back()->with('success', 'Mise en relation créée avec succès !');
    }

    public function updateStatut(Request $request, MiseEnRelation $mer)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,en_cours,confirme,restitue'
        ]);

        $mer->update(['statut' => $request->statut]);

        if ($request->statut === 'restitue') {
            $mer->objetTrouve->update(['statut' => 'restitue']);
            $mer->declaration->update(['statut' => 'retrouve']);
        }

        JournalAdmin::logger(
            Auth::id(),
            'relation',
            'Statut mise en relation → '.$request->statut
        );

        return back()->with('success', 'Statut mis à jour !');
    }
}