<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    public function index(Request $request)
    {
        $query = Actualite::published();

        if ($request->filled('categorie')) {
            $query->where('category', $request->categorie);
        }

        if ($request->filled('q')) {
            $searchTerm = '%' . $request->q . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('excerpt', 'like', $searchTerm)
                  ->orWhere('content', 'like', $searchTerm);
            });
        }

        $actualites = $query->paginate(4)->withQueryString();
        $categories = Actualite::select('category')->distinct()->pluck('category');

        return view('actualites.index', compact('actualites', 'categories'));
    }

    public function show($slug)
    {
        $actualite = Actualite::where('slug', $slug)->firstOrFail();
        $actualite->increment('views_count');

        $recentActualites = Actualite::published()
            ->where('id', '!=', $actualite->id)
            ->take(4)
            ->get();

        return view('actualites.show', compact('actualite', 'recentActualites'));
    }
}

