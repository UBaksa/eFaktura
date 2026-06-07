<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faktura;
use App\Models\Komitent;
use App\Models\StavkaFakture;
use App\Mail\FakturaKreirana;
use Illuminate\Support\Facades\Mail;

class FakturaController extends Controller
{
    public function index(Request $request)
    {
        $preduzece_id = auth()->user()->preduzece_id;
        $query = Faktura::with(['komitent'])->where('preduzece_id', $preduzece_id);

        if ($request->filled('tip')) {
            $query->where('tip', $request->tip);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('pretraga')) {
            $query->whereHas('komitent', function($q) use ($request) {
                $q->where('naziv', 'like', '%' . $request->pretraga . '%');
            });
        }

        $fakture = $query->latest()->paginate(15);
        return view('fakture.index', compact('fakture'));
    }

    public function create()
    {
        $preduzece_id = auth()->user()->preduzece_id;
        $komitenti = Komitent::where('preduzece_id', $preduzece_id)
            ->whereIn('tip', ['klijent', 'oba', 'dobavljac'])->get();
        return view('fakture.create', compact('komitenti'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'komitent_id'             => 'required|exists:komitenti,id',
            'datum_izdavanja'         => 'required|date',
            'datum_valute'            => 'required|date|after_or_equal:datum_izdavanja',
            'valuta'                  => 'required|string|size:3',
            'napomena'                => 'nullable|string',
            'stavke'                  => 'required|array|min:1',
            'stavke.*.naziv'          => 'required|string|max:200',
            'stavke.*.kolicina'       => 'required|numeric|min:0.001',
            'stavke.*.jedinica_mere'  => 'required|string|max:20',
            'stavke.*.cena_bez_pdv'   => 'required|numeric|min:0',
            'stavke.*.pdv_stopa'      => 'required|in:0,10,20',
        ]);

        $preduzece_id = auth()->user()->preduzece_id;
        $broj = 'F-' . date('Y') . '-' . str_pad(Faktura::where('preduzece_id', $preduzece_id)->count() + 1, 4, '0', STR_PAD_LEFT);

        $faktura = Faktura::create([
            'broj_fakture'    => $broj,
            'datum_izdavanja' => $request->datum_izdavanja,
            'datum_valute'    => $request->datum_valute,
            'tip'             => 'izlazna',
            'status'          => 'poslata',
            'valuta'          => strtoupper($request->valuta),
            'napomena'        => $request->napomena,
            'preduzece_id'    => $preduzece_id,
            'komitent_id'     => $request->komitent_id,
            'korisnik_id'     => auth()->id(),
        ]);

        foreach ($request->stavke as $stavka) {
            $iznos_pdv = $stavka['kolicina'] * $stavka['cena_bez_pdv'] * $stavka['pdv_stopa'] / 100;
            $ukupno = $stavka['kolicina'] * $stavka['cena_bez_pdv'] + $iznos_pdv;

            StavkaFakture::create([
                'naziv'         => $stavka['naziv'],
                'kolicina'      => $stavka['kolicina'],
                'jedinica_mere' => $stavka['jedinica_mere'],
                'cena_bez_pdv'  => $stavka['cena_bez_pdv'],
                'pdv_stopa'     => $stavka['pdv_stopa'],
                'iznos_pdv'     => $iznos_pdv,
                'ukupno'        => $ukupno,
                'faktura_id'    => $faktura->id,
            ]);
        }

        $faktura->load(['komitent', 'stavke', 'preduzece']);

        // Kreiraj ulaznu fakturu kod komitenta ako je registrovan u sistemu
        $komitentPreduzece = \App\Models\Preduzece::where('pib', $faktura->komitent->pib)->first();

        if ($komitentPreduzece) {
            $komitentKodPrimaoca = \App\Models\Komitent::firstOrCreate(
                [
                    'pib'          => $faktura->preduzece->pib,
                    'preduzece_id' => $komitentPreduzece->id,
                ],
                [
                    'naziv'   => $faktura->preduzece->naziv,
                    'adresa'  => $faktura->preduzece->adresa,
                    'email'   => $faktura->preduzece->email,
                    'telefon' => $faktura->preduzece->telefon,
                    'tip'     => 'dobavljac',
                ]
            );

            $korisnikPrimaoca = \App\Models\User::where('preduzece_id', $komitentPreduzece->id)
                ->where('uloga', '!=', 'administrator')
                ->first();

            if ($korisnikPrimaoca) {
                $ulaznaFaktura = \App\Models\Faktura::create([
                    'broj_fakture'        => $faktura->broj_fakture,
                    'datum_izdavanja'     => $faktura->datum_izdavanja,
                    'datum_valute'        => $faktura->datum_valute,
                    'tip'                 => 'ulazna',
                    'status'              => 'poslata',
                    'valuta'              => $faktura->valuta,
                    'napomena'            => $faktura->napomena,
                    'preduzece_id'        => $komitentPreduzece->id,
                    'komitent_id'         => $komitentKodPrimaoca->id,
                    'korisnik_id'         => $korisnikPrimaoca->id,
                    'povezana_faktura_id' => $faktura->id,
                ]);

                // Povezi izlaznu fakturu sa ulaznom
                $faktura->update(['povezana_faktura_id' => $ulaznaFaktura->id]);

                // Kopiraj stavke
                foreach ($faktura->stavke as $stavka) {
                    \App\Models\StavkaFakture::create([
                        'naziv'         => $stavka->naziv,
                        'kolicina'      => $stavka->kolicina,
                        'jedinica_mere' => $stavka->jedinica_mere,
                        'cena_bez_pdv'  => $stavka->cena_bez_pdv,
                        'pdv_stopa'     => $stavka->pdv_stopa,
                        'iznos_pdv'     => $stavka->iznos_pdv,
                        'ukupno'        => $stavka->ukupno,
                        'faktura_id'    => $ulaznaFaktura->id,
                    ]);
                }
            }
        }

        // Pošalji mail komitentu
        try {
            Mail::to('ujkanovicbakir@gmail.com')->send(new FakturaKreirana($faktura));
        } catch (\Exception $e) {
            \Log::error('Mail error: ' . $e->getMessage());
        }

        return redirect()->route('fakture.index')->with('success', 'Faktura je uspešno kreirana.');
    }

