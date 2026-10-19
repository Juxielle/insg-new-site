<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        $temoignages = Temoignage::orderBy('order')->orderByDesc('id')->get();
        return view('admin.temoignages.index', compact('temoignages'));
    }

    public function create()
    {
        $temoignage = new Temoignage([
            'order' => Temoignage::max('order') + 1,
            'rating' => 5,
            'is_featured' => true,
        ]);
        return view('admin.temoignages.form', compact('temoignage'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'promotion' => 'nullable|string|max:100',
            'content' => 'required|string',
            'avatar' => 'nullable|string',
            'avatar_file' => 'nullable|image|max:5120',
            'rating' => 'required|integer|min:1|max:5',
            'order' => 'required|integer|min:0',
            'is_featured' => 'nullable|boolean',
        ]);

        $avatarPath = $this->handleImageUpload($request, 'avatar_file', 'avatar', 'temoignages', 'assets/images/directeur-1.png');
        $data['avatar'] = $avatarPath;
        $data['is_featured'] = $request->boolean('is_featured', true);

        Temoignage::create($data);

        return redirect()->route('admin.temoignages.index')->with('success', 'Le témoignage a été ajouté avec succès.');
    }

    public function edit(Temoignage $temoignage)
    {
        return view('admin.temoignages.form', compact('temoignage'));
    }

    public function update(Request $request, Temoignage $temoignage)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'promotion' => 'nullable|string|max:100',
            'content' => 'required|string',
            'avatar' => 'nullable|string',
            'avatar_file' => 'nullable|image|max:5120',
            'rating' => 'required|integer|min:1|max:5',
            'order' => 'required|integer|min:0',
            'is_featured' => 'nullable|boolean',
        ]);

        $avatarPath = $this->handleImageUpload($request, 'avatar_file', 'avatar', 'temoignages', $temoignage->avatar);
        $data['avatar'] = $avatarPath;
        $data['is_featured'] = $request->boolean('is_featured', false);

        $temoignage->update($data);

        return redirect()->route('admin.temoignages.index')->with('success', 'Le témoignage a été mis à jour.');
    }

    public function destroy(Temoignage $temoignage)
    {
        $temoignage->delete();
        return redirect()->route('admin.temoignages.index')->with('success', 'Le témoignage a été supprimé.');
    }

    public function toggleFeatured(Temoignage $temoignage)
    {
        $temoignage->update(['is_featured' => !$temoignage->is_featured]);
        $status = $temoignage->is_featured ? 'mis à la une' : 'retiré de la une';
        return back()->with('success', "Le témoignage a été {$status}.");
    }
}

