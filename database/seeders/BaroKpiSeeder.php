<?php

namespace Database\Seeders;

use App\Models\BaroKpi;
use Illuminate\Database\Seeder;

class BaroKpiSeeder extends Seeder
{
    public function run(): void
    {
        $kpis = [
            ['secteur' => 'PIB', 'valeur' => '10 820', 'unite' => 'Mds FCFA', 'libelle' => 'PIB 2024 (estimation)', 'delta' => '+2,8%', 'tendance' => 'up'],
            ['secteur' => 'Inflation', 'valeur' => '3,4', 'unite' => '%', 'libelle' => 'Inflation T4 2024', 'delta' => '-0.6pt', 'tendance' => 'up'],
            ['secteur' => 'Bancaire', 'valeur' => '3 247', 'unite' => 'Mds FCFA', 'libelle' => 'Actifs bancaires', 'delta' => '+8,4%', 'tendance' => 'up'],
            ['secteur' => 'Inclusion', 'valeur' => '61,3', 'unite' => '%', 'libelle' => "Taux d'inclusion fin.", 'delta' => '+3,2pts', 'tendance' => 'up'],
            ['secteur' => 'Solv.', 'valeur' => '14,8', 'unite' => '%', 'libelle' => 'Ratio solvabilité moy.', 'delta' => '↑ norme 8%', 'tendance' => 'up'],
            ['secteur' => 'Chômage', 'valeur' => '18,2', 'unite' => '%', 'libelle' => 'Taux chômage estimé', 'delta' => '+0,4pt', 'tendance' => 'dn'],
        ];

        foreach ($kpis as $i => $k) {
            BaroKpi::create($k + ['ordre' => $i]);
        }
    }
}
