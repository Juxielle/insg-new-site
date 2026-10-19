<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistique;
use Illuminate\Http\Request;

class StatistiqueController extends Controller
{
    public function index()
    {
        $statistiques = Statistique::orderBy('order')->orderBy('id')->get();
        return view('admin.statistiques.index', compact('statistiques'));
    }

    public function create()
    {
        $statistique = new Statistique([
            'order' => Statistique::max('order') + 1,
            'is_active' => true,
        ]);
        return view('admin.statistiques.form', compact('statistique'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => 'required|string|max:50|unique:statistiques,key',
            'value' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        Statistique::create($data);

        return redirect()->route('admin.statistiques.index')->with('success', 'La statistique a été créée avec succès.');
    }

    public function edit(Statistique $statistique)
    {
        return view('admin.statistiques.form', compact('statistique'));
    }

    public function update(Request $request, Statistique $statistique)
    {
        $data = $request->validate([
            'key' => 'required|string|max:50|unique:statistiques,key,' . $statistique->id,
            'value' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->boolean('is_active', false);

        $statistique->update($data);

        return redirect()->route('admin.statistiques.index')->with('success', 'La statistique a été mise à jour.');
    }

    public function destroy(Statistique $statistique)
    {
        $statistique->delete();
        return redirect()->route('admin.statistiques.index')->with('success', 'La statistique a été supprimée.');
    }

    public function toggle(Statistique $statistique)
    {
        $statistique->update(['is_active' => !$statistique->is_active]);
        $status = $statistique->is_active ? 'activée' : 'désactivée';
        return back()->with('success', "La statistique a été {$status}.");
    }
}

