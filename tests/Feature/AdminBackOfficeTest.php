<?php

namespace Tests\Feature;

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
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminBackOfficeTest extends TestCase
{
    use RefreshDatabase;

    protected User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\DatabaseSeeder::class);

        $this->adminUser = User::where('email', 'admin@insg-gabon.ga')->firstOrFail();
    }

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_login_page_renders_properly(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Administration INSG');
        $response->assertSee('Se connecter');
    }

    public function test_login_fails_with_invalid_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@insg-gabon.ga',
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_login_succeeds_with_valid_credentials(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@insg-gabon.ga',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($this->adminUser);
    }

    public function test_admin_dashboard_loads_for_authenticated_user(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Tableau de Bord');
        $response->assertSee('Slides Carrousel');
        $response->assertSee('Actualités');
        $response->assertSee('Formations');
    }

    public function test_admin_can_manage_slides(): void
    {
        // 1. Index
        $response = $this->actingAs($this->adminUser)->get('/admin/slides');
        $response->assertStatus(200);
        $response->assertSee('Carrousel Accueil');

        // 2. Create form
        $response = $this->actingAs($this->adminUser)->get('/admin/slides/create');
        $response->assertStatus(200);

        // 3. Store
        $response = $this->actingAs($this->adminUser)->post('/admin/slides', [
            'title' => 'Nouveau Slide Test',
            'subtitle' => 'Description du slide de test',
            'image' => 'assets/images/insg-back-1.jpeg',
            'link_url' => '/formations',
            'link_text' => 'Découvrir',
            'order' => 99,
            'is_active' => 1,
        ]);
        $response->assertRedirect('/admin/slides');
        $this->assertDatabaseHas('slides', ['title' => 'Nouveau Slide Test']);

        // 4. Toggle
        $slide = Slide::where('title', 'Nouveau Slide Test')->first();
        $this->actingAs($this->adminUser)->post("/admin/slides/{$slide->id}/toggle");
        $this->assertFalse((bool) $slide->fresh()->is_active);

        // 5. Delete
        $this->actingAs($this->adminUser)->delete("/admin/slides/{$slide->id}");
        $this->assertDatabaseMissing('slides', ['title' => 'Nouveau Slide Test']);
    }

    public function test_admin_can_manage_actualites(): void
    {
        // Index
        $response = $this->actingAs($this->adminUser)->get('/admin/actualites');
        $response->assertStatus(200);

        // Store
        $response = $this->actingAs($this->adminUser)->post('/admin/actualites', [
            'title' => 'Article Test Backoffice',
            'category' => 'Vie académique',
            'excerpt' => 'Extrait pour le test',
            'content' => '<p>Contenu détaillé de test pour le backoffice.</p>',
            'image' => 'assets/images/1759791578740.jpg.jpeg',
            'is_featured' => 1,
            'published_at' => now()->format('Y-m-d H:i:s'),
        ]);
        $response->assertRedirect('/admin/actualites');
        $this->assertDatabaseHas('actualites', ['title' => 'Article Test Backoffice']);

        // Toggle featured
        $actu = Actualite::where('title', 'Article Test Backoffice')->first();
        $this->actingAs($this->adminUser)->post("/admin/actualites/{$actu->id}/toggle-featured");
        $this->assertFalse((bool) $actu->fresh()->is_featured);

        // Delete
        $this->actingAs($this->adminUser)->delete("/admin/actualites/{$actu->id}");
        $this->assertDatabaseMissing('actualites', ['title' => 'Article Test Backoffice']);
    }

    public function test_admin_can_manage_formations(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/formations');
        $response->assertStatus(200);

        $response = $this->actingAs($this->adminUser)->post('/admin/formations', [
            'title' => 'Master Test Finance',
            'level' => 'Master Pro',
            'department' => 'Finance & Comptabilité',
            'duration' => '2 ans',
            'summary' => 'Résumé formation test',
            'description' => 'Description formation test',
            'image' => 'assets/images/insg-back-4.jpeg',
            'is_active' => 1,
        ]);
        $response->assertRedirect('/admin/formations');
        $this->assertDatabaseHas('formations', ['title' => 'Master Test Finance']);

        $formation = Formation::where('title', 'Master Test Finance')->first();
        $this->actingAs($this->adminUser)->delete("/admin/formations/{$formation->id}");
        $this->assertDatabaseMissing('formations', ['title' => 'Master Test Finance']);
    }

    public function test_admin_can_manage_statistiques(): void
    {
        $response = $this->actingAs($this->adminUser)->get('/admin/statistiques');
        $response->assertStatus(200);

        $response = $this->actingAs($this->adminUser)->post('/admin/statistiques', [
            'key' => 'test_stat_metric',
            'value' => '99%',
            'label' => 'Taux de réussite test',
            'order' => 10,
            'is_active' => 1,
        ]);
        $response->assertRedirect('/admin/statistiques');
        $this->assertDatabaseHas('statistiques', ['key' => 'test_stat_metric']);

        $stat = Statistique::where('key', 'test_stat_metric')->first();
        $this->actingAs($this->adminUser)->delete("/admin/statistiques/{$stat->id}");
        $this->assertDatabaseMissing('statistiques', ['key' => 'test_stat_metric']);
    }

    public function test_admin_can_manage_temoignages_and_gouvernance(): void
    {
        // Temoignage
        $response = $this->actingAs($this->adminUser)->post('/admin/temoignages', [
            'name' => 'Alumni Test',
            'role' => 'Directeur Test',
            'promotion' => 'Promo 2020',
            'content' => 'Excellent cursus.',
            'rating' => 5,
            'order' => 1,
            'is_featured' => 1,
        ]);
        $response->assertRedirect('/admin/temoignages');
        $this->assertDatabaseHas('temoignages', ['name' => 'Alumni Test']);

        // Gouvernance
        $response = $this->actingAs($this->adminUser)->post('/admin/gouvernances', [
            'name' => 'Membre Test',
            'role' => 'Directeur Adjoint Test',
            'division' => 'Direction',
            'order' => 1,
            'is_active' => 1,
        ]);
        $response->assertRedirect('/admin/gouvernances');
        $this->assertDatabaseHas('gouvernances', ['name' => 'Membre Test']);
    }

    public function test_admin_can_manage_infrastructures_and_partenaires(): void
    {
        // Infrastructure
        $response = $this->actingAs($this->adminUser)->post('/admin/infrastructures', [
            'name' => 'Salle Test Multimédia',
            'category' => 'Numérique',
            'description' => 'Équipements de pointe',
            'capacity' => '50 postes',
            'order' => 1,
            'is_active' => 1,
        ]);
        $response->assertRedirect('/admin/infrastructures');
        $this->assertDatabaseHas('infrastructures', ['name' => 'Salle Test Multimédia']);

        // Partenaire
        $response = $this->actingAs($this->adminUser)->post('/admin/partenaires', [
            'name' => 'Entreprise Test Partenaire',
            'category' => 'Bancaire & Finance',
            'order' => 1,
        ]);
        $response->assertRedirect('/admin/partenaires');
        $this->assertDatabaseHas('partenaires', ['name' => 'Entreprise Test Partenaire']);
    }

    public function test_admin_can_view_contact_messages(): void
    {
        $message = ContactMessage::create([
            'name' => 'Jean Étudiant',
            'email' => 'jean@example.com',
            'subject' => 'Question sur le concours',
            'message' => 'Bonjour, quand a lieu le prochain concours d\'entrée ?',
            'is_read' => false,
        ]);

        $response = $this->actingAs($this->adminUser)->get('/admin/messages');
        $response->assertStatus(200);
        $response->assertSee('Question sur le concours');

        // Show single message (auto marks as read)
        $response = $this->actingAs($this->adminUser)->get("/admin/messages/{$message->id}");
        $response->assertStatus(200);
        $response->assertSee('Jean Étudiant');
        $this->assertTrue((bool) $message->fresh()->is_read);

        // Delete message
        $this->actingAs($this->adminUser)->delete("/admin/messages/{$message->id}");
        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
    }

    public function test_admin_can_logout(): void
    {
        $response = $this->actingAs($this->adminUser)->post('/admin/logout');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
