<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PartenaireController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        $partenaires = Partenaire::orderBy('order')->orderBy('name')->get();
        return view('admin.partenaires.index', compact('partenaires'));
    }

    public function create()
    {
        $partenaire = new Partenaire([
            'order' => Partenaire::max('order') + 1,
            'category' => 'Bancaire & Finance',
        ]);
        return view('admin.partenaires.form', compact('partenaire'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:partenaires,slug',
            'category' => 'required|string|max:100',
            'logo' => 'nullable|string',
            'logo_file' => 'nullable|image|max:5120',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $logoPath = $this->handleImageUpload($request, 'logo_file', 'logo', 'partenaires', 'assets/images/partners/bgfi.png');
        $data['logo'] = $logoPath;

        Partenaire::create($data);

        return redirect()->route('admin.partenaires.index')->with('success', 'Le partenaire a été ajouté avec succès.');
    }

    public function edit(Partenaire $partenaire)
    {
        return view('admin.partenaires.form', compact('partenaire'));
    }

    public function update(Request $request, Partenaire $partenaire)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:partenaires,slug,' . $partenaire->id,
            'category' => 'required|string|max:100',
            'logo' => 'nullable|string',
            'logo_file' => 'nullable|image|max:5120',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:0',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $logoPath = $this->handleImageUpload($request, 'logo_file', 'logo', 'partenaires', $partenaire->logo);
        $data['logo'] = $logoPath;

        $partenaire->update($data);

        return redirect()->route('admin.partenaires.index')->with('success', 'Le partenaire a été mis à jour.');
    }

    public function destroy(Partenaire $partenaire)
    {
        $partenaire->delete();
        return redirect()->route('admin.partenaires.index')->with('success', 'Le partenaire a été supprimé.');
    }
}

