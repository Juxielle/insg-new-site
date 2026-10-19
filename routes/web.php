<?php

use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - INSG Gabon
|--------------------------------------------------------------------------
*/

// Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Pages Institutionnelles
Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/about', function () { return redirect()->route('about', [], 301); });
Route::get('/campus', [PageController::class, 'campus'])->name('campus');
Route::get('/notre-campus', function () { return redirect()->route('campus', [], 301); });
Route::get('/vie-associative', [PageController::class, 'vieAssociative'])->name('vie-associative');
Route::get('/admissions', [PageController::class, 'admissions'])->name('admissions');
Route::get('/entreprises-et-partenaires', [PageController::class, 'entreprises'])->name('entreprises');
Route::get('/entreprises', function () { return redirect()->route('entreprises', [], 301); });
Route::get('/partenaires', function () { return redirect()->route('entreprises', [], 301); });

// Formations (BTS, Licences, Masters)
Route::prefix('formations')->name('formations.')->group(function () {
    Route::get('/', [FormationController::class, 'index'])->name('index');
    Route::get('/{slug}', [FormationController::class, 'show'])->name('show');
});

// Actualités & Médias
Route::prefix('actualites')->name('actualites.')->group(function () {
    Route::get('/', [ActualiteController::class, 'index'])->name('index');
    Route::get('/{slug}', [ActualiteController::class, 'show'])->name('show');
});

// Événements & Agenda
Route::prefix('evenements')->name('evenements.')->group(function () {
    Route::get('/', [EvenementController::class, 'index'])->name('index');
    Route::get('/{slug}', [EvenementController::class, 'show'])->name('show');
});

// Contact
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ==========================================
// BACK OFFICE (ADMINISTRATION)
// ==========================================
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentification
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    // Routes protégées par authentification
    Route::middleware('auth')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Slides Carrousel
        Route::post('/slides/{slide}/toggle', [\App\Http\Controllers\Admin\SlideController::class, 'toggle'])->name('slides.toggle');
        Route::resource('slides', \App\Http\Controllers\Admin\SlideController::class)->except(['show']);

        // Actualités
        Route::post('/actualites/{actualite}/toggle-featured', [\App\Http\Controllers\Admin\ActualiteController::class, 'toggleFeatured'])->name('actualites.toggle-featured');
        Route::resource('actualites', \App\Http\Controllers\Admin\ActualiteController::class)->except(['show']);

        // Formations
        Route::post('/formations/{formation}/toggle', [\App\Http\Controllers\Admin\FormationController::class, 'toggle'])->name('formations.toggle');
        Route::resource('formations', \App\Http\Controllers\Admin\FormationController::class)->except(['show']);

        // Événements
        Route::resource('evenements', \App\Http\Controllers\Admin\EvenementController::class)->except(['show']);

        // Statistiques
        Route::post('/statistiques/{statistique}/toggle', [\App\Http\Controllers\Admin\StatistiqueController::class, 'toggle'])->name('statistiques.toggle');
        Route::resource('statistiques', \App\Http\Controllers\Admin\StatistiqueController::class)->except(['show']);

        // Témoignages
        Route::post('/temoignages/{temoignage}/toggle-featured', [\App\Http\Controllers\Admin\TemoignageController::class, 'toggleFeatured'])->name('temoignages.toggle-featured');
        Route::resource('temoignages', \App\Http\Controllers\Admin\TemoignageController::class)->except(['show']);

        // Gouvernance
        Route::post('/gouvernances/{gouvernance}/toggle', [\App\Http\Controllers\Admin\GouvernanceController::class, 'toggle'])->name('gouvernances.toggle');
        Route::resource('gouvernances', \App\Http\Controllers\Admin\GouvernanceController::class)->except(['show']);

        // Infrastructures
        Route::post('/infrastructures/{infrastructure}/toggle', [\App\Http\Controllers\Admin\InfrastructureController::class, 'toggle'])->name('infrastructures.toggle');
        Route::resource('infrastructures', \App\Http\Controllers\Admin\InfrastructureController::class)->except(['show']);

        // Partenaires
        Route::resource('partenaires', \App\Http\Controllers\Admin\PartenaireController::class)->except(['show']);

        // Messages de Contact
        Route::get('/messages', [\App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}/toggle-read', [\App\Http\Controllers\Admin\ContactMessageController::class, 'toggleRead'])->name('messages.toggle-read');
        Route::delete('/messages/{message}', [\App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');
    });
});

// 301 Redirect for any legacy .html requests to clean route
Route::get('/{page}.html', function ($page) {
    return redirect('/' . $page, 301);
})->where('page', '[a-zA-Z0-9_\-]+');

// Catch-all route for any submenu or secondary template page
Route::get('/{page}', [PageController::class, 'renderStaticPage'])->name('page.show')->where('page', '[a-zA-Z0-9_\-]+');

