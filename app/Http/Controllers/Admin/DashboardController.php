<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\ContactMessage;
use App\Models\Evenement;
use App\Models\Formation;
use App\Models\Gouvernance;
use App\Models\Infrastructure;
use App\Models\Partenaire;
use App\Models\Slide;
use App\Models\Statistique;
use App\Models\Temoignage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'slides_count' => Slide::count(),
            'slides_active' => Slide::where('is_active', true)->count(),
            'actualites_count' => Actualite::count(),
            'actualites_featured' => Actualite::where('is_featured', true)->count(),
            'formations_count' => Formation::count(),
            'evenements_count' => Evenement::count(),
            'statistiques_count' => Statistique::count(),
            'temoignages_count' => Temoignage::count(),
            'gouvernance_count' => Gouvernance::count(),
            'infrastructures_count' => Infrastructure::count(),
            'partenaires_count' => Partenaire::count(),
            'messages_count' => ContactMessage::count(),
            'messages_unread' => ContactMessage::where('is_read', false)->count(),
        ];

        $latestMessages = ContactMessage::latest()->take(5)->get();
        $latestActualites = Actualite::latest('published_at')->take(5)->get();
        $activeSlides = Slide::orderBy('order')->take(4)->get();

        return view('admin.dashboard', compact('stats', 'latestMessages', 'latestActualites', 'activeSlides'));
    }
}

