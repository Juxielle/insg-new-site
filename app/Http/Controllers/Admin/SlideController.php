<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    use HandlesUploads;

    public function index()
    {
        $slides = Slide::orderBy('order')->orderByDesc('id')->get();
        return view('admin.slides.index', compact('slides'));
    }

    public function create()
    {
        $slide = new Slide(['order' => Slide::max('order') + 1, 'is_active' => true]);
        return view('admin.slides.form', compact('slide'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'link_url' => 'nullable|string|max:255',
            'link_text' => 'nullable|string|max:100',
            'order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'slides', 'assets/images/insg-back-1.jpeg');
        $data['image'] = $imagePath;
        $data['is_active'] = $request->boolean('is_active', true);

        Slide::create($data);

        return redirect()->route('admin.slides.index')->with('success', 'Le slide a été créé avec succès.');
    }

    public function edit(Slide $slide)
    {
        return view('admin.slides.form', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'link_url' => 'nullable|string|max:255',
            'link_text' => 'nullable|string|max:100',
            'order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $imagePath = $this->handleImageUpload($request, 'image_file', 'image', 'slides', $slide->image);
        $data['image'] = $imagePath;
        $data['is_active'] = $request->boolean('is_active', false);

        $slide->update($data);

        return redirect()->route('admin.slides.index')->with('success', 'Le slide a été mis à jour avec succès.');
    }

    public function destroy(Slide $slide)
    {
        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Le slide a été supprimé.');
    }

    public function toggle(Slide $slide)
    {
        $slide->update(['is_active' => !$slide->is_active]);
        $status = $slide->is_active ? 'activé' : 'désactivé';
        return back()->with('success', "Le slide a été {$status}.");
    }
}

