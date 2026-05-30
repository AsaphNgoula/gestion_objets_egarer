<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjetTrouve extends Model
{
    // Colonnes qu'on peut remplir via formulaire
    protected $fillable = [
        'nom',
        'categorie',
        'description',
        'photo_path',
        'lieu',
        'lieu_detail',
        'date_decouverte',
        'heure_decouverte',
        'inventeur_nom',
        'inventeur_tel',
        'statut',
    ];

    // Colonnes dates (Laravel les convertit automatiquement)
    protected $casts = [
        'date_decouverte' => 'date',
    ];

    // Un objet trouvé peut avoir plusieurs mises en relation
    public function misesEnRelation()
    {
        return $this->hasMany(MiseEnRelation::class, 'objet_trouve_id');
    }
}