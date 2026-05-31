<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ObjetTrouve;
use App\Models\DeclarationPerte;
use Illuminate\Http\Request;

class ComparaisonController extends Controller
{
    public function index(Request $request)
    {
        $objetsQuery = ObjetTrouve::where('statut', '!=', 'restitue');
        $pertesQuery = DeclarationPerte::with('user')
                       ->where('statut', '!=', 'retrouve');

        if ($request->categorie) {
            $objetsQuery->where('categorie', $request->categorie);
            $pertesQuery->where('categorie', $request->categorie);
        }

        if ($request->lieu) {
            $objetsQuery->where('lieu', $request->lieu);
            $pertesQuery->where('lieu', $request->lieu);
        }

        $objets = $objetsQuery->orderBy('created_at', 'desc')->get();
        $pertes = $pertesQuery->orderBy('created_at', 'desc')->get();

        // Détecter correspondances (même catégorie + même lieu)
        $correspondances = 0;
        foreach ($objets as $objet) {
            foreach ($pertes as $perte) {
                if ($objet->categorie === $perte->categorie &&
                    $objet->lieu === $perte->lieu) {
                    $correspondances++;
                }
            }
        }

        return view('admin.comparaison', compact('objets', 'pertes', 'correspondances'));
    }
}