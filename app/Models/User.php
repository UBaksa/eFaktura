<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    
    protected $table = 'users';
    
    protected $authPasswordName = 'lozinka';

    protected $fillable = [
    'ime', 'prezime', 'email', 'lozinka', 'uloga', 'preduzece_id', 'aktivan', 'status', 'email_verified_at'
];

    protected $hidden = [
        'lozinka',
    ];

    protected function casts(): array
    {
        return [
            'lozinka' => 'hashed',
            'aktivan' => 'boolean',
        ];
    }

    public function preduzece()
    {
        return $this->belongsTo(Preduzece::class, 'preduzece_id');
    }

    public function fakture()
    {
        return $this->hasMany(Faktura::class, 'korisnik_id');
    }

    public function getAuthPassword()
    {
        return $this->lozinka;
    }
}