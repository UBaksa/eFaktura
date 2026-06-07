<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StavkaFakture extends Model
{
    protected $table = 'stavke_fakture';

    public $timestamps = false;

    protected $fillable = [
        'naziv', 'kolicina', 'jedinica_mere', 'cena_bez_pdv',
        'pdv_stopa', 'iznos_pdv', 'ukupno', 'faktura_id'
    ];

    public function faktura()
    {
        return $this->belongsTo(Faktura::class, 'faktura_id');
    }
}