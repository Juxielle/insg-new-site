<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infrastructure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InfrastructureController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        $infrastructures = Infrastructure::orderBy('order')->orderBy('id')->get();
        return view('admin.infrastructures.index', compact('infrastructures'));
    }

    public function create()
    {
        $infrastructure = new Infrastructure([
            'order' => Infrastructure::max('order') + 1,
            'is_active' => true,
            'category' => 'Pédagogique',
        ]);
        return view('admin.infrastructures.form', compact('infrastructure'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:infrastructures,slug',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'capacity' => 'nullable|string|max:100',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'infrastructures', 'assets/images/insg-back-4.jpeg');
        $data['image'] = $imagePath;
        $data['is_active'] = $request->boolean('is_active', true);

        Infrastructure::create($data);

        return redirect()->route('admin.infrastructures.index')->with('success', 'L\'infrastructure a été ajoutée avec succès.');
    }

    public function edit(Infrastructure $infrastructure)
    {
        return view('admin.infrastructures.form', compact('infrastructure'));
    }

    public function update(Request $request, Infrastructure $infrastructure)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:infrastructures,slug,' . $infrastructure->id,
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'capacity' => 'nullable|string|max:100',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'infrastructures', $infrastructure->image);
        $data['image'] = $imagePath;
        $data['is_active'] = $request->boolean('is_active', false);

        $infrastructure->update($data);

        return redirect()->route('admin.infrastructures.index')->with('success', 'L\'infrastructure a été mise à jour.');
    }

    public function destroy(Infrastructure $infrastructure)
    {
        $infrastructure->delete();
        return redirect()->route('admin.infrastructures.index')->with('success', 'L\'infrastructure a été supprimée.');
    }

    public function toggle(Infrastructure $infrastructure)
    {
        $infrastructure->update(['is_active' => !$infrastructure->is_active]);
        $status = $infrastructure->is_active ? 'activée' : 'désactivée';
        return back()->with('success', "L'infrastructure a été {$status}.");
    }
}

