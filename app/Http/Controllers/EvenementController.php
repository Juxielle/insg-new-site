<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;

class EvenementController extends Controller
{
    public function index()
    {
        $evenements = Evenement::upcoming()->paginate(2);
        return view('pages.evenements', compact('evenements'));
    }

    public function show($slug)
    {
        $evenement = Evenement::where('slug', $slug)->firstOrFail();
        return view('evenements.show', compact('evenement'));
    }
}

