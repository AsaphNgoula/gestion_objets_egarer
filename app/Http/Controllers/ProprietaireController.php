<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DeclarationPerte;
use App\Models\DemandeAssistance;

class ProprietaireController extends Controller
{
    // ── Dashboard propriétaire ──
    public function dashboard()
    {
        $declarations = DeclarationPerte::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('proprietaire.dashboard', compact('declarations'));
    }

    // ── Page déclarer une perte ──
    public function declarerPerte()
    {
        return view('proprietaire.declarer-perte');
    }

    // ── Sauvegarder la déclaration ──
    public function storePerte(Request $request)
        {
            $request->validate([
                'categorie'   => 'required|string',
                'description' => 'required|string|min:10',
                'lieu'        => 'required|string',
                'date_perte'  => 'required|date|before_or_equal:today',
            ]);

            // Upload photo si fournie
            $photoPath = null;
            if ($request->hasFile('photo_justificatif')) {
                $photoPath = $request->file('photo_justificatif')
                            ->store('justificatifs', 'private');
            }

            DeclarationPerte::create([
                'user_id'              => Auth::id(),
                'nom'                  => $request->nom ?? $request->categorie,
                'marque'               => $request->marque,
                'couleur'              => $request->couleur,
                'categorie'            => $request->categorie,
                'description'          => $request->description,
                'signes_particuliers'  => $request->signes_particuliers,
                'lieu'                 => $request->lieu,
                'date_perte'           => $request->date_perte,
                'heure_perte'          => $request->heure_perte,
                'circonstances'        => $request->circonstances,
                'moyen_contact'        => $request->moyen_contact,
                'commentaires'         => $request->commentaires,
                'photo_justificatif'   => $photoPath,
                'statut'               => 'en_attente',
            ]);

            return redirect()->route('proprietaire.alertes')
                ->with('success', '✅ Votre déclaration a bien été enregistrée !');
        }

    // ── Mes alertes ──
    public function alertes()
    {
        $declarations = DeclarationPerte::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('proprietaire.alertes', compact('declarations'));
    }

    // ── Demande assistance ──
    public function assistance()
    {
        $declarations = DeclarationPerte::where('user_id', Auth::id())->get();
        return view('proprietaire.assistance', compact('declarations'));
    }

    // ── Sauvegarder la demande ──
    public function storeAssistance(Request $request)
    {
        $request->validate([
            'declaration_perte_id' => 'required|exists:declaration_pertes,id',
            'message'              => 'required|string|min:10',
        ]);

        DemandeAssistance::create([
            'user_id'              => Auth::id(),
            'declaration_perte_id' => $request->declaration_perte_id,
            'message'              => $request->message,
            'statut'               => 'non_lu',
        ]);

        return redirect()->route('proprietaire.assistance')
               ->with('success', 'Votre demande a bien été envoyée à l\'administrateur !');
    }
}