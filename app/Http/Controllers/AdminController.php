<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Faktura;
use App\Models\Preduzece;
use App\Mail\NalogOdobren;
use App\Mail\NalogOdbijen;
use App\Mail\NalogDeaktiviran;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $ukupnoKorisnika = User::where('uloga', '!=', 'administrator')->count();
        $ukupnoFaktura = Faktura::count();
        $ukupnoPreduzeca = Preduzece::count();
        $poslateFakture = Faktura::where('status', 'poslata')->count();

        return view('admin.index', compact(
            'ukupnoKorisnika', 'ukupnoFaktura',
            'ukupnoPreduzeca', 'poslateFakture'
        ));
    }

    public function korisnici(Request $request)
    {
        $pretraga = $request->input('pretraga');

        $query = User::with('preduzece')->where('uloga', '!=', 'administrator');

        if ($pretraga) {
            $query->where(function($q) use ($pretraga) {
                $q->where('ime', 'like', '%' . $pretraga . '%')
                  ->orWhere('prezime', 'like', '%' . $pretraga . '%')
                  ->orWhere('email', 'like', '%' . $pretraga . '%')
                  ->orWhereHas('preduzece', function($q2) use ($pretraga) {
                      $q2->where('naziv', 'like', '%' . $pretraga . '%');
                  });
            });
        }

        $sviKorisnici = $query->get();
        $naCekanju = $sviKorisnici->where('status', 'na_cekanju');
        $odobreni = $sviKorisnici->where('status', 'odobren');
        $odbijeni = $sviKorisnici->where('status', 'odbijen');

        return view('admin.korisnici', compact('naCekanju', 'odobreni', 'odbijeni', 'pretraga'));
    }

    public function toggleAktivan(User $user, Request $request)
    {
        $noviStatus = !$user->aktivan;
        $user->update(['aktivan' => $noviStatus]);

        if (!$noviStatus) {
            $obrazlozenje = $request->obrazlozenje ?? 'Administrator je privremeno deaktivirao vaš nalog.';
            try {
                Mail::to('ujkanovicbakir@gmail.com')->send(new NalogDeaktiviran($user, $obrazlozenje));
            } catch (\Exception $e) {
                \Log::error('Mail error: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Status korisnika je promenjen.');
    }

    public function fakture()
    {
        $fakture = Faktura::with(['preduzece', 'komitent', 'korisnik'])->latest()->paginate(20);
        return view('admin.fakture', compact('fakture'));
    }

    public function statistike()
    {
        $fakturePoBrojuMesecno = Faktura::selectRaw('MONTH(datum_izdavanja) as mesec, COUNT(*) as broj')
            ->groupBy('mesec')
            ->orderBy('mesec')
            ->get();

        $fakturePoStatusu = Faktura::selectRaw('status, COUNT(*) as broj')
            ->groupBy('status')
            ->get();

        return view('admin.statistike', compact('fakturePoBrojuMesecno', 'fakturePoStatusu'));
    }

    public function odobri(User $user)
    {
        $user->update(['status' => 'odobren', 'aktivan' => true]);
        try {
            Mail::to('ujkanovicbakir@gmail.com')->send(new \App\Mail\VerifikacijaEmaila($user));
        } catch (\Exception $e) {
            \Log::error('Mail error: ' . $e->getMessage());
        }
        return back()->with('success', 'Korisnik ' . $user->ime . ' ' . $user->prezime . ' je odobren. Verifikacioni mail je poslat.');
    }

    public function odbij(User $user)
    {
        $user->update(['status' => 'odbijen', 'aktivan' => false]);
        try {
            Mail::to('ujkanovicbakir@gmail.com')->send(new NalogOdbijen($user));
        } catch (\Exception $e) {
            \Log::error('Mail error: ' . $e->getMessage());
        }
        return back()->with('success', 'Korisnik ' . $user->ime . ' ' . $user->prezime . ' je odbijen.');
    }

    public function obrisiKorisnika(User $user)
    {
        $ime = $user->ime . ' ' . $user->prezime;
        $user->delete();
        return back()->with('success', 'Korisnik ' . $ime . ' je obrisan iz sistema.');
    }

    public function preduzeca(Request $request)
    {
        $pretraga = $request->input('pretraga');

        $query = \App\Models\Preduzece::withCount('korisnici');

        if ($pretraga) {
            $query->where(function($q) use ($pretraga) {
                $q->where('naziv', 'like', '%' . $pretraga . '%')
                  ->orWhere('pib', 'like', '%' . $pretraga . '%')
                  ->orWhere('maticni_broj', 'like', '%' . $pretraga . '%');
            });
        }

        $preduzeca = $query->get();

        return view('admin.preduzeca', compact('preduzeca', 'pretraga'));
    }

    public function obrisiPreduzece(\App\Models\Preduzece $preduzece)
    {
        foreach ($preduzece->fakture as $faktura) {
            $faktura->stavke()->delete();
        }
        $preduzece->fakture()->delete();
        $preduzece->komitenti()->delete();
        $preduzece->korisnici()->delete();
        $preduzece->saldoListe()->delete();
        $preduzece->ziroRacuni()->delete();
        $preduzece->delete();

        return back()->with('success', 'Preduzeće i svi povezani podaci su obrisani.');
    }

    public function editPreduzece(\App\Models\Preduzece $preduzece)
    {
        return view('admin.preduzece-edit', compact('preduzece'));
    }

    public function updatePreduzece(Request $request, \App\Models\Preduzece $preduzece)
    {
        $request->validate([
            'naziv'            => 'required|string|max:200',
            'adresa'           => 'required|string|max:200',
            'email'            => 'required|email|max:100',
            'telefon'          => 'required|string|max:20',
            'godina_osnivanja' => 'nullable|integer|min:1800|max:' . date('Y'),
            'ime_vlasnika'     => 'nullable|string|max:100',
            'mesto'            => 'nullable|string|max:100',
            'vrsta_preduzeca'  => 'nullable|in:mikro,malo,srednje,veliko',
            'vrsta_delatnosti' => 'nullable|string|max:100',
            'ziro_racuni'      => 'nullable|array|max:3',
            'ziro_racuni.*'    => 'nullable|string|max:20',
        ]);

        $preduzece->update($request->only([
            'naziv', 'adresa', 'email', 'telefon',
            'godina_osnivanja', 'ime_vlasnika', 'mesto',
            'vrsta_preduzeca', 'vrsta_delatnosti'
        ]));

        $preduzece->ziroRacuni()->delete();
        if ($request->filled('ziro_racuni')) {
            foreach ($request->ziro_racuni as $index => $brojRacuna) {
                if (!empty($brojRacuna)) {
                    \App\Models\ZiroRacun::create([
                        'preduzece_id' => $preduzece->id,
                        'broj_racuna'  => $brojRacuna,
                        'redosled'     => $index + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.preduzeca')->with('success', 'Preduzeće je uspešno izmenjeno.');
    }
}