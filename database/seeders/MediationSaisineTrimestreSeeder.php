<?php

namespace Database\Seeders;

use App\Models\MediationSaisineTrimestre;
use Illuminate\Database\Seeder;

class MediationSaisineTrimestreSeeder extends Seeder
{
    public function run(): void
    {
        $periodes = ['T1 22', 'T2 22', 'T3 22', 'T4 22', 'T1 23', 'T2 23', 'T3 23', 'T4 23', 'T1 24', 'T2 24', 'T3 24', 'T4 24'];
        $saisines = [38, 42, 35, 48, 52, 58, 61, 69, 72, 84, 90, 96];
        $resolus = [30, 36, 29, 40, 44, 50, 53, 60, 62, 72, 78, 82];

        foreach ($periodes as $i => $periode) {
            MediationSaisineTrimestre::create([
                'periode' => $periode,
                'saisines' => $saisines[$i],
                'resolus' => $resolus[$i],
                'ordre' => $i,
            ]);
        }
    }
}
