<?php
require __DIR__.'/../vendor/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
foreach (['slides'=>App\Models\Slide::class,'actualites'=>App\Models\Actualite::class,'evenements'=>App\Models\Evenement::class,'infrastructures'=>App\Models\Infrastructure::class,'formations'=>App\Models\Formation::class] as $key=>$model) {
 $items=$model::all()->map(fn($r)=>array_intersect_key($r->getAttributes(),array_flip(['id','title','name','slug','image','level','department','published_at','order'])))->all();
 echo json_encode([$key=>$items],JSON_UNESCAPED_UNICODE).PHP_EOL;
}
