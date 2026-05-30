<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeAssistance extends Model
{
    protected $fillable = [
        'user_id',
        'declaration_perte_id',
        'message',
        'statut',
        'reponse_admin',
        'reponse_at',
    ];

    protected $casts = [
        'reponse_at' => 'datetime',
    ];

    // ── Une demande appartient à un utilisateur ──
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ── Une demande appartient à une déclaration ──
    public function declaration()
    {
        return $this->belongsTo(DeclarationPerte::class, 'declaration_perte_id');
    }
}