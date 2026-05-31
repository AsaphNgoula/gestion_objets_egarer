<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjetTrouve;

class ObjetTrouveController extends Controller
{
    public function create()
    {
        return view('deposer');
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie'        => 'required|string',
            'description'      => 'required|string|min:10',
            'lieu'             => 'required|string',
            'date_decouverte'  => 'required|date|before_or_equal:today',
            'inventeur_nom'    => 'required|string|max:255',
            'inventeur_tel'    => 'required|string|max:20',
        ]);

        // Upload photo sécurisée (hors dossier public)
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