<?php

namespace App\Support;

use App\Models\Actualite;
use App\Models\Evenement;
use App\Models\Formation;
use App\Models\Infrastructure;
use App\Models\Slide;
use Illuminate\Support\Facades\DB;

class PhotoAssignments
{
    /** Replace the former generic images without overwriting later uploads from the back office. */
    public static function apply(): int
    {
        return DB::transaction(function () {
            $count = 0;
            foreach ([Slide::class, Actualite::class, Evenement::class, Formation::class, Infrastructure::class] as $model) {
                foreach ($model::orderBy('id')->get() as $record) {
                    if ($record->image && ! preg_match('~(?:insg-back-\d+\.jpeg|175979157\d+\.jpg\.jpeg|rentree\.png)$~', $record->image)) {
                        continue;
                    }
                    $context = ($record->title ?? $record->name).' '.($record->slug ?? '');
                    $theme = PhotoLibrary::theme($context);
                    $index = ($record->id - 1) % 3;
                    if ($record instanceof Slide) {
                        $theme = match ($record->order) {
                            1 => 'diplomes', 2 => 'orientation', 3 => 'entreprises', 4 => 'institution',
                            default => 'vie-etudiante',
                        };
                        $index = 0;
                    }
                    if ($record instanceof Infrastructure && $record->slug === 'bibliotheque-recherche') {
                        // None of the new photographs identifies the library itself.
                        continue;
                    }
                    $path = PhotoLibrary::photo($theme, $index)['path'];
                    DB::table($record->getTable())->where('id', $record->id)->update(['image' => $path]);
                    $count++;
                }
            }
            return $count;
        });
    }
}
