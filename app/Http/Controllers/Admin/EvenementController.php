<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evenement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EvenementController extends Controller
{
    use HandlesUploads;

    public function index(Request $request)
    {
        $query = Evenement::query();

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $evenements = $query->orderByDesc('date_start')->paginate(10)->withQueryString();

        return view('admin.evenements.index', compact('evenements'));
    }

    public function create()
    {
        $evenement = new Evenement([
            'date_start' => now()->addDays(7)->setTime(9, 0),
            'date_end' => now()->addDays(7)->setTime(17, 0),
            'location' => 'Campus INSG, Libreville',
        ]);
        return view('admin.evenements.form', compact('evenement'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:evenements,slug',
            'date_start' => 'required|date',
            'date_end' => 'nullable|date|after_or_equal:date_start',
            'location' => 'required|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'evenements', 'assets/images/insg-back-8.jpeg');
        $data['image'] = $imagePath;

        Evenement::create($data);

        return redirect()->route('admin.evenements.index')->with('success', 'L\'événement a été programmé avec succès.');
    }

    public function edit(Evenement $evenement)
    {
        return view('admin.evenements.form', compact('evenement'));
    }

    public function update(Request $request, Evenement $evenement)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:evenements,slug,' . $evenement->id,
            'date_start' => 'required|date',
            'date_end' => 'nullable|date|after_or_equal:date_start',
            'location' => 'required|string|max:255',
            'organizer' => 'nullable|string|max:255',
            'summary' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'evenements', $evenement->image);
        $data['image'] = $imagePath;

        $evenement->update($data);

        return redirect()->route('admin.evenements.index')->with('success', 'L\'événement a été mis à jour.');
    }

    public function destroy(Evenement $evenement)
    {
        $evenement->delete();
        return redirect()->route('admin.evenements.index')->with('success', 'L\'événement a été supprimé.');
    }
}

