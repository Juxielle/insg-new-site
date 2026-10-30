<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$pages = ['/', '/a-propos', '/admissions', '/campus', '/contact', '/vie-associative', '/entreprises-et-partenaires', '/formations', '/actualites', '/evenements'];
// Test all edited legacy pages using the current database and HTTP kernel.
foreach (glob(base_path('html_static/*.html')) as $file) {
    $content = file_get_contents($file);
    if (str_contains($content, '— INSG Gabon</title>')) {
        $pages[] = '/'.basename($file, '.html');
    }
}
foreach ($pages as $url) {
    $request = Illuminate\Http\Request::create($url);
    $response = $kernel->handle($request);
    if ($response->getStatusCode() !== 200) {
        throw new RuntimeException($url.': HTTP '.$response->getStatusCode());
    }
    if (! str_contains($response->getContent(), 'id="page_deco"')) {
        throw new RuntimeException($url.': missing site layout');
    }
    $kernel->terminate($request, $response);
}
echo count($pages)." pages verified against the current database (HTTP 200 and shared layout).".PHP_EOL;
