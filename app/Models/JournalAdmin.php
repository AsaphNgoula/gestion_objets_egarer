<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalAdmin extends Model
{
    protected $fillable = [
        'admin_id',
        'action',
        'detail',
        'objet_trouve_id',
        'ip_address',
    ];

    // ── Appartient à un admin ──
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // ── Appartient à un objet trouvé ──
    public function objetTrouve()
    {
        return $this->belongsTo(ObjetTrouve::class, 'objet_trouve_id');
    }

    // ── Méthode pour créer une entrée facilement ──
    public static function logger($adminId, $action, $detail, $objetId = null)
    {
        return self::create([
            'admin_id'        => $adminId,
            'action'          => $action,
            'detail'          => $detail,
            'objet_trouve_id' => $objetId,
            'ip_address'      => request()->ip(),
        ]);
    }
}