<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komitent extends Model
{
    protected $table = 'komitenti';

    protected $fillable = [
        'naziv', 'pib', 'adresa', 'email', 'telefon', 'tip', 'preduzece_id'
    ];

    public function preduzece()
    {
        return $this->belongsTo(Preduzece::class, 'preduzece_id');
    }

    public function fakture()
    {
        return $this->hasMany(Faktura::class, 'komitent_id');
    }

    public function saldoListe()
    {
        return $this->hasMany(SaldoLista::class, 'komitent_id');
    }
}