<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\KorisnikRegistrovan;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ime'      => ['required', 'string', 'max:50'],
            'prezime'  => ['required', 'string', 'max:50'],
            'email'    => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'uloga'    => ['required', 'in:racunovodja,direktor'],
        ]);

       $user = User::create([
            'ime'          => $request->ime,
            'prezime'      => $request->prezime,
            'email'        => $request->email,
            'lozinka'      => Hash::make($request->password),
            'uloga'        => $request->uloga,
            'preduzece_id' => null,
            'aktivan'      => true,
            'status'       => 'na_cekanju',
        ]);

        event(new Registered($user));
        Auth::login($user);

        try {
        Mail::to($user->email)->send(new KorisnikRegistrovan($user));
        } catch (\Exception $e) {
            \Log::error('Mail error: ' . $e->getMessage());
        }

        return redirect()->route('preduzece.create');
    }
}