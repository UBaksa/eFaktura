<!DOCTYPE html>
<html lang="sr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background-color:#f4f4f4;font-family:Arial,sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f4f4;padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1e3a8a;padding:30px;text-align:center;">
                            <div style="font-size:28px;font-weight:900;color:#ffffff;">eFaktura</div>
                            <div style="font-size:14px;color:#93c5fd;margin-top:5px;">Sistem za elektronske fakture</div>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:40px;">
                            <h2 style="color:#1e3a8a;margin-bottom:20px;margin-top:0;">Resetovanje lozinke</h2>
                            <p style="color:#555555;line-height:1.7;margin-bottom:15px;">
                                Primili smo zahtev za resetovanje lozinke za vaš eFaktura nalog.
                            </p>
                            <p style="color:#555555;line-height:1.7;margin-bottom:25px;">
                                Kliknite na dugme ispod da resetujete lozinku:
                            </p>

                            <!-- Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding:10px 0 25px 0;">
                                        <a href="{{ $actionUrl }}"
                                            style="display:inline-block;background-color:#1e3a8a;color:#ffffff;padding:15px 40px;border-radius:8px;text-decoration:none;font-weight:bold;font-size:16px;">
                                            Resetuj lozinku
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Warning box -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="background-color:#fff7ed;border:1px solid #fdba74;border-radius:8px;padding:15px 20px;margin-bottom:20px;">
                                        <p style="color:#9a3412;margin:0;font-size:13px;">
                                            ⚠️ Ovaj link je važeći <strong>60 minuta</strong>. Nakon isteka, zatražite novi link.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="color:#555555;line-height:1.7;margin-top:20px;">
                                Ako dugme ne radi, kopirajte i nalepite ovaj link u browser:
                            </p>

                            <!-- Link box -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="background-color:#f8f9fa;border-radius:8px;padding:15px;word-break:break-all;font-size:12px;color:#555555;">
                                        {{ $actionUrl }}
                                    </td>
                                </tr>
                            </table>

                            <p style="color:#555555;line-height:1.7;margin-top:20px;">
                                Ako niste zatražili resetovanje lozinke, ignorišite ovaj email — vaš nalog je bezbedan.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f8f9fa;padding:20px;text-align:center;border-top:1px solid #eeeeee;">
                            <p style="color:#999999;font-size:12px;margin:0;">Republika Srbija · Ministarstvo finansija · Poreska uprava</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>