<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaldoLista;
use App\Models\Faktura;
use App\Models\Komitent;
use Carbon\Carbon;

class SaldoListaController extends Controller
{
    public function index()
    {
        $preduzece_id = auth()->user()->preduzece_id;
        $saldo = SaldoLista::with('komitent')
            ->where('preduzece_id', $preduzece_id)
            ->latest('datum_generisanja')
            ->paginate(15);

        return view('saldo.index', compact('saldo'));
    }

  public function generisi()
{
    $preduzece_id = auth()->user()->preduzece_id;

    // Obrisi stare saldo liste
    SaldoLista::where('preduzece_id', $preduzece_id)->delete();

    $komitenti = Komitent::where('preduzece_id', $preduzece_id)->get();

    foreach ($komitenti as $komitent) {
        // Grupisanje po valuti
        $valute = Faktura::where('preduzece_id', $preduzece_id)
            ->where('komitent_id', $komitent->id)
            ->whereIn('status', ['poslata', 'primljena'])
            ->distinct()
            ->pluck('valuta');

        foreach ($valute as $valuta) {
            $fakture = Faktura::where('preduzece_id', $preduzece_id)
                ->where('komitent_id', $komitent->id)
                ->where('valuta', $valuta)
                ->whereIn('status', ['poslata', 'primljena'])
                ->get();

            $ukupnoIznos = 0;
            $uValuti = true;

            foreach ($fakture as $faktura) {
                $ukupnoIznos += $faktura->stavke->sum('ukupno');
                if (!\Carbon\Carbon::now()->lte($faktura->datum_valute)) {
                    $uValuti = false;
                }
            }

            if ($ukupnoIznos > 0) {
                SaldoLista::create([
                    'preduzece_id'    => $preduzece_id,
                    'komitent_id'     => $komitent->id,
                    'iznos_dugovanja' => $ukupnoIznos,
                    'valuta'          => $valuta,
                    'u_valuti'        => $uValuti,
                    'datum_generisanja' => \Carbon\Carbon::now(),
                ]);
            }
        }
    }

    return redirect()->route('saldo.index')->with('success', 'Saldo lista je generisana.');
}
}