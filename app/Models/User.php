<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    // ════════════════════════════════
    // VÉRIFICATION DES RÔLES
    // ════════════════════════════════

    // Est-ce un admin ?
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // Est-ce un propriétaire ?
    public function isProprietaire(): bool
    {
        return $this->role === 'proprietaire';
    }

    // ════════════════════════════════
    // RELATIONS
    // ════════════════════════════════

    public function declarations()
    {
        return $this->hasMany(DeclarationPerte::class);
    }

    public function demandes()
    {
        return $this->hasMany(DemandeAssistance::class);
    }

    public function misesEnRelation()
    {
        return $this->hasMany(MiseEnRelation::class, 'admin_id');
    }

    public function journaux()
    {
        return $this->hasMany(JournalAdmin::class, 'admin_id');
    }
}