<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preduzece extends Model
{
    protected $table = 'preduzeca';

    protected $fillable = [
        'naziv', 'pib', 'maticni_broj', 'adresa', 'email', 'telefon',
        'apr_dokument_url', 'apr_dokument_public_id',
        'godina_osnivanja', 'ime_vlasnika', 'mesto',
        'vrsta_preduzeca', 'vrsta_delatnosti'
    ];
    public function korisnici()
    {
        return $this->hasMany(User::class, 'preduzece_id');
    }
    public function ziroRacuni()
    {
        return $this->hasMany(ZiroRacun::class, 'preduzece_id');
    }
    public function komitenti()
    {
        return $this->hasMany(Komitent::class, 'preduzece_id');
    }
    public function fakture()
    {
        return $this->hasMany(Faktura::class, 'preduzece_id');
    }
    public function saldoListe()
    {
        return $this->hasMany(SaldoLista::class, 'preduzece_id');
    }
}