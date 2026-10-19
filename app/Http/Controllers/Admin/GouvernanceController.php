<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gouvernance;
use Illuminate\Http\Request;

class GouvernanceController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        $membres = Gouvernance::orderBy('order')->orderBy('id')->get();
        return view('admin.gouvernances.index', compact('membres'));
    }

    public function create()
    {
        $membre = new Gouvernance([
            'order' => Gouvernance::max('order') + 1,
            'is_active' => true,
        ]);
        return view('admin.gouvernances.form', compact('membre'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'division' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'quote' => 'nullable|string',
            'photo' => 'nullable|string',
            'photo_file' => 'nullable|image|max:5120',
            'order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $photoPath = $this->handleImageUpload($request, 'photo_file', 'photo', 'gouvernance', 'assets/images/directeur-1.png');
        $data['photo'] = $photoPath;
        $data['is_active'] = $request->boolean('is_active', true);

        Gouvernance::create($data);

        return redirect()->route('admin.gouvernances.index')->with('success', 'Le membre de la gouvernance a été ajouté avec succès.');
    }

    public function edit(Gouvernance $gouvernance)
    {
        $membre = $gouvernance;
        return view('admin.gouvernances.form', compact('membre'));
    }

    public function update(Request $request, Gouvernance $gouvernance)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'division' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'quote' => 'nullable|string',
            'photo' => 'nullable|string',
            'photo_file' => 'nullable|image|max:5120',
            'order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $photoPath = $this->handleImageUpload($request, 'photo_file', 'photo', 'gouvernance', $gouvernance->photo);
        $data['photo'] = $photoPath;
        $data['is_active'] = $request->boolean('is_active', false);

        $gouvernance->update($data);

        return redirect()->route('admin.gouvernances.index')->with('success', 'Les informations ont été mises à jour.');
    }

    public function destroy(Gouvernance $gouvernance)
    {
        $gouvernance->delete();
        return redirect()->route('admin.gouvernances.index')->with('success', 'Le membre a été retiré de la gouvernance.');
    }

    public function toggle(Gouvernance $gouvernance)
    {
        $gouvernance->update(['is_active' => !$gouvernance->is_active]);
        $status = $gouvernance->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "Le membre a été {$status}.");
    }
}

