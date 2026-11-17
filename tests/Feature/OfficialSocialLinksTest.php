<?php

namespace Tests\Feature;

use App\Support\OfficialSocialLinks;
use Database\Seeders\DatabaseSeeder;
use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OfficialSocialLinksTest extends TestCase
{
    use RefreshDatabase;

    public function test_shared_footer_and_directory_have_all_five_exact_official_links(): void
    {
        $this->seed(DatabaseSeeder::class);
        foreach (['/', '/formations', '/gouvernance', '/incubateur/projets', '/tous-les-reseaux-sociaux'] as $url) {
            $response = $this->get($url)->assertOk();
            $document = new DOMDocument;
            @$document->loadHTML('<?xml encoding="UTF-8">'.$response->getContent());
            $xpath = new DOMXPath($document);
            $hrefs = [];
            foreach ($xpath->query('//footer//*[contains(@class,"reseaux-sociaux__liste")]//a') as $link) {
                $hrefs[] = $link->getAttribute('href');
            }
            $this->assertSame(array_column(config('social_networks'), 'url'), $hrefs, $url);
        }
        foreach (config('social_networks') as $network) {
            $this->get('/tous-les-reseaux-sociaux')->assertSee($network['label'])->assertSee($network['url']);
            $this->assertFileExists(public_path($network['icon']));
        }
        $this->get('/facebook')->assertRedirect(config('social_networks.facebook.url'));
    }

    public function test_imported_profiles_are_replaced_without_changing_sharing_and_third_party_links(): void
    {
        $html = '<a href="https://www.instagram.com/insggabon/">INSG</a><a href="https://www.linkedin.com/company/107101996/admin/dashboard/">INSG</a><a href="https://www.facebook.com/sharer/sharer.php?u=page">Partager</a><a href="https://www.instagram.com/episcia_l3dd/">Association</a>';
        $result = OfficialSocialLinks::normalize($html);
        $this->assertStringContainsString(htmlspecialchars(config('social_networks.instagram.url'), ENT_QUOTES, 'UTF-8'), $result);
        $this->assertStringContainsString(config('social_networks.linkedin.url'), $result);
        $this->assertStringContainsString('https://www.facebook.com/sharer/sharer.php?u=page', $result);
        $this->assertStringContainsString('https://www.instagram.com/episcia_l3dd/', $result);
    }
}
