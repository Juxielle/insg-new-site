<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsgPublicIdentityTest extends TestCase
{
    use RefreshDatabase;

    public function test_historical_addresses_redirect_to_insg_addresses(): void
    {
        $this->seed(DatabaseSeeder::class);
        foreach (config('legacy_page_urls') as $old => $new) {
            $this->get('/'.$old)->assertRedirect('/'.$new);
            $response = $this->get('/'.$new);
            $response->assertOk();
            $this->assertPublicIdentity($response->getContent(), $new);
        }
    }

    public function test_all_legacy_templates_have_no_foreign_identity_references(): void
    {
        foreach (glob(base_path('html_static/*.html')) as $file) {
            $this->assertPublicIdentity(file_get_contents($file), basename($file));
        }
    }

    public function test_accented_page_address_remains_accessible(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->get('/ecole-académique-de-la-transition-ecologique-1')->assertOk();
    }

    private function assertPublicIdentity(string $html, string $page): void
    {
        $pattern = '/\bFrance\b|\bParis\p{L}*|lyon|jean[\s-]+moulin/iu';
        $document = new \DOMDocument;
        @$document->loadHTML('<?xml encoding="UTF-8">'.$html);
        $xpath = new \DOMXPath($document);
        foreach ($xpath->query('//script|//style') as $node) {
            $node->parentNode->removeChild($node);
        }
        $this->assertDoesNotMatchRegularExpression($pattern, $document->textContent, $page);
        // CSS class names remain unchanged; public text and destinations do not.
        foreach ($xpath->query('//@href|//@src|//@alt|//@title|//@aria-label|//@content|//@action') as $attribute) {
            $this->assertDoesNotMatchRegularExpression($pattern, urldecode($attribute->nodeValue), $page.' '.$attribute->nodeName);
        }
    }
}
