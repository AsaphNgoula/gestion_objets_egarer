<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MiseEnRelation extends Model
{
    protected $fillable = [
        'objet_trouve_id',
        'declaration_perte_id',
        'admin_id',
        'note',
        'score',
        'statut',
        'email_inventeur',
        'email_proprietaire',
    ];

    protected $casts = [
        'email_inventeur'    => 'boolean',
        'email_proprietaire' => 'boolean',
    ];

    // ── Appartient à un objet trouvé ──
    public function objetTrouve()
    {
        return $this->belongsTo(ObjetTrouve::class, 'objet_trouve_id');
    }

    // ── Appartient à une déclaration de perte ──
    public function declaration()
    {
        return $this->belongsTo(DeclarationPerte::class, 'declaration_perte_id');
    }

    // ── Appartient à un admin ──
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}