<?php

namespace Tests\Feature;

use App\Models\Formation;
use App\Support\InitialFormationCatalogue;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InitialFormationCatalogueTest extends TestCase
{
    use RefreshDatabase;

    public function test_department_distribution_and_course_fiches_are_consistent(): void
    {
        $this->seed(DatabaseSeeder::class);
        $initial = Formation::active()->where('study_mode', 'Formation initiale')->get();
        $this->assertCount(26, $initial);
        $this->assertCount(18, $initial->where('department', 'Gestion Appliquée (GA)'));
        $this->assertCount(7, $initial->where('department', 'Marketing et Affaires Internationales (MAI)'));
        $this->assertCount(1, $initial->where('department', ''));
        $this->assertCount(11, Formation::active()->where('study_mode', 'Formation continue')->get());
        $index = $this->get('/formations')->assertOk();
        foreach (InitialFormationCatalogue::data()['groups'] as $group) {
            foreach ($group['courses'] as $course) {
                $index->assertSee($course['title']);
                $fiche = $this->get('/formations/'.$course['slug'])->assertOk();
                $fiche->assertSee($course['title'])->assertSee('Formation initiale');
                if ($group['department']) {
                    $fiche->assertSee($group['department']);
                } else {
                    $fiche->assertSee('Université Omar Bongo (UOB)');
                }
                $fiche->assertDontSee('Formation Initiale / Continue');
            }
        }
        $index->assertDontSee('Rechercher une formation')->assertDontSee('Catalogue des filières');
    }

    public function test_sync_preserves_continuing_education_urls_and_media(): void
    {
        $this->seed(DatabaseSeeder::class);
        $continuing = Formation::where('study_mode', 'Formation continue')->orderBy('id')->get()->toArray();
        $initial = Formation::active()->where('study_mode', 'Formation initiale')->orderBy('id')->get();
        $initial->first()->update(['image' => 'assets/images/custom-course.jpg']);
        $identities = $initial->pluck('slug', 'id')->all();
        InitialFormationCatalogue::sync();
        $this->assertSame($continuing, Formation::where('study_mode', 'Formation continue')->orderBy('id')->get()->toArray());
        $this->assertSame($identities, Formation::active()->where('study_mode', 'Formation initiale')->orderBy('id')->pluck('slug', 'id')->all());
        $this->assertSame('assets/images/custom-course.jpg', $initial->first()->fresh()->image);
        foreach (InitialFormationCatalogue::data()['retired_slugs'] as $slug) {
            Formation::firstOrCreate(['slug' => $slug], ['title' => 'Ancien parcours', 'department' => '', 'level' => 'Licence Pro', 'description' => '', 'is_active' => false]);
            $this->get('/formations/'.$slug)->assertRedirect('/formations');
        }
    }

    public function test_department_and_cycle_pages_use_the_same_catalogue(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->get('/departement-gestion-appliquee')->assertOk()->assertSee('Statistique Informatique en Économie Gestion (SIEGe)')->assertSee('Licence Professionnelle Double Compétence');
        $this->get('/departement-marketing-affaires-internationales')->assertOk()->assertSee('Licence Fondamentale')->assertSee('Marketing et Stratégies Commerciales (MSC)')->assertDontSee('Statistique Informatique en Économie Gestion (SIEGe)');
        $this->get('/cycle-bts')->assertOk()->assertSee('Délégué Médical (DM)')->assertSee('Commerce Internationale (CI)');
        $this->get('/cycle-master')->assertOk()->assertSee('Finance (Fi)')->assertSee('Université Omar Bongo (UOB)')->assertDontSee('40 Masters');
        $this->get('/ufr-instituts')->assertOk()->assertSee('Département Gestion Appliquée (GA)')->assertSee('Département Marketing et Affaires Internationales (MAI)')->assertDontSee('Département Management & RH', false)->assertDontSee('Département Informatique de Gestion');
        foreach (['formation', 'nos-formations'] as $alias) {
            $this->get('/'.$alias)->assertRedirect('/formations');
        }
        $this->get('/faculte-de-droit')->assertRedirect('/departement-gestion-appliquee');
    }
}
