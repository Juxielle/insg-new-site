<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IncubatorPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_pages_preserve_imported_text_in_the_existing_site_layout(): void
    {
        $this->seed(DatabaseSeeder::class);
        $pages = json_decode(file_get_contents(resource_path('content/incubateur.json')), true);
        foreach ($pages as $slug => $page) {
            $response = $this->get('/incubateur/'.$slug)->assertOk();
            $response->assertSee($page['title'])->assertSee($page['intro']);
            foreach ($page['blocks'] as $block) {
                $response->assertSee($block['text']);
            }
            $response->assertSee('id="page_deco"', false)->assertSee('id="encadres"', false);
            $response->assertDontSee('data-cms-section')->assertDontSee('http://127.0.0.1:8000');
        }
        $this->get('/incubateur')->assertRedirect('/incubateur/projets');
        $this->get('/incubateur/inconnu')->assertNotFound();
    }

    public function test_incubator_menu_follows_research_and_contains_the_three_source_entries(): void
    {
        $this->seed(DatabaseSeeder::class);
        $document = new DOMDocument;
        @$document->loadHTML('<?xml encoding="UTF-8">'.$this->get('/')->assertOk()->getContent());
        $xpath = new DOMXPath($document);
        $labels = [];
        foreach ($xpath->query('//*[@id="menu_principal"]/li/button[contains(@class,"libelle")]') as $button) {
            $labels[] = trim($button->textContent);
        }
        $position = array_search('Incubateur', $labels, true);
        $this->assertIsInt($position);
        $this->assertSame('Recherche', $labels[$position - 1]);
        $this->assertSame('Entreprises', $labels[$position + 1]);
        $links = $xpath->query('//*[@data-toggle-id="INS-INCUBATEUR"]//a');
        $this->assertCount(3, $links);
        $this->assertSame(['Laboratoire LARSG & Recherche', 'Incubateur de projets', 'Entrepreneuriat étudiant'], array_map(fn ($link) => trim($link->textContent), iterator_to_array($links)));
    }
}
