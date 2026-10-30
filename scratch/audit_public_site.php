<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$pattern = '/\bFrance\b|\bParis\p{L}*|lyon|jean[\s-]+moulin/iu';
$issues = [];
$tables = ['actualites', 'evenements', 'formations', 'gouvernances', 'infrastructures', 'partenaires', 'slides', 'statistiques', 'temoignages'];
foreach ($tables as $table) {
    foreach (Illuminate\Support\Facades\DB::table($table)->get() as $row) {
        foreach ((array) $row as $field => $value) {
            if (is_string($value) && preg_match($pattern, html_entity_decode(strip_tags($value)))) {
                $issues[] = ['table' => $table, 'id' => $row->id, 'field' => $field, 'text' => $value];
            }
        }
    }
}
$databaseIssues = count($issues);

$urls = ['/', '/a-propos', '/campus', '/admissions', '/vie-associative', '/entreprises-et-partenaires', '/contact', '/formations', '/actualites', '/evenements'];
foreach (glob(base_path('html_static/*.html')) as $file) {
    $urls[] = '/'.basename($file, '.html');
}
foreach ([App\Models\Formation::class => 'formations', App\Models\Actualite::class => 'actualites', App\Models\Evenement::class => 'evenements'] as $model => $prefix) {
    foreach ($model::pluck('slug') as $slug) {
        $urls[] = '/'.$prefix.'/'.$slug;
    }
}
$urls = array_unique($urls);
foreach ($urls as $url) {
    $path = $url;
    for ($attempt = 0; $attempt < 4; $attempt++) {
        $request = Illuminate\Http\Request::create($path);
        $response = $kernel->handle($request);
        $kernel->terminate($request, $response);
        if (! $response->isRedirection()) {
            break;
        }
        $path = $response->headers->get('Location');
    }
    if ($response->getStatusCode() !== 200) {
        $issues[] = ['url' => $url, 'status' => $response->getStatusCode()];
        continue;
    }
    $document = new DOMDocument;
    @$document->loadHTML('<?xml encoding="UTF-8">'.$response->getContent());
    $xpath = new DOMXPath($document);
    foreach ($xpath->query('//script|//style') as $node) {
        $node->parentNode->removeChild($node);
    }
    if (preg_match_all($pattern, $document->textContent, $matches)) {
        $issues[] = ['url' => $url, 'visible_text' => array_values(array_unique($matches[0]))];
    }
    foreach ($xpath->query('//@href|//@src|//@alt|//@title|//@aria-label|//@content|//@action') as $attribute) {
        if (preg_match($pattern, urldecode($attribute->nodeValue))) {
            $issues[] = ['url' => $url, 'attribute' => $attribute->nodeName, 'value' => $attribute->nodeValue];
        }
    }
    unset($document, $xpath, $response);
}
$report = ['pages_checked' => count($urls), 'database_issues' => $databaseIssues, 'issues' => $issues];
file_put_contents(__DIR__.'/public-reference-audit.json', json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
echo count($urls).' pages and '.count($tables).' public content tables checked. '.count($issues).' issues. See scratch/public-reference-audit.json'.PHP_EOL;
exit(count($issues) ? 1 : 0);
