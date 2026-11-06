<?php

namespace App\Support;

use App\Models\Formation;
use Illuminate\Support\Facades\DB;

class InitialFormationCatalogue
{
    public static function data(): array
    {
        return json_decode(file_get_contents(resource_path('content/formations-initiales.json')), true, 512, JSON_THROW_ON_ERROR);
    }

    /** Update only initial education; preserve course URLs and existing media. */
    public static function sync(): void
    {
        DB::transaction(function () {
            $data = self::data();
            Formation::whereIn('slug', $data['retired_slugs'])->update(['is_active' => false]);
            foreach ($data['groups'] as $group) {
                foreach ($group['courses'] as $course) {
                    $record = Formation::firstOrNew(['slug' => $course['slug']]);
                    $context = 'Formation initiale'.($group['department'] ? ' — Département '.$group['department'] : '');
                    $record->fill([
                        'title' => $course['title'],
                        'level' => $group['level'],
                        'department' => $group['department'],
                        'study_mode' => 'Formation initiale',
                        'summary' => $group['label'].' — '.$context,
                        'description' => $group['label'].' — '.$course['title'].'. '.$context.'.'.
                            ($group['level'] === 'Master Recherche' ? ' En partenariat avec l’Université Omar Bongo (UOB).' : ''),
                        'is_active' => true,
                    ]);
                    if (! $record->exists) {
                        $record->duration = '';
                        $record->image = 'assets/images/insg-back-4.jpeg';
                        $record->admission_requirements = 'Consultez les conditions d’admission auprès du service de scolarité.';
                    }
                    $record->save();
                }
            }
            \App\Models\Statistique::where('key', 'filieres')->update([
                'value' => (string) array_sum(array_map(fn ($group) => count($group['courses']), $data['groups'])),
                'label' => 'parcours en formation initiale',
            ]);
        });
    }
}
