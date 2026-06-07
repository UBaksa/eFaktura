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
        .btn-container { text-align: center; margin: 30px 0; }
        .btn { display: inline-block; background: #1e3a8a; color: white; padding: 15px 40px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 16px; }
        .warning { background: #fff7ed; border: 1px solid #fdba74; border-radius: 8px; padding: 15px 20px; margin: 20px 0; }
        .warning p { color: #9a3412; margin: 0; font-size: 13px; }
        .link-box { background: #f8f9fa; border-radius: 8px; padding: 15px; margin: 15px 0; word-break: break-all; font-size: 12px; color: #555; }
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
            <p>Vaš nalog je odobren od strane administratora! Da biste pristupili eFaktura portalu, potrebno je da verifikujete vašu email adresu.</p>
            
            <div class="btn-container">
                <a href="{{ $verifikacioniLink }}" class="btn">
                    Verifikuj email adresu
                </a>
            </div>

            <div class="warning">
                <p>⚠️ Ovaj link je važeći <strong>24 sata</strong>. Nakon isteka, kontaktirajte administratora za novi link.</p>
            </div>

            <p>Ako dugme ne radi, kopirajte i nalepite ovaj link u browser:</p>
            <div class="link-box">{{ $verifikacioniLink }}</div>

            <p>Ako niste zatražili ovaj nalog, ignorišite ovaj email.</p>
        </div>
        <div class="footer">
            <p>Republika Srbija · Ministarstvo finansija · Poreska uprava</p>
        </div>
    </div>
</body>
</html>