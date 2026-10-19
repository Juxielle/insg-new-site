<?php

namespace Database\Seeders;

use App\Models\Infrastructure;
use Illuminate\Database\Seeder;

class InfrastructureSeeder extends Seeder
{
    public function run(): void
    {
        $infrastructures = [
            [
                'name' => 'Amphithéâtres connectés',
                'slug' => 'amphitheatres-connectes',
                'category' => 'Pédagogie',
                'description' => 'Des amphithéâtres équipés de systèmes audiovisuels de pointe, adaptés aux cours magistraux, conférences internationales et soutenances de mémoire.',
                'image' => 'assets/images/insg-back-4.jpeg',
                'capacity' => '350 à 500 places',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Bibliothèque Universitaire & Recherche',
                'slug' => 'bibliotheque-recherche',
                'category' => 'Documentation',
                'description' => 'Un fonds documentaire riche de plus de 15 000 ouvrages spécialisés en économie et gestion, des revues scientifiques et des accès aux bases de données numériques internationales.',
                'image' => 'assets/images/insg-back-3.jpeg',
                'capacity' => '250 places assises et espaces de recherche',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Laboratoires Informatiques & Salles Multimédias',
                'slug' => 'laboratoires-informatiques',
                'category' => 'Numérique',
                'description' => 'Des parcs informatiques modernes équipés des logiciels professionnels utilisés par les entreprises : progiciels de comptabilité, outils d\'analyse statistique et de gestion de projet.',
                'image' => 'assets/images/insg-back-5.jpeg',
                'capacity' => '6 salles de 40 postes connectés',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Incubateur des Métiers & Pôle Entrepreneuriat',
                'slug' => 'incubateur-des-metiers',
                'category' => 'Innovation',
                'description' => 'Espace de coworking et d\'accélération de startups étudiantes parrainé par la Fondation BGFI Bank, avec mentorat d\'experts et accompagnement de projets innovants.',
                'image' => 'assets/images/insg-back-10.jpeg',
                'capacity' => 'Espaces de travail collaboratif et salles de pitch',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Espaces de Vie Étudiante & Restauration',
                'slug' => 'vie-etudiante-restauration',
                'category' => 'Vie de Campus',
                'description' => 'Foyer étudiant, cafétéria moderne, terrains multisports et espaces d\'échanges pour les clubs et associations académiques.',
                'image' => 'assets/images/insg-back-6.jpeg',
                'capacity' => 'Espaces ouverts et cafétéria de 300 places',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($infrastructures as $infra) {
            Infrastructure::updateOrCreate(
                ['slug' => $infra['slug']],
                $infra
            );
        }
    }
}

