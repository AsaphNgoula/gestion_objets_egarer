<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclarationPerte extends Model
{
    protected $fillable = [
    'user_id', 'nom', 'marque', 'couleur',
    'categorie', 'description', 'signes_particuliers',
    'lieu', 'lieu_precis', 'date_perte', 'heure_perte',
    'circonstances', 'moyen_contact', 'commentaires',
    'photo_justificatif', 'statut',
    ];

    protected $casts = [
        'date_perte' => 'date',
    ];

    // ── Relation : une déclaration appartient à un utilisateur ──
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une déclaration peut avoir plusieurs demandes
    public function demandes()
    {
        return $this->hasMany(DemandeAssistance::class, 'declaration_perte_id');
    }

    // Une déclaration peut avoir plusieurs mises en relation
    public function misesEnRelation()
    {
        return $this->hasMany(MiseEnRelation::class, 'declaration_perte_id');
    }
}