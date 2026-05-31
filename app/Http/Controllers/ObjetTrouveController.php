<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjetTrouve;

class ObjetTrouveController extends Controller
{
    public function index(Request $request)
    {
        $query = ObjetTrouve::where('statut', '!=', 'restitue')
                             ->orderBy('created_at', 'desc');

        // Recherche
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nom', 'like', '%'.$request->search.'%')
                  ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        // Filtre catégorie
        if ($request->categorie) {
            $query->where('categorie', $request->categorie);
        }

        // Filtre lieu
        if ($request->lieu) {
            $query->where('lieu', $request->lieu);
        }

        $objets = $query->paginate(12);

        return view('objets-trouves', compact('objets'));
    }

    public function show(ObjetTrouve $objet)
    {
        return view('objet-detail', compact('objet'));
    }

    public function create()
    {
        return view('deposer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie'       => 'required|string',
            'description'     => 'required|string|min:10',
            'lieu'            => 'required|string',
            'date_decouverte' => 'required|date|before_or_equal:today',
            'inventeur_nom'   => 'required|string|max:255',
            'inventeur_tel'   => 'required|string|max:20',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')
                        ->store('objets-trouves', 'private');
        }

        ObjetTrouve::create([
            'nom'              => $request->nom ?? $request->categorie,
            'categorie'        => $request->categorie,
            'description'      => $request->description,
            'photo_path'       => $photoPath,
            'lieu'             => $request->lieu,
            'lieu_detail'      => $request->lieu_detail,
            'date_decouverte'  => $request->date_decouverte,
            'heure_decouverte' => $request->heure_decouverte,
            'inventeur_nom'    => $request->inventeur_nom,
            'inventeur_tel'    => $request->inventeur_tel,
            'statut'           => 'en_attente',
        ]);

        return redirect()->route('confirmation');
    }

    public function confirmation()
    {
        return view('confirmation');
    }
}