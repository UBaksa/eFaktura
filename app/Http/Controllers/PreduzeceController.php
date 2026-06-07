<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preduzece;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

class PreduzeceController extends Controller
{
    public function create()
    {
        if (auth()->user()->preduzece_id) {
            return redirect()->route('dashboard');
        }
        return view('preduzeca.create');
    }

   public function store(Request $request)
{
    if (auth()->user()->preduzece_id) {
        return redirect()->route('dashboard');
    }

    $request->validate([
        'naziv'            => 'required|string|max:200',
        'pib'              => 'required|string|size:9|unique:preduzeca,pib',
        'maticni_broj'     => 'required|string|size:8|unique:preduzeca,maticni_broj',
        'adresa'           => 'required|string|max:200',
        'email'            => 'required|email|max:100',
        'telefon'          => 'required|string|max:20',
        'godina_osnivanja' => 'required|integer|min:1800|max:' . date('Y'),
        'ime_vlasnika'     => 'required|string|max:100',
        'mesto'            => 'required|string|max:100',
        'vrsta_preduzeca'  => 'required|in:mikro,malo,srednje,veliko',
        'vrsta_delatnosti' => 'required|string|max:100',
        'apr_dokument'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        'ziro_racuni'      => 'required|array|min:1|max:3',
        'ziro_racuni.*'    => 'required|string|max:20',
    ]);

    // Upload APR dokumenta
    \Cloudinary\Configuration\Configuration::instance([
        'cloud' => [
            'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
            'api_key'    => env('CLOUDINARY_API_KEY'),
            'api_secret' => env('CLOUDINARY_API_SECRET'),
        ],
        'url' => ['secure' => true]
    ]);

    $result = (new \Cloudinary\Api\Upload\UploadApi())->upload(
        $request->file('apr_dokument')->getRealPath(),
        [
            'folder'        => 'efaktura/apr_dokumenti',
            'resource_type' => 'auto',
        ]
    );

    $preduzece = Preduzece::create([
        'naziv'                  => $request->naziv,
        'pib'                    => $request->pib,
        'maticni_broj'           => $request->maticni_broj,
        'adresa'                 => $request->adresa,
        'email'                  => $request->email,
        'telefon'                => $request->telefon,
        'godina_osnivanja'       => $request->godina_osnivanja,
        'ime_vlasnika'           => $request->ime_vlasnika,
        'mesto'                  => $request->mesto,
        'vrsta_preduzeca'        => $request->vrsta_preduzeca,
        'vrsta_delatnosti'       => $request->vrsta_delatnosti,
        'apr_dokument_url'       => $result['secure_url'],
        'apr_dokument_public_id' => $result['public_id'],
    ]);

    // Sačuvaj žiro račune
    foreach ($request->ziro_racuni as $index => $brojRacuna) {
        if (!empty($brojRacuna)) {
            \App\Models\ZiroRacun::create([
                'preduzece_id' => $preduzece->id,
                'broj_racuna'  => $brojRacuna,
                'redosled'     => $index + 1,
            ]);
        }
    }

    auth()->user()->update(['preduzece_id' => $preduzece->id]);

    return redirect()->route('dashboard')->with('success', 'Preduzeće je uspešno kreirano!');
}

    public function show(Preduzece $preduzece)
    {
        return view('preduzeca.show', compact('preduzece'));
    }
}