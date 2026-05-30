<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeclarationPerte extends Model
{
    protected $fillable = [
        'user_id',
        'nom',
        'categorie',
        'description',
        'signes_particuliers',
        'lieu',
        'date_perte',
        'statut',
    ];

    protected $casts = [
        'date_perte' => 'date',
    ];

    // ── Relation : une déclaration appartient à un utilisateur ──
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}