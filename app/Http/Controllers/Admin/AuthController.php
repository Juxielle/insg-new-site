<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Affiche la vue du formulaire de connexion au back-office.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    /**
     * Traite la tentative de connexion de l'administrateur.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Veuillez saisir votre adresse email professionnelle.',
            'email.email' => 'Format d\'adresse email invalide.',
            'password.required' => 'Veuillez saisir votre mot de passe.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))->with('success', 'Connexion réussie. Bienvenue dans l\'espace d\'administration de l\'INSG.');
        }

        return back()->withErrors([
            'email' => 'Adresse email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Déconnecte l'administrateur.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Vous avez été déconnecté avec succès.');
    }
}

