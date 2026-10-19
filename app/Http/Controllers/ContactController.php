<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ], [
            'name.required' => 'Veuillez renseigner votre nom complet.',
            'email.required' => 'Veuillez renseigner une adresse email valide.',
            'email.email' => 'L\'adresse email n\'est pas valide.',
            'subject.required' => 'Veuillez préciser l\'objet de votre message.',
            'message.required' => 'Veuillez saisir votre message.',
            'message.min' => 'Votre message doit contenir au moins 10 caractères.',
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Votre message a été transmis avec succès à l\'administration de l\'INSG. Nous vous répondrons dans les plus brefs délais.');
    }
}

