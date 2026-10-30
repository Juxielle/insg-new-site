<?php

// Apply the content import after saving a local copy of the affected records.
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$tables = ['slides', 'formations', 'statistiques', 'temoignages', 'gouvernances', 'actualites', 'evenements'];
$snapshot = [];
foreach ($tables as $table) {
    $snapshot[$table] = Illuminate\Support\Facades\DB::table($table)->get()->toArray();
}
$directory = storage_path('app/content-import');
if (! is_dir($directory)) {
    mkdir($directory, 0755, true);
}
$backup = $directory.'/before-'.date('Ymd-His').'.json';
file_put_contents($backup, json_encode($snapshot, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
(new Database\Seeders\InsgSourceContentSeeder)->run();
// Consolidate only duplicates created by this import's earlier event mapping.
// The original record and its URL/media always take precedence.
if (in_array('--consolidate-events', $argv, true)) {
    $source = json_decode(file_get_contents(resource_path('content/insg-source.json')), true, 512, JSON_THROW_ON_ERROR);
    foreach ($source['events'] as $event) {
        $slug = Illuminate\Support\Str::slug($event['title']);
        $duplicate = App\Models\Evenement::where('slug', $slug)->first();
        if ($duplicate && App\Models\Evenement::where('title', $event['title'])->where('id', '!=', $duplicate->id)->exists()) {
            $duplicate->delete();
        }
    }
}
echo "Editorial import applied. Backup: ".$backup.PHP_EOL;
echo 'Active courses: '.App\Models\Formation::active()->count().PHP_EOL;
