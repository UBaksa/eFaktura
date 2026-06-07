<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faktura extends Model
{
    protected $table = 'fakture';

    protected $fillable = [
    'broj_fakture', 'datum_izdavanja', 'datum_valute', 'tip',
    'status', 'valuta', 'napomena', 'razlog_odbijanja',
    'dokument_url', 'dokument_public_id',
    'preduzece_id', 'komitent_id', 'korisnik_id', 'povezana_faktura_id'
    ];

    protected function casts(): array
    {
        return [
            'datum_izdavanja' => 'date',
            'datum_valute' => 'date',
        ];
    }

    public function preduzece()
    {
        return $this->belongsTo(Preduzece::class, 'preduzece_id');
    }

    public function komitent()
    {
        return $this->belongsTo(Komitent::class, 'komitent_id');
    }

    public function korisnik()
    {
        return $this->belongsTo(User::class, 'korisnik_id');
    }

    public function stavke()
    {
        return $this->hasMany(StavkaFakture::class, 'faktura_id');
    }
}