<?php

namespace App\Http\Controllers;

use App\Models\Gouvernance;
use App\Models\Infrastructure;
use App\Models\Partenaire;
use App\Models\Statistique;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $director = Gouvernance::where('role', 'like', '%Directeur Général%')->first();
        $gouvernances = Gouvernance::active()->get();
        $stats = Statistique::active()->pluck('value', 'key')->toArray();
        $statistiques = Statistique::active()->get();

        return view('pages.about', compact('director', 'gouvernances', 'stats', 'statistiques'));
    }

    public function campus()
    {
        $infrastructures = Infrastructure::active()->get();
        return view('pages.campus', compact('infrastructures'));
    }

    public function vieAssociative()
    {
        $temoignages = \App\Models\Temoignage::featured()->take(3)->get();
        return view('pages.vie-associative', compact('temoignages'));
    }

    public function admissions()
    {
        return view('pages.admissions');
    }

    public function entreprises()
    {
        $partenaires = Partenaire::ordered()->get();
        return view('pages.entreprises', compact('partenaires'));
    }

    /**
     * Dynamically serve any requested template page with clean Laravel route and layout.
     */
    public function renderStaticPage(string $slug)
    {
        // 1. If accessed with .html extension, 301 redirect to clean URL
        if (str_ends_with(strtolower($slug), '.html')) {
            $clean = preg_replace('/\.html$/i', '', $slug);
            return redirect('/' . $clean, 301);
        }

        $cleanSlug = $slug;

        // 2. Check aliases for core dedicated routes
        if (in_array($cleanSlug, ['a-propos', 'about', 'l-universite-jean-moulin'])) {
            return redirect()->route('about', [], 301);
        }
        if (in_array($cleanSlug, ['notre-campus', 'nos-campus'])) {
            return redirect()->route('campus', [], 301);
        }
        if (in_array($cleanSlug, ['campus'])) {
            return $this->campus();
        }
        if (in_array($cleanSlug, ['vie-associative', 'engagement-etudiant', 'associations-Libreville-3'])) {
            return redirect()->route('vie-associative', [], 301);
        }
        if (in_array($cleanSlug, ['admissions', 'candidater-et-s-inscrire', 'inscriptions', 'je-choisis-ma-formation'])) {
            return redirect()->route('admissions', [], 301);
        }
        if (in_array($cleanSlug, ['entreprises', 'partenaires', 'entreprises-et-partenaires', 'partenaires-et-entreprises'])) {
            return redirect()->route('entreprises', [], 301);
        }
        if (in_array($cleanSlug, ['formations', 'formation-initiale'])) {
            return redirect()->route('formations.index', [], 301);
        }
        if (in_array($cleanSlug, ['actualites', 'toute-l-actu', 'toute-l-actu-1', 'actualites-2'])) {
            return redirect()->route('actualites.index', [], 301);
        }
        if (in_array($cleanSlug, ['agenda', 'agenda-2', 'calendrier'])) {
            return redirect()->route('evenements.index', [], 301);
        }
        if (in_array($cleanSlug, ['contact'])) {
            return redirect()->route('contact', [], 301);
        }

        // 3. Search in html_static/
        $candidates = [
            base_path('html_static/' . $cleanSlug . '.html'),
            base_path('html_static/' . $slug . '.html'),
        ];

        foreach ($candidates as $filePath) {
            if (file_exists($filePath) && is_file($filePath)) {
                $rawHtml = file_get_contents($filePath);

                // Extract Title
                $title = ucfirst(str_replace('-', ' ', $cleanSlug));
                if (preg_match('/<title>(.*?)<\/title>/is', $rawHtml, $tm)) {
                    $cleanedTitle = trim($tm[1]);
                    $cleanedTitle = preg_replace('/\s*-\s*Institut National.*$/i', '', $cleanedTitle);
                    $cleanedTitle = preg_replace('/\s*-\s*Universit.*$/i', '', $cleanedTitle);
                    if (!empty($cleanedTitle)) {
                        $title = $cleanedTitle;
                    }
                }

                // Extract #contenu-encadres
                $bodyContent = '';
                $posStart = strpos($rawHtml, 'id="contenu-encadres"');
                if ($posStart !== false) {
                    $divStart = strrpos(substr($rawHtml, 0, $posStart), '<div');
                    $posDate = strpos($rawHtml, 'class="date-miseajour"', $posStart);
                    if ($posDate !== false) {
                        $divEnd = strrpos(substr($rawHtml, 0, $posDate), '</div>');
                        $bodyContent = substr($rawHtml, $divStart, $divEnd - $divStart);
                    } else {
                        $posMainEnd = strpos($rawHtml, '</main>', $posStart);
                        $bodyContent = substr($rawHtml, $divStart, ($posMainEnd !== false ? $posMainEnd : strlen($rawHtml)) - $divStart);
                    }
                } else {
                    if (preg_match('/<main\b[^>]*>(.*?)<\/main>/is', $rawHtml, $mm)) {
                        $bodyContent = $mm[1];
                    } else {
                        $bodyContent = $rawHtml;
                    }
                }

                // Clean .html links to clean URLs
                $bodyContent = preg_replace('/href=[\'"](?:\/)?([a-zA-Z0-9_\-]+)\.html([\'"])/i', 'href="/$1$2', $bodyContent);
                $bodyContent = preg_replace('/href=[\'"](?:\/)?2\.html[\'"]/i', 'href="#"', $bodyContent);

                // Clean relative asset paths to absolute
                $bodyContent = preg_replace('/(src|href)=[\'"]assets\//i', '$1="/assets/', $bodyContent);
                $bodyContent = preg_replace('/(src|href)=[\'"]medias\//i', '$1="/medias/', $bodyContent);

                return view('pages.static-page', [
                    'title' => $title,
                    'bodyContent' => $bodyContent,
                ]);
            }
        }

        abort(404);
    }
}
