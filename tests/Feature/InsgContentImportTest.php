<?php

namespace Tests\Feature;

use App\Models\Actualite;
use App\Models\Formation;
use App\Models\Slide;
use App\Models\Temoignage;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\InsgSourceContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsgContentImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_import_keeps_media_and_is_repeatable(): void
    {
        $this->seed(DatabaseSeeder::class);
        $images = Slide::orderBy('id')->pluck('image', 'id')->all();
        $counts = [Formation::count(), Actualite::count(), Temoignage::count()];

        $this->seed(InsgSourceContentSeeder::class);

        $this->assertSame($images, Slide::orderBy('id')->pluck('image', 'id')->all());
        $this->assertSame($counts, [Formation::count(), Actualite::count(), Temoignage::count()]);
        $this->assertSame(37, Formation::active()->count());
        $this->assertSame(11, Formation::active()->where('department', 'Formation continue')->count());
        $this->assertSame('Sarah Mboumba', Temoignage::featured()->first()->name);
    }

    public function test_source_sections_are_available_in_existing_page_layouts(): void
    {
        $this->seed(DatabaseSeeder::class);
        foreach ([
            '/a-propos' => 'Une institution, trois dimensions',
            '/formations' => 'Négoce et Commerce du Bois',
            '/recherche' => 'LARSG',
            '/international' => 'Mobilité étudiante',
            '/entrepreneuriat-innovation' => 'Structurer le projet',
            '/bibliotheque-numerique' => 'Collections spécialisées',
            '/entreprises-et-partenaires' => 'Metodik Audit',
        ] as $url => $text) {
            $response = $this->get($url);
            $response->assertOk();
            $this->assertStringContainsString($text, $response->getContent(), $url);
            $this->assertStringContainsString('id="page_deco"', $response->getContent(), $url);
            $this->assertStringContainsString('assets/css/custom.css', $response->getContent(), $url);
        }
    }
}
