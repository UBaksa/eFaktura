<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'ime'     => 'required|string|max:50',
            'prezime' => 'required|string|max:50',
            'email'   => 'required|email|max:100|unique:users,email,' . auth()->id(),
        ]);

        $request->user()->update([
            'ime'     => $request->ime,
            'prezime' => $request->prezime,
            'email'   => $request->email,
        ]);

        return Redirect::route('profile.edit')->with('success', 'Profil je uspešno izmenjen.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->lozinka)) {
            return back()->withErrors(['current_password' => 'Trenutna lozinka nije ispravna.']);
        }

        auth()->user()->update([
            'lozinka' => Hash::make($request->password),
        ]);

        return Redirect::route('profile.edit')->with('success', 'Lozinka je uspešno promenjena.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, auth()->user()->lozinka)) {
            return back()->withErrors(['password' => 'Lozinka nije ispravna.']);
        }

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}