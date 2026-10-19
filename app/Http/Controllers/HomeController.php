<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Evenement;
use App\Models\Formation;
use App\Models\Partenaire;
use App\Models\Slide;
use App\Models\Statistique;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Dynamic Hero Carousel Slides from Database
        $slides = Slide::active()->get();

        // 2. Dynamic Key Figures / KPIs from Database
        $stats = Statistique::active()->pluck('value', 'key')->toArray();
        $statistiquesList = Statistique::active()->get();

        // 3. Dynamic Testimonials / Success Stories
        $temoignages = Temoignage::featured()->take(3)->get();

        // 4. Dynamic News, Events, Programs & Partners
        $featuredActualites = Actualite::published()->featured()->take(3)->get();
        $recentActualites = Actualite::published()->take(4)->get();
        $keyFormations = Formation::active()->take(6)->get();
        $upcomingEvents = Evenement::upcoming()->take(3)->get();
        $partenaires = Partenaire::ordered()->get();

        return view('pages.home', compact(
            'slides',
            'stats',
            'statistiquesList',
            'temoignages',
            'featuredActualites',
            'recentActualites',
            'keyFormations',
            'upcomingEvents',
            'partenaires'
        ));
    }
}

