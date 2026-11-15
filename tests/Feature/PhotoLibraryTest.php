<?php

namespace Tests\Feature;

use App\Models\Actualite;
use App\Models\Formation;
use App\Support\PhotoAssignments;
use App\Support\PhotoLibrary;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PhotoLibraryTest extends TestCase
{
    use RefreshDatabase;

    public function test_library_contains_web_images_with_matching_public_copies(): void
    {
        foreach (PhotoLibrary::all() as $photos) {
            foreach ($photos as $photo) {
                $path = public_path($photo['path']);
                $this->assertFileExists($path);
                $this->assertSame(hash_file('sha256', base_path($photo['path'])), hash_file('sha256', $path));
                $dimensions = getimagesize($path);
                $this->assertSame([$photo['width'], $photo['height']], array_slice($dimensions, 0, 2));
                $this->assertSame('image/webp', $dimensions['mime']);
                $this->assertLessThanOrEqual(1920, $dimensions[0]);
            }
        }
    }

    public function test_themes_follow_the_page_subject(): void
    {
        foreach (['sport-1' => 'sport', 'incubateur/projets' => 'incubateur', 'incubateur/recherche' => 'recherche', 'licence-professionnelle-informatique-de-gestion-ig' => 'laboratoire', 'Management et Entrepreneuriat en Agro-industrie (MEA)' => 'agroalimentaire', 'admissions' => 'orientation', 'entreprises-et-partenaires' => 'entreprises'] as $page => $theme) {
            $this->assertSame($theme, PhotoLibrary::theme($page));
        }
        $html = PhotoLibrary::replaceLegacyPhotos('<img src="assets/images/insg-back-2.jpeg"><img src="assets/images/insg-logo.png"><img src="assets/images/directeur-1.png"><img src="assets/images/organigramme-insg.jpeg">', 'sport-1');
        $this->assertStringContainsString('reportages/sport-', $html);
        foreach (['insg-logo.png', 'directeur-1.png', 'organigramme-insg.jpeg'] as $preserved) {
            $this->assertStringContainsString($preserved, $html);
        }
    }

    public function test_assignment_preserves_editorial_content_and_custom_uploads(): void
    {
        $this->seed(DatabaseSeeder::class);
        $news = Actualite::first();
        $news->update(['image' => 'assets/images/rentree.png']);
        $attributes = $news->getAttributes();
        $formation = Formation::active()->first();
        $formation->update(['image' => 'storage/formations/custom-upload.jpg']);
        PhotoAssignments::apply();
        $this->assertStringContainsString('reportages/', $news->fresh()->image);
        $this->assertSame(collect($attributes)->except('image')->all(), collect($news->fresh()->getAttributes())->except('image')->all());
        $this->assertSame('storage/formations/custom-upload.jpg', $formation->fresh()->image);
        $this->assertSame(0, PhotoAssignments::apply());
    }

    public function test_public_sections_display_the_selected_photographs(): void
    {
        $this->seed(DatabaseSeeder::class);
        foreach (['/' => 'diplomes-', '/entreprises-et-partenaires' => 'partenariat-magt-', '/vie-associative' => 'vie-etudiante-', '/incubateur/projets' => 'incubateur-', '/incubateur/recherche' => 'recherche-', '/sport-1' => 'sport-', '/formations' => 'conferences-'] as $url => $name) {
            $this->get($url)->assertOk()->assertSee('assets/images/reportages/'.$name, false);
        }
    }
}
