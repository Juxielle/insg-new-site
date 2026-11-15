<?php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$urls = ['/', '/a-propos', '/campus', '/admissions', '/vie-associative', '/entreprises-et-partenaires', '/contact', '/formations', '/actualites', '/evenements', '/incubateur/recherche', '/incubateur/projets', '/incubateur/entrepreneuriat-etudiant'];
$imported = [];
foreach (glob(base_path('html_static/*.html')) as $file) {
 $urls[] = '/'.basename($file, '.html');
 $doc = new DOMDocument;
 @$doc->loadHTML('<?xml encoding="UTF-8">'.file_get_contents($file));
 $xpath = new DOMXPath($doc);
 if ($xpath->query('//*[@id="page"]//footer')->length) $imported[] = basename($file);
}
foreach ([App\Models\Formation::class => 'formations', App\Models\Actualite::class => 'actualites', App\Models\Evenement::class => 'evenements'] as $model => $prefix) {
 foreach ($model::pluck('slug') as $slug) $urls[] = '/'.$prefix.'/'.$slug;
}
$urls = array_unique($urls);
$issues = [];
foreach ($urls as $url) {
 $path=$url;
 for ($attempt=0; $attempt<5; $attempt++) {
  $request=Illuminate\Http\Request::create($path);
  $response=$kernel->handle($request);
  $kernel->terminate($request,$response);
  if (! $response->isRedirection()) break;
  $path=$response->headers->get('Location');
 }
 $doc=new DOMDocument;
 @$doc->loadHTML('<?xml encoding="UTF-8">'.$response->getContent());
 $xpath=new DOMXPath($doc);
 $counts=['footers'=>$xpath->query('//footer')->length,'site_footer'=>$xpath->query('//*[@id="pied_page"]')->length,'nested_footers'=>$xpath->query('//main//footer | //main//*[@id="pied_page"]')->length];
 if ($response->getStatusCode()!==200 || $counts!==['footers'=>1,'site_footer'=>1,'nested_footers'=>0]) $issues[]=['url'=>$url,'status'=>$response->getStatusCode()]+$counts;
}
$report=['pages_checked'=>count($urls),'imported_templates_with_nested_footer'=>$imported,'issues'=>$issues];
file_put_contents(base_path('scratch/footer-audit.json'),json_encode($report,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));
echo count($urls).' URLs checked. '.count($imported).' imported templates with nested footers cleaned. '.count($issues).' remaining issues.'.PHP_EOL;
