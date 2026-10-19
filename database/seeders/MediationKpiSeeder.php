<?php

namespace Database\Seeders;

use App\Models\MediationKpi;
use Illuminate\Database\Seeder;

class MediationKpiSeeder extends Seeder
{
    public function run(): void
    {
        $kpis = [
            ['libelle' => 'Total dossiers 2024', 'valeur' => '342', 'sous_texte' => '+18% vs 2023'],
            ['libelle' => 'Dossiers résolus', 'valeur' => '287', 'sous_texte' => 'Taux de résolution : 83,9%'],
            ['libelle' => 'Délai moyen', 'valeur' => '34j', 'sous_texte' => 'Objectif : 45 jours'],
            ['libelle' => 'Montants contestés', 'valeur' => '1,2 Md', 'sous_texte' => 'FCFA total 2024'],
        ];

        foreach ($kpis as $i => $k) {
            MediationKpi::create($k + ['ordre' => $i]);
        }
    }
}
