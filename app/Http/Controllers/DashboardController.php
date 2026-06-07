<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faktura;
use App\Models\Komitent;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->uloga === 'administrator') {
            return redirect()->route('admin.index');
        }

        $preduzece_id = $user->preduzece_id;

        $ukupnoFaktura = Faktura::where('preduzece_id', $preduzece_id)->count();
        $izlazneFakture = Faktura::where('preduzece_id', $preduzece_id)->where('tip', 'izlazna')->count();
        $ulazneFakture = Faktura::where('preduzece_id', $preduzece_id)->where('tip', 'ulazna')->count();
        $ukupnoKomitenata = Komitent::where('preduzece_id', $preduzece_id)->count();
        $poslateFakture = Faktura::where('preduzece_id', $preduzece_id)->where('status', 'poslata')->count();
        $odbijene = Faktura::where('preduzece_id', $preduzece_id)->where('status', 'odbijena')->count();

        return view('dashboard', compact(
            'ukupnoFaktura', 'izlazneFakture', 'ulazneFakture',
            'ukupnoKomitenata', 'poslateFakture', 'odbijene'
        ));
    }
}