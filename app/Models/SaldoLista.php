<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaldoLista extends Model
{
    protected $table = 'saldo_liste';

    public $timestamps = false;

    protected $fillable = [
        'preduzece_id', 'komitent_id', 'iznos_dugovanja',
        'valuta', 'u_valuti', 'datum_generisanja'
    ];

    protected function casts(): array
    {
        return [
            'u_valuti' => 'boolean',
            'datum_generisanja' => 'datetime',
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
}