<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$backup = [];
foreach (['slides', 'actualites', 'evenements', 'formations', 'infrastructures'] as $table) {
    $backup[$table] = Illuminate\Support\Facades\DB::table($table)->get()->all();
}
$path = storage_path('app/content-import/photos-before-'.date('Ymd-His').'.json');
if (! is_dir(dirname($path))) {
    mkdir(dirname($path), 0755, true);
}
file_put_contents($path, json_encode($backup, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
$updated = App\Support\PhotoAssignments::apply();
echo $updated.' images updated. Backup: '.$path.PHP_EOL;
