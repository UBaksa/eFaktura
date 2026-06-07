<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZiroRacun extends Model
{
    protected $table = 'ziro_racuni';

    protected $fillable = [
        'preduzece_id', 'broj_racuna', 'redosled'
    ];

    public function preduzece()
    {
        return $this->belongsTo(Preduzece::class, 'preduzece_id');
    }
}