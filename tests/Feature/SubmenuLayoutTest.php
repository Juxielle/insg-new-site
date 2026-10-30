<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubmenuLayoutTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_department_and_cycle_portals_activate_their_existing_widgets(): void
    {
        foreach (['faculte-de-droit', 'faculte-de-philosophie', 'cycle-master', 'cycle-bts', 'bibliotheques-universitaires-3'] as $page) {
            $response = $this->get('/'.$page);
            $response->assertOk();
            $xpath = $this->document($response->getContent());
            $this->assertSame(1, $xpath->query('//body[contains(@class,"ficheaccueil") and contains(@class,"insg-portal-page")]')->length, $page);
            $this->assertSame(0, $xpath->query('//*[@id="bandeau"]')->length, $page.' must not have a second hero banner');
            $this->assertSame(1, $xpath->query('//main//*[@class="card carousellyon3Card"]')->length, $page);
        }
    }

    public function test_editorial_page_restores_its_original_column_proportions(): void
    {
        $response = $this->get('/histoire');
        $response->assertOk();
        $html = $response->getContent();
        $this->assertStringContainsString('#page .ligne_3 > .colonne_1{width:60% !important;}', $html);
        $this->assertStringContainsString('#page .ligne_3 > .colonne_2{width:40% !important;}', $html);
        $this->assertStringNotContainsString('insg-portal-page', $this->document($html)->query('//body')->item(0)->getAttribute('class'));
    }

    public function test_external_templates_do_not_embed_another_document_or_site_header(): void
    {
        foreach (['plateforme-pedagogique', 'histoire-et-sources-des-mondes-antiques', 'centre-interuniversitaire-histoire-archeologie-litteratures-des-mondes-chretiens-et-musulmans-medievaux'] as $page) {
            $response = $this->get('/'.$page);
            $response->assertOk();
            $xpath = $this->document($response->getContent());
            foreach (['//html', '//body', '//main', '//*[@id="page_deco"]', '//body/header', '//body/footer'] as $selector) {
                $this->assertSame(1, $xpath->query($selector)->length, $page.' '.$selector);
            }
        }
    }

    private function document(string $html): DOMXPath
    {
        $document = new DOMDocument;
        @$document->loadHTML('<?xml encoding="UTF-8">'.$html);

        return new DOMXPath($document);
    }
}