    public function show(Faktura $faktura)
    {
        $this->autorizuj($faktura);
        $faktura->load(['komitent', 'korisnik', 'stavke', 'preduzece']);
        return view('fakture.show', compact('faktura'));
    }

    public function edit(Faktura $faktura)
    {
        $this->autorizuj($faktura);
        $preduzece_id = auth()->user()->preduzece_id;
        $komitenti = Komitent::where('preduzece_id', $preduzece_id)->get();
        $faktura->load('stavke');
        return view('fakture.edit', compact('faktura', 'komitenti'));
    }

    public function update(Request $request, Faktura $faktura)
    {
        $this->autorizuj($faktura);

        $request->validate([
            'datum_valute' => 'required|date',
            'napomena'     => 'nullable|string',
            'status'       => 'required|in:poslata,primljena,placena,odbijena',
        ]);

        $faktura->update($request->only(['datum_valute', 'napomena', 'status']));

        return redirect()->route('fakture.show', $faktura)->with('success', 'Faktura je izmenjena.');
    }

    public function destroy(Faktura $faktura)
    {
        $this->autorizuj($faktura);
        $faktura->stavke()->delete();
        $faktura->delete();
        return redirect()->route('fakture.index')->with('success', 'Faktura je obrisana.');
    }

    public function prihvati(Faktura $faktura)
    {
        $this->autorizuj($faktura);
        $faktura->update(['status' => 'primljena']);

        if ($faktura->povezana_faktura_id) {
            \App\Models\Faktura::find($faktura->povezana_faktura_id)
                ->update(['status' => 'primljena']);
        }

        return back()->with('success', 'Faktura je prihvaćena.');
    }

    public function odbij(Request $request, Faktura $faktura)
    {
        $this->autorizuj($faktura);

        $request->validate([
            'razlog_odbijanja' => 'required|string|max:500',
        ]);

        $faktura->update([
            'status'           => 'odbijena',
            'razlog_odbijanja' => $request->razlog_odbijanja,
        ]);

        // Azuriraj povezanu fakturu
        if ($faktura->povezana_faktura_id) {
            \App\Models\Faktura::find($faktura->povezana_faktura_id)
                ->update([
                    'status'           => 'odbijena',
                    'razlog_odbijanja' => $request->razlog_odbijanja,
                ]);
        }

        return back()->with('success', 'Faktura je odbijena.');
    }

    public function pdf(Faktura $faktura)
    {
        $this->autorizuj($faktura);
        $faktura->load(['komitent', 'korisnik', 'stavke', 'preduzece']);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('fakture.pdf', compact('faktura'));
        return $pdf->download('faktura-' . $faktura->broj_fakture . '.pdf');
    }

    private function autorizuj(Faktura $faktura)
    {
        $user = auth()->user();

        if ($user->uloga === 'administrator') {
            return;
        }

        if ($faktura->preduzece_id != $user->preduzece_id) {
            abort(403);
        }
    }
}