<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Preduzece;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Kreiraj test preduzeće
        $preduzece = Preduzece::create([
            'naziv'        => 'Test DOO',
            'pib'          => '123456789',
            'maticni_broj' => '12345678',
            'adresa'       => 'Testna ulica 1, Beograd',
            'email'        => 'test@testdoo.rs',
            'telefon'      => '011123456',
        ]);

        // Kreiraj administratora
        User::create([
            'ime'          => 'Admin',
            'prezime'      => 'Adminovic',
            'email'        => 'admin@efaktura.rs',
            'lozinka'      => Hash::make('password'),
            'uloga'        => 'administrator',
            'preduzece_id' => null,
            'aktivan'      => true,
        ]);

        // Kreiraj računovođu za test preduzeće
        User::create([
            'ime'          => 'Marko',
            'prezime'      => 'Markovic',
            'email'        => 'marko@testdoo.rs',
            'lozinka'      => Hash::make('password'),
            'uloga'        => 'racunovodja',
            'preduzece_id' => $preduzece->id,
            'aktivan'      => true,
        ]);
    }
}