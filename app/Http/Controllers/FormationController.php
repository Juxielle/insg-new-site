<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index(Request $request)
    {
        $query = Formation::active();

        $level = $request->input('niveau') ?? $request->input('level');
        if (!empty($level)) {
            $query->where('level', $level);
        }

        $dept = $request->input('departement') ?? $request->input('department');
        if (!empty($dept)) {
            $query->where('department', $dept);
        }

        $search = $request->input('q') ?? $request->input('search');
        if (!empty($search)) {
            $searchTerm = '%' . $search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', $searchTerm)
                  ->orWhere('summary', 'like', $searchTerm)
                  ->orWhere('description', 'like', $searchTerm);
            });
        }

        $formations = $query->paginate(4)->withQueryString();
        $niveaux = Formation::select('level')->distinct()->pluck('level');
        $departements = Formation::select('department')->distinct()->pluck('department');

        return view('formations.index', compact('formations', 'niveaux', 'departements'));
    }

    public function show($slug)
    {
        $formation = Formation::where('slug', $slug)->firstOrFail();

        $relatedFormations = Formation::active()
            ->where('id', '!=', $formation->id)
            ->where(function ($q) use ($formation) {
                $q->where('level', $formation->level)
                  ->orWhere('department', $formation->department);
            })
            ->take(3)
            ->get();

        return view('formations.show', compact('formation', 'relatedFormations'));
    }
}
