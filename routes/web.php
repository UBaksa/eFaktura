<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KomitentController;
use App\Http\Controllers\FakturaController;
use App\Http\Controllers\SaldoListaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PreduzeceController;

Route::get('/', function () {
    return view('home');
});
Route::get('/verifikacija/{id}', function ($id) {
    $user = \App\Models\User::findOrFail($id);
    
    if ($user->email_verified_at) {
        return redirect()->route('login')->with('status', 'Email je već verifikovan. Možete se prijaviti.');
    }

    $user->update(['email_verified_at' => now()]);

    return redirect()->route('login')->with('status', 'Email je uspešno verifikovan! Možete se prijaviti.');
})->middleware('signed')->name('verifikacija.potvrdi');
// Preduzeće - javne rute (bez auth)
Route::middleware(['auth'])->group(function () {
Route::get('/preduzece/novo', [PreduzeceController::class, 'create'])->name('preduzece.create');
Route::post('/preduzece/novo', [PreduzeceController::class, 'store'])->name('preduzece.store');
});

Route::middleware(['auth', 'proveri.status'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Komitenti
    Route::resource('komitenti', KomitentController::class)->parameters(['komitenti' => 'komitent']);

    // Fakture
    Route::resource('fakture', FakturaController::class)->parameters(['fakture' => 'faktura']);
    Route::patch('/fakture/{faktura}/prihvati', [FakturaController::class, 'prihvati'])->name('fakture.prihvati');
    Route::patch('/fakture/{faktura}/odbij', [FakturaController::class, 'odbij'])->name('fakture.odbij');
    Route::get('/fakture/{faktura}/pdf', [FakturaController::class, 'pdf'])->name('fakture.pdf');

    // Saldo lista
    Route::get('/saldo-lista', [SaldoListaController::class, 'index'])->name('saldo.index');
    Route::post('/saldo-lista/generisi', [SaldoListaController::class, 'generisi'])->name('saldo.generisi');

    // Admin panel
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/korisnici', [AdminController::class, 'korisnici'])->name('korisnici');
        Route::patch('/korisnici/{user}/toggle', [AdminController::class, 'toggleAktivan'])->name('korisnici.toggle');
        Route::patch('/korisnici/{user}/odobri', [AdminController::class, 'odobri'])->name('korisnici.odobri');
        Route::patch('/korisnici/{user}/odbij', [AdminController::class, 'odbij'])->name('korisnici.odbij');
        Route::delete('/korisnici/{user}', [AdminController::class, 'obrisiKorisnika'])->name('korisnici.obrisi');
        Route::get('/fakture', [AdminController::class, 'fakture'])->name('fakture');
        Route::get('/statistike', [AdminController::class, 'statistike'])->name('statistike');
        Route::get('/preduzeca', [AdminController::class, 'preduzeca'])->name('preduzeca');
        Route::delete('/preduzeca/{preduzece}', [AdminController::class, 'obrisiPreduzece'])->name('preduzeca.obrisi');
        Route::get('/preduzeca/{preduzece}/edit', [AdminController::class, 'editPreduzece'])->name('preduzeca.edit');
        Route::patch('/preduzeca/{preduzece}', [AdminController::class, 'updatePreduzece'])->name('preduzeca.update');
        Route::get('/preduzece/{preduzece}', [PreduzeceController::class, 'show'])->name('preduzece.show');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';