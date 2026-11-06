<?php

require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Formation;
use App\Support\InitialFormationCatalogue;
use Illuminate\Support\Facades\Artisan;

$directory = storage_path('app/content-import');
if (! is_dir($directory)) {
    mkdir($directory, 0755, true);
}
$backup = $directory.'/formations-before-departments-'.date('Ymd-His').'.json';
file_put_contents($backup, Formation::orderBy('id')->get()->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
$continuing = Formation::where('department', 'Formation continue')->orderBy('id')->get()->map(fn ($row) => collect($row->getAttributes())->except(['study_mode'])->all())->all();

$status = Artisan::call('migrate', ['--path' => 'database/migrations/2026_11_05_000001_add_study_mode_to_formations.php', '--force' => true]);
if ($status !== 0) {
    throw new RuntimeException(Artisan::output());
}
InitialFormationCatalogue::sync();
$after = Formation::where('department', 'Formation continue')->orderBy('id')->get()->map(fn ($row) => collect($row->getAttributes())->except(['study_mode'])->all())->all();
if ($continuing !== $after) {
    throw new RuntimeException('Continuing education records unexpectedly changed. Backup: '.$backup);
}
echo 'Catalogue synchronized. Initial: '.Formation::active()->where('study_mode', 'Formation initiale')->count().'. Continuing records unchanged: '.count($after).'. Backup: '.$backup.PHP_EOL;
