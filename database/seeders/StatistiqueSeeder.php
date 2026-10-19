<?php

namespace Database\Seeders;

use App\Models\Statistique;
use Illuminate\Database\Seeder;

class StatistiqueSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            [
                'key' => 'enseignants',
                'value' => '140+',
                'label' => 'enseignants et experts professionnels',
                'description' => 'Corps professoral d\'excellence associant universitaires et praticiens d\'entreprises.',
                'icon' => null,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'filieres',
                'value' => '8',
                'label' => 'filières d\'excellence',
                'description' => 'Formations professionnalisantes du Bac+2 au Bac+5.',
                'icon' => 'assets/images/cartable_1516879221174-png.png',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'insertion',
                'value' => '92%',
                'label' => 'taux d\'insertion professionnelle',
                'description' => 'Diplômés en activité dans les 12 mois suivant la fin de leurs études.',
                'icon' => 'assets/images/international_1516878194583-png.png',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'etudiants',
                'value' => '3 200+',
                'label' => 'étudiants formés par an',
                'description' => 'Étudiants en formation initiale et professionnels en formation continue.',
                'icon' => 'assets/images/etudiants-def2_1516900840094-png.png',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'entreprises',
                'value' => '42',
                'label' => 'entreprises partenaires',
                'description' => 'Groupes bancaires, industriels et institutions partenaires conventionnés.',
                'icon' => null,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'key' => 'laboratoires',
                'value' => '4',
                'label' => 'laboratoires & chaires',
                'description' => 'Équipes de recherche en économie appliquée et sciences managériales.',
                'icon' => 'assets/images/immeuble_1516878533295-png.png',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'key' => 'campus',
                'value' => '1',
                'label' => 'campus principal (Libreville)',
                'description' => 'Site historique moderne situé sur le Boulevard Triomphal.',
                'icon' => 'assets/images/localisation-def_1516885789353-png.png',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'key' => 'associations',
                'value' => '15+',
                'label' => 'clubs & associations étudiantes',
                'description' => 'Vie associative, junior entreprise, clubs de débat et sports.',
                'icon' => 'assets/images/associations_1516897081704-png.png',
                'order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($stats as $stat) {
            Statistique::updateOrCreate(
                ['key' => $stat['key']],
                $stat
            );
        }
    }
}

