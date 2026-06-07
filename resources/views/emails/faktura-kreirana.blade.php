<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: #1e3a8a; color: white; padding: 30px; text-align: center; }
        .header .logo { font-size: 28px; font-weight: 900; }
        .header .subtitle { color: #93c5fd; font-size: 14px; margin-top: 5px; }
        .body { padding: 40px; }
        .body h2 { color: #1e3a8a; margin-bottom: 20px; }
        .body p { color: #555; line-height: 1.7; margin-bottom: 15px; }
        .info-box { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .info-box table { width: 100%; border-collapse: collapse; }
        .info-box td { padding: 6px 0; color: #555; font-size: 14px; }
        .info-box td:first-child { font-weight: bold; color: #1e3a8a; width: 40%; }
        .total { background: #1e3a8a; color: white; padding: 15px 20px; border-radius: 8px; margin: 20px 0; text-align: right; font-size: 18px; font-weight: bold; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #999; font-size: 12px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">eFaktura</div>
            <div class="subtitle">Sistem za elektronske fakture</div>
        </div>
        <div class="body">
            <h2>Nova faktura je stigla!</h2>
            <p>Poštovani, preduzeće <strong>{{ $faktura->preduzece->naziv }}</strong> vam je uputilo novu fakturu.</p>

            <div class="info-box">
                <table>
                    <tr>
                        <td>Broj fakture:</td>
                        <td>{{ $faktura->broj_fakture }}</td>
                    </tr>
                    <tr>
                        <td>Datum izdavanja:</td>
                        <td>{{ $faktura->datum_izdavanja->format('d.m.Y') }}</td>
                    </tr>
                    <tr>
                        <td>Datum valute:</td>
                        <td>{{ $faktura->datum_valute->format('d.m.Y') }}</td>
                    </tr>
                    <tr>
                        <td>Valuta:</td>
                        <td>{{ $faktura->valuta }}</td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>{{ ucfirst($faktura->status) }}</td>
                    </tr>
                </table>
            </div>

            <div class="total">
                Ukupan iznos: {{ number_format($faktura->stavke->sum('ukupno'), 2) }} {{ $faktura->valuta }}
            </div>

            <p>Za pregled detalja fakture, prijavite se na eFaktura portal.</p>
        </div>
        <div class="footer">
            <p>© 2026 eFaktura — Državni univerzitet u Novom Pazaru</p>
            <p>Republika Srbija · Ministarstvo finansija · Poreska uprava</p>
        </div>
    </div>
</body>
</html>