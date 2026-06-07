<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komitent;

class KomitentController extends Controller
{
    public function index(Request $request)
    {
        $preduzece_id = auth()->user()->preduzece_id;
        $query = Komitent::where('preduzece_id', $preduzece_id);

        if ($request->filled('pretraga')) {
            $query->where(function($q) use ($request) {
                $q->where('naziv', 'like', '%' . $request->pretraga . '%')
                  ->orWhere('pib', 'like', '%' . $request->pretraga . '%')
                  ->orWhere('maticni_broj', 'like', '%' . $pretraga . '%')
                  ->orWhere('adresa', 'like', '%' . $request->pretraga . '%');
            });
        }

        if ($request->filled('tip')) {
            $query->where('tip', $request->tip);
        }

        $komitenti = $query->latest()->paginate(15);
        return view('komitenti.index', compact('komitenti'));
    }

    public function create(Request $request)
{
    $preduzeca = collect();
    $pretraga = $request->input('pretraga');

    if ($request->filled('pretraga')) {
        $preduzeca = \App\Models\Preduzece::where('naziv', 'like', '%' . $pretraga . '%')
            ->orWhere('pib', 'like', '%' . $pretraga . '%')
            ->get();
    }

    return view('komitenti.create', compact('preduzeca', 'pretraga'));
}

    public function store(Request $request)
{
    $request->validate([
        'preduzece_id' => 'required|exists:preduzeca,id',
        'tip'          => 'required|in:klijent,dobavljac,oba',
    ]);

    // Proveri da li komitent vec postoji
    $postojeci = \App\Models\Komitent::where('preduzece_id', auth()->user()->preduzece_id)
        ->where('pib', \App\Models\Preduzece::find($request->preduzece_id)->pib)
        ->first();

    if ($postojeci) {
        return back()->with('error', 'Ovo preduzeće je već dodato kao komitent.');
    }

    // Proveri da korisnik ne dodaje svoje preduzece kao komitenta
    if ($request->preduzece_id == auth()->user()->preduzece_id) {
        return back()->with('error', 'Ne možete dodati svoje preduzeće kao komitenta.');
    }

    $preduzece = \App\Models\Preduzece::findOrFail($request->preduzece_id);

    \App\Models\Komitent::create([
        'naziv'        => $preduzece->naziv,
        'pib'          => $preduzece->pib,
        'adresa'       => $preduzece->adresa,
        'email'        => $preduzece->email,
        'telefon'      => $preduzece->telefon,
        'tip'          => $request->tip,
        'preduzece_id' => auth()->user()->preduzece_id,
    ]);

    return redirect()->route('komitenti.index')->with('success', 'Komitent je uspešno dodat.');
}

    public function show(Komitent $komitent)
    {
        $this->autorizuj($komitent);
        $fakture = $komitent->fakture()->latest()->paginate(10);
        return view('komitenti.show', compact('komitent', 'fakture'));
    }

    public function edit(Komitent $komitent)
    {
        $this->autorizuj($komitent);
        return view('komitenti.edit', compact('komitent'));
    }

   public function update(Request $request, Komitent $komitent)
{
    $this->autorizuj($komitent);

    $request->validate([
        'tip' => 'required|in:klijent,dobavljac,oba',
    ]);

    $komitent->update(['tip' => $request->tip]);

    return redirect()->route('komitenti.index')->with('success', 'Komitent je uspešno izmenjen.');
}

    public function destroy(Komitent $komitent)
    {
        $this->autorizuj($komitent);

        if ($komitent->fakture()->count() > 0) {
            return back()->with('error', 'Ne možete obrisati komitenta koji ima vezane fakture.');
        }

        $komitent->delete();
        return redirect()->route('komitenti.index')->with('success', 'Komitent je obrisan.');
    }

    private function autorizuj(Komitent $komitent)
    {
        if ($komitent->preduzece_id !== auth()->user()->preduzece_id) {
            abort(403);
        }
    }
}