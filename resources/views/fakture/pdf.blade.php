<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <title>Faktura {{ $faktura->broj_fakture }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; padding: 30px; }
        
        .header { display: table; width: 100%; margin-bottom: 30px; }
        .header-left { display: table-cell; width: 50%; vertical-align: top; }
        .header-right { display: table-cell; width: 50%; vertical-align: top; text-align: right; }
        
        .company-name { font-size: 20px; font-weight: bold; color: #1e3a8a; margin-bottom: 5px; }
        .faktura-title { font-size: 24px; font-weight: bold; color: #1e3a8a; margin-bottom: 10px; }
        .faktura-broj { font-size: 14px; color: #555; }
        
        hr { border: none; border-top: 2px solid #1e3a8a; margin: 20px 0; }
        
        .info-table { display: table; width: 100%; margin-bottom: 25px; }
        .info-left { display: table-cell; width: 50%; vertical-align: top; }
        .info-right { display: table-cell; width: 50%; vertical-align: top; }
        
        .info-box { background: #f8f9fa; border: 1px solid #ddd; border-radius: 5px; padding: 12px; margin-right: 10px; }
        .info-box h3 { font-size: 11px; color: #888; text-transform: uppercase; margin-bottom: 8px; }
        .info-box p { margin-bottom: 4px; font-size: 12px; }
        .info-box .bold { font-weight: bold; font-size: 13px; }
        
        .status-badge { display: inline-block; padding: 3px 10px; border-radius: 3px; font-size: 11px; font-weight: bold; }
        .status-poslata { background: #dbeafe; color: #1d4ed8; }
        .status-primljena { background: #fef9c3; color: #854d0e; }
        .status-placena { background: #dcfce7; color: #166534; }
        .status-odbijena { background: #fee2e2; color: #991b1b; }

        .ziro-box { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 5px; padding: 12px; margin-top: 15px; }
        .ziro-box h3 { font-size: 11px; color: #1e3a8a; text-transform: uppercase; margin-bottom: 8px; font-weight: bold; }
        .ziro-item { display: table; width: 100%; margin-bottom: 4px; }
        .ziro-num { display: table-cell; width: 20px; background: #1e3a8a; color: white; font-weight: bold; font-size: 10px; text-align: center; padding: 2px; border-radius: 50%; }
        .ziro-val { display: table-cell; padding-left: 8px; font-weight: bold; color: #1e3a8a; font-size: 12px; }
        
        table.stavke { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.stavke thead tr { background: #1e3a8a; color: white; }
        table.stavke thead th { padding: 10px 8px; text-align: left; font-size: 11px; }
        table.stavke thead th.right { text-align: right; }
        table.stavke tbody tr:nth-child(even) { background: #f8f9fa; }
        table.stavke tbody td { padding: 8px; border-bottom: 1px solid #eee; font-size: 12px; }
        table.stavke tbody td.right { text-align: right; }
        table.stavke tfoot tr { background: #1e3a8a; color: white; }
        table.stavke tfoot td { padding: 10px 8px; font-weight: bold; }
        table.stavke tfoot td.right { text-align: right; font-size: 14px; }
        
        .footer { margin-top: 40px; border-top: 1px solid #ddd; padding-top: 15px; font-size: 10px; color: #888; text-align: center; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="header-left">
            <div class="company-name">{{ $faktura->preduzece->naziv }}</div>
            <p>PIB: {{ $faktura->preduzece->pib }}</p>
            <p>MB: {{ $faktura->preduzece->maticni_broj }}</p>
            <p>{{ $faktura->preduzece->adresa }}</p>
            <p>{{ $faktura->preduzece->email }}</p>
            <p>{{ $faktura->preduzece->telefon }}</p>
        </div>
        <div class="header-right">
            <div class="faktura-title">FAKTURA</div>
            <div class="faktura-broj">Broj: <strong>{{ $faktura->broj_fakture }}</strong></div>
            <p style="margin-top:8px;">Datum izdavanja: <strong>{{ $faktura->datum_izdavanja->format('d.m.Y') }}</strong></p>
            <p>Datum valute: <strong>{{ $faktura->datum_valute->format('d.m.Y') }}</strong></p>
            <p style="margin-top:8px;">
                <span class="status-badge status-{{ $faktura->status }}">{{ ucfirst($faktura->status) }}</span>
            </p>
        </div>
    </div>

    <hr>

    <!-- Komitent i detalji -->
    <div class="info-table">
        <div class="info-left">
            <div class="info-box">
                <h3>Primalac / Komitent</h3>
                <p class="bold">{{ $faktura->komitent->naziv }}</p>
                <p>PIB: {{ $faktura->komitent->pib }}</p>
                <p>{{ $faktura->komitent->adresa }}</p>
                @if($faktura->komitent->email)
                <p>{{ $faktura->komitent->email }}</p>
                @endif
                @if($faktura->komitent->telefon)
                <p>{{ $faktura->komitent->telefon }}</p>
                @endif
            </div>
        </div>
        <div class="info-right">
            <div class="info-box" style="margin-right:0; margin-left:10px;">
                <h3>Detalji fakture</h3>
                <p>Tip: <strong>{{ ucfirst($faktura->tip) }}</strong></p>
                <p>Valuta plaćanja: <strong>{{ $faktura->valuta }}</strong></p>
                <p>Kreirao: <strong>{{ $faktura->korisnik->ime }} {{ $faktura->korisnik->prezime }}</strong></p>
                @if($faktura->napomena)
                <p style="margin-top:6px;">Napomena: {{ $faktura->napomena }}</p>
                @endif
            </div>

            @if($faktura->preduzece->ziroRacuni->count() > 0)
            <div class="ziro-box">
                <h3>Žiro računi za plaćanje</h3>
                @foreach($faktura->preduzece->ziroRacuni as $racun)
                <div class="ziro-item">
                    <span class="ziro-num">{{ $racun->redosled }}</span>
                    <span class="ziro-val">{{ $racun->broj_racuna }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

    <!-- Stavke -->
    <table class="stavke">
        <thead>
            <tr>
                <th>#</th>
                <th>Naziv</th>
                <th class="right">Količina</th>
                <th>Jed. mere</th>
                <th class="right">Cena bez PDV</th>
                <th class="right">PDV %</th>
                <th class="right">Iznos PDV</th>
                <th class="right">Ukupno</th>
            </tr>
        </thead>
        <tbody>
            @foreach($faktura->stavke as $i => $stavka)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $stavka->naziv }}</td>
                <td class="right">{{ $stavka->kolicina }}</td>
                <td>{{ $stavka->jedinica_mere }}</td>
                <td class="right">{{ number_format($stavka->cena_bez_pdv, 2) }}</td>
                <td class="right">{{ $stavka->pdv_stopa }}%</td>
                <td class="right">{{ number_format($stavka->iznos_pdv, 2) }}</td>
                <td class="right">{{ number_format($stavka->ukupno, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" style="text-align:right;">UKUPNO ZA UPLATU:</td>
                <td class="right">{{ number_format($faktura->stavke->sum('ukupno'), 2) }} {{ $faktura->valuta }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        Dokument generisan automatski putem eFaktura sistema &bull; {{ now()->format('d.m.Y H:i') }}
    </div>

</body>
</html>