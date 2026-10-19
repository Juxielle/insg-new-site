<?php

namespace Database\Seeders;

use App\Models\Etude;
use Illuminate\Database\Seeder;

class EtudeSeeder extends Seeder
{
    public function run(): void
    {
        $etudes = [
            ['categorie' => 'Rapport annuel', 'titre' => 'Rapport sur la stabilité financière du Gabon 2024', 'description' => "Bilan complet de la situation financière du Gabon en 2024 : résilience du secteur bancaire, qualité des portefeuilles, niveaux de capitalisation et risques systémiques.", 'kpis' => [['v' => '8,4%', 'l' => 'Croissance actifs'], ['v' => '14,8%', 'l' => 'Ratio solvabilité'], ['v' => '47', 'l' => 'Établissements supervisés']], 'date_publication' => 'Janvier 2025', 'nombre_pages' => 84],
            ['categorie' => 'Note de conjoncture', 'titre' => 'Secteur bancaire — T3 2024', 'description' => "Évolution du secteur bancaire au 3e trimestre 2024 : dynamique des dépôts, crédits, qualité des actifs et indicateurs de liquidité.", 'kpis' => [['v' => '+6,2%', 'l' => 'Crédit T3'], ['v' => '3,1%', 'l' => 'Taux créances douteuses'], ['v' => '118%', 'l' => 'Ratio liquidité moyen']], 'date_publication' => 'Octobre 2024', 'nombre_pages' => 32],
            ['categorie' => 'Étude thématique', 'titre' => 'Inclusion financière et développement économique', 'description' => "Analyse du lien entre accès aux services financiers et croissance. Recommandations pour atteindre 75% d'inclusion à l'horizon 2030.", 'kpis' => [['v' => '61,3%', 'l' => 'Taux inclusion actuel'], ['v' => '75%', 'l' => 'Objectif 2030'], ['v' => '320K', 'l' => 'Non-bancarisés potentiels']], 'date_publication' => 'Juin 2024', 'nombre_pages' => 56],
            ['categorie' => 'Analyse sectorielle', 'titre' => 'Microfinance : bilan et perspectives 2024', 'description' => "Bilan complet du secteur : cartographie des IMF agréées, performances, reach géographique et défis prudentiels.", 'kpis' => [['v' => '28', 'l' => 'IMF agréées'], ['v' => '185K', 'l' => 'Clients actifs'], ['v' => '42 Mds', 'l' => 'Encours FCFA']], 'date_publication' => 'Mars 2024', 'nombre_pages' => 41],
            ['categorie' => 'Document de travail', 'titre' => 'Financement des PME et croissance économique', 'description' => "Contraintes de financement des PME gabonaises, mécanismes de garantie et pistes pour améliorer l'accès au crédit hors pétrole.", 'kpis' => [['v' => '68%', 'l' => 'PME sans accès formel'], ['v' => '12%', 'l' => 'PIB financé hors pétrole'], ['v' => '3,2×', 'l' => 'Multiplicateur invest. PME']], 'date_publication' => 'Décembre 2023', 'nombre_pages' => 68],
        ];

        foreach ($etudes as $i => $e) {
            Etude::create($e + ['ordre' => $i]);
        }
    }
}
