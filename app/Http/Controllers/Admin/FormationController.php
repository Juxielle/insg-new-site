<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormationController extends Controller
{
    use HandlesUploads;

    public function index(Request $request)
    {
        $query = Formation::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%");
            });
        }

        if ($request->filled('level')) {
            $query->where('level', $request->input('level'));
        }

        $formations = $query->orderBy('level')->orderBy('title')->paginate(10)->withQueryString();
        $levels = Formation::select('level')->distinct()->pluck('level');

        return view('admin.formations.index', compact('formations', 'levels'));
    }

    public function create()
    {
        $formation = new Formation([
            'is_active' => true,
            'level' => 'Licence Pro',
            'duration' => '3 ans (6 semestres)',
        ]);
        return view('admin.formations.form', compact('formation'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:formations,slug',
            'level' => 'required|string|max:50',
            'department' => 'required|string|max:100',
            'duration' => 'required|string|max:50',
            'summary' => 'required|string',
            'description' => 'required|string',
            'admission_requirements' => 'nullable|string',
            'career_opportunities' => 'nullable|string',
            'curriculum' => 'nullable|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'is_active' => 'nullable|boolean',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'formations', 'assets/images/insg-back-4.jpeg');
        $data['image'] = $imagePath;
        $data['is_active'] = $request->boolean('is_active', true);

        Formation::create($data);

        return redirect()->route('admin.formations.index')->with('success', 'La formation a été enregistrée avec succès.');
    }

    public function edit(Formation $formation)
    {
        return view('admin.formations.form', compact('formation'));
    }

    public function update(Request $request, Formation $formation)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:formations,slug,' . $formation->id,
            'level' => 'required|string|max:50',
            'department' => 'required|string|max:100',
            'duration' => 'required|string|max:50',
            'summary' => 'required|string',
            'description' => 'required|string',
            'admission_requirements' => 'nullable|string',
            'career_opportunities' => 'nullable|string',
            'curriculum' => 'nullable|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'is_active' => 'nullable|boolean',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'formations', $formation->image);
        $data['image'] = $imagePath;
        $data['is_active'] = $request->boolean('is_active', false);

        $formation->update($data);

        return redirect()->route('admin.formations.index')->with('success', 'La formation a été mise à jour.');
    }

    public function destroy(Formation $formation)
    {
        $formation->delete();
        return redirect()->route('admin.formations.index')->with('success', 'La formation a été supprimée.');
    }

    public function toggle(Formation $formation)
    {
        $formation->update(['is_active' => !$formation->is_active]);
        $status = $formation->is_active ? 'activée' : 'désactivée';
        return back()->with('success', "La formation a été {$status}.");
    }
}

