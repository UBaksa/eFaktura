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
        .status-box { background: #fee2e2; border: 1px solid #fca5a5; border-radius: 8px; padding: 15px 20px; margin: 20px 0; }
        .status-box p { color: #991b1b; margin: 0; }
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
            <h2>Poštovani {{ $user->ime }},</h2>
            <p>Nažalost, vaš zahtev za pristup eFaktura portalu je odbijen od strane administratora.</p>
            <div class="status-box">
                <p>✕ <strong>Status naloga:</strong> Odbijen</p>
            </div>
            <p>Ukoliko smatrate da je ovo greška ili imate dodatnih pitanja, kontaktirajte administratora sistema.</p>
            <p><strong>Vaši podaci:</strong></p>
            <p>Email: {{ $user->email }}<br>Uloga: {{ ucfirst($user->uloga) }}</p>
        </div>
        <div class="footer">
            <p>© 2026 eFaktura — Državni univerzitet u Novom Pazaru</p>
            <p>Republika Srbija · Ministarstvo finansija · Poreska uprava</p>
        </div>
    </div>
</body>
</html>