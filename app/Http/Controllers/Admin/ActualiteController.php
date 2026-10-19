<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActualiteController extends Controller
{
    use HandlesUploads;

    public function index(Request $request)
    {
        $query = Actualite::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $actualites = $query->orderByDesc('published_at')->orderByDesc('id')->paginate(10)->withQueryString();
        $categories = Actualite::select('category')->distinct()->pluck('category');

        return view('admin.actualites.index', compact('actualites', 'categories'));
    }

    public function create()
    {
        $actualite = new Actualite([
            'published_at' => now(),
            'is_featured' => false,
            'category' => 'Vie académique',
        ]);
        return view('admin.actualites.form', compact('actualite'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:actualites,slug',
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'is_featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
            $count = Actualite::where('slug', 'like', "{$data['slug']}%")->count();
            if ($count > 0) {
                $data['slug'] .= '-' . ($count + 1);
            }
        }

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'actualites', 'assets/images/1759791578740.jpg.jpeg');
        $data['image'] = $imagePath;
        $data['is_featured'] = $request->boolean('is_featured', false);
        $data['published_at'] = $request->filled('published_at') ? $request->input('published_at') : now();

        Actualite::create($data);

        return redirect()->route('admin.actualites.index')->with('success', 'L\'actualité a été publiée avec succès.');
    }

    public function edit(Actualite $actualite)
    {
        return view('admin.actualites.form', compact('actualite'));
    }

    public function update(Request $request, Actualite $actualite)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:actualites,slug,' . $actualite->id,
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'is_featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'actualites', $actualite->image);
        $data['image'] = $imagePath;
        $data['is_featured'] = $request->boolean('is_featured', false);

        $actualite->update($data);

        return redirect()->route('admin.actualites.index')->with('success', 'L\'actualité a été mise à jour.');
    }

    public function destroy(Actualite $actualite)
    {
        $actualite->delete();
        return redirect()->route('admin.actualites.index')->with('success', 'L\'actualité a été supprimée.');
    }

    public function toggleFeatured(Actualite $actualite)
    {
        $actualite->update(['is_featured' => !$actualite->is_featured]);
        $status = $actualite->is_featured ? 'mise à la une' : 'retirée de la une';
        return back()->with('success', "L'actualité a été {$status}.");
    }
}

