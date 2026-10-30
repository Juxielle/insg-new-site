<?php

namespace Tests\Feature;

use App\Models\Actualite;
use App\Models\ContactMessage;
use App\Models\Evenement;
use App\Models\Formation;
use App\Models\Partenaire;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsgSiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed database for realistic tests
        $this->seed(DatabaseSeeder::class);
    }

    public function test_home_page_loads_with_seeded_data(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Institut National des Sciences de Gestion', false);
        $response->assertSee('Excellence &amp; Insertion', false);
        $response->assertSee('Agenda', false);
        $response->assertSee('Actualités', false);
    }

    public function test_actualites_index_page_loads(): void
    {
        $response = $this->get(route('actualites.index'));

        $response->assertOk();
        $response->assertSee('Toutes les actualités de l\'INSG Gabon', false);
    }

    public function test_actualites_filter_by_search_and_category(): void
    {
        $response = $this->get(route('actualites.index', ['q' => 'inscriptions']));
        $response->assertOk();

        $responseCat = $this->get(route('actualites.index', ['categorie' => 'Admissions']));
        $responseCat->assertOk();
    }

    public function test_actualites_show_page_loads(): void
    {
        $actualite = Actualite::first();
        $this->assertNotNull($actualite);

        $response = $this->get(route('actualites.show', $actualite->slug));

        $response->assertOk();
        $response->assertSee($actualite->title, false);
    }

    public function test_formations_index_page_loads(): void
    {
        $response = $this->get(route('formations.index'));

        $response->assertOk();
        $response->assertSee('Nos Formations d\'Excellence', false);
    }

    public function test_formations_filter_by_level_and_department(): void
    {
        $responseLevel = $this->get(route('formations.index', ['level' => 'Licence']));
        $responseLevel->assertOk();

        $responseDept = $this->get(route('formations.index', ['department' => 'Finance & Comptabilité']));
        $responseDept->assertOk();
    }

    public function test_formations_show_page_loads(): void
    {
        $formation = Formation::first();
        $this->assertNotNull($formation);

        $response = $this->get(route('formations.show', $formation->slug));

        $response->assertOk();
        $response->assertSee($formation->title, false);
        $response->assertSee('Fiche Synthétique', false);
    }

    public function test_evenements_page_loads(): void
    {
        $response = $this->get(route('evenements.index'));

        $response->assertOk();
        $response->assertSee('Agenda de l\'Institut', false);
    }

    public function test_evenement_show_page_loads(): void
    {
        $evenement = Evenement::first();
        $this->assertNotNull($evenement);

        $response = $this->get(route('evenements.show', $evenement->slug));

        $response->assertOk();
        $response->assertSee($evenement->title);
    }

    public function test_about_page_loads(): void
    {
        $response = $this->get(route('about'));

        $response->assertOk();
        $response->assertSee('Institut National des Sciences de Gestion', false);
        $response->assertSee('Murielle Natacha', false);
    }

    public function test_campus_page_loads(): void
    {
        $response = $this->get(route('campus'));

        $response->assertOk();
        $response->assertSee('Le Campus INSG Libreville', false);
        $response->assertSee('Boulevard Triomphal', false);
    }

    public function test_vie_associative_page_loads(): void
    {
        $response = $this->get(route('vie-associative'));

        $response->assertOk();
        $response->assertSee('Vie Associative &amp; Engagement Étudiant', false);
        $response->assertSee('Finance et investissement', false);
    }

    public function test_admissions_page_loads(): void
    {
        $response = $this->get(route('admissions'));

        $response->assertOk();
        $response->assertSee('Admissions &amp; Inscriptions', false);
        $response->assertSee('Premier cycle', false);
        $response->assertSee('Candidature en Master', false);
    }

    public function test_entreprises_page_loads(): void
    {
        $response = $this->get(route('entreprises'));

        $response->assertOk();
        $response->assertSee('Relations Entreprises &amp; Partenariats', false);
        $response->assertSee('BGFI Bank', false);
    }

    public function test_contact_page_loads(): void
    {
        $response = $this->get(route('contact'));

        $response->assertOk();
        $response->assertSee('Contactez l\'INSG Gabon', false);
    }

    public function test_contact_form_submission_success(): void
    {
        $payload = [
            'name' => 'Marc Obame',
            'email' => 'marc.obame@example.com',
            'phone' => '+241 077 12 34 56',
            'subject' => 'Demande d\'information pour Master Audit',
            'message' => 'Bonjour, je souhaite recevoir la brochure et les dates du concours.',
        ];

        $response = $this->post(route('contact.store'), $payload);

        $response->assertRedirect(route('contact'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'marc.obame@example.com',
            'name' => 'Marc Obame',
        ]);
    }

    public function test_contact_form_validation_errors(): void
    {
        $response = $this->post(route('contact.store'), []);

        $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    public function test_submenu_static_pages_redirect_from_html_extension(): void
    {
        $pages = [
            '/gouvernance.html' => '/gouvernance',
            '/organisation.html' => '/organisation',
            '/histoire.html' => '/histoire',
            '/faculte-de-droit.html' => '/faculte-de-droit',
            '/faculte-de-philosophie.html' => '/faculte-de-philosophie',
            '/chiffres-cles.html' => '/chiffres-cles',
        ];

        foreach ($pages as $legacy => $expectedClean) {
            $response = $this->get($legacy);
            $response->assertStatus(301);
            $response->assertRedirect($expectedClean);
        }
    }

    public function test_submenu_static_pages_load_without_extension(): void
    {
        $pages = [
            '/gouvernance',
            '/organisation',
            '/histoire',
            '/faculte-de-droit',
            '/faculte-de-philosophie',
            '/chiffres-cles',
        ];

        foreach ($pages as $p) {
            $response = $this->get($p);
            $response->assertOk();
        }
    }

    public function test_home_page_displays_dynamic_slides_and_stats(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        // Dynamic Carousel Slide
        $response->assertSee('Formez l’excellence, construisez votre avenir de manager', false);
        $response->assertSee('Admissions à l&#039;INSG', false);
        // Dynamic Stats
        $response->assertSee('taux d\'insertion professionnelle', false);
    }

    public function test_vie_associative_page_displays_dynamic_testimonials(): void
    {
        $response = $this->get(route('vie-associative'));

        $response->assertOk();
        // Dynamic Testimonials
        $response->assertSee('Paroles d\'Alumni &amp; Réussites', false);
        $response->assertSee('Sarah Mboumba', false);
        $response->assertSee('Diplômée Finance, promotion 2024', false);
    }

    public function test_about_page_displays_dynamic_director_and_governance(): void
    {
        $response = $this->get(route('about'));

        $response->assertOk();
        $response->assertSee('Pr. Murielle Natacha');
        $response->assertSee('Directeur Général de l\'INSG');
        $response->assertSee('Une école nationale');
        $response->assertSee('Une école universitaire');
    }

    public function test_campus_page_displays_dynamic_infrastructures(): void
    {
        $response = $this->get(route('campus'));

        $response->assertOk();
        $response->assertSee('Amphithéâtres connectés', false);
        $response->assertSee('Bibliothèque Universitaire &amp; Recherche', false);
        $response->assertSee('Laboratoires Informatiques &amp; Salles Multimédias', false);
    }
}


