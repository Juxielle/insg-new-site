<?php

namespace Database\Seeders;

use App\Models\SecteurEconomique;
use Illuminate\Database\Seeder;

class SecteurEconomiqueSeeder extends Seeder
{
    public function run(): void
    {
        $secteurs = [
            [
                'slug' => 'macro', 'titre' => 'Vue macroéconomique', 'sante' => 'bon',
                'kpis' => [
                    ['l' => 'PIB nominal 2024', 'v' => '10 820 Mds FCFA', 'd' => '▲ +2,8%'],
                    ['l' => 'Recettes pétrolières', 'v' => '4 240 Mds FCFA', 'd' => '▼ -3,1%'],
                    ['l' => 'Recettes non-pétrolières', 'v' => '2 890 Mds FCFA', 'd' => '▲ +8,2%'],
                    ['l' => 'Balance commerciale', 'v' => '+1 640 Mds FCFA', 'd' => 'Excédent'],
                ],
                'branches' => [
                    ['n' => 'Pétrole & Gaz', 'pib' => 40, 'ev' => -2, 'note' => 'Moy'],
                    ['n' => 'Mines & Manganèse', 'pib' => 8, 'ev' => 4, 'note' => 'Bon'],
                    ['n' => 'BTP & Travaux publics', 'pib' => 7, 'ev' => 6, 'note' => 'Bon'],
                    ['n' => 'Agriculture & Agro-industrie', 'pib' => 5, 'ev' => 3, 'note' => 'Moy'],
                    ['n' => 'Commerce & Distribution', 'pib' => 12, 'ev' => 2, 'note' => 'Moy'],
                    ['n' => 'Services financiers', 'pib' => 6, 'ev' => 8, 'note' => 'Bon'],
                    ['n' => 'Télécoms & Numérique', 'pib' => 4, 'ev' => 11, 'note' => 'Bon'],
                    ['n' => 'Forêt & Bois', 'pib' => 5, 'ev' => 1, 'note' => 'Moy'],
                    ['n' => 'Pêche & Aquaculture', 'pib' => 1, 'ev' => -1, 'note' => 'Dif'],
                ],
                'chart_label_1' => 'PIB (% croissance)', 'chart_label_2' => 'Inflation (%)',
                'chart_categories' => ['T1 22', 'T2 22', 'T3 22', 'T4 22', 'T1 23', 'T2 23', 'T3 23', 'T4 23', 'T1 24', 'T2 24', 'T3 24', 'T4 24'],
                'chart_dataset_1' => [2.1, 2.3, 1.8, 2.2, 2.5, 2.4, 2.8, 3.1, 2.9, 3.2, 2.8, 2.8],
                'chart_dataset_2' => [3.2, 3.5, 3.8, 4.1, 3.7, 3.4, 3.5, 3.8, 3.6, 3.2, 3.4, 3.4],
            ],
            [
                'slug' => 'bancaire', 'titre' => 'Secteur bancaire', 'sante' => 'bon',
                'kpis' => [
                    ['l' => 'Actifs totaux', 'v' => '3 247 Mds FCFA', 'd' => '▲ +8,4%'],
                    ['l' => "Crédit à l'économie", 'v' => '1 842 Mds FCFA', 'd' => '▲ +6,1%'],
                    ['l' => 'Dépôts collectés', 'v' => '2 310 Mds FCFA', 'd' => '▲ +7,3%'],
                    ['l' => 'Ratio liquidité moy.', 'v' => '128%', 'd' => '▲ norme 100%'],
                ],
                'branches' => [
                    ['n' => 'BGFI Bank', 'pib' => 35, 'ev' => 5, 'note' => 'Bon'],
                    ['n' => 'UGB', 'pib' => 18, 'ev' => 3, 'note' => 'Bon'],
                    ['n' => 'BICIG', 'pib' => 15, 'ev' => -1, 'note' => 'Moy'],
                    ['n' => 'Ecobank', 'pib' => 12, 'ev' => 8, 'note' => 'Bon'],
                    ['n' => 'Orabank', 'pib' => 11, 'ev' => 4, 'note' => 'Bon'],
                    ['n' => 'Autres banques', 'pib' => 9, 'ev' => 2, 'note' => 'Moy'],
                ],
                'chart_label_1' => 'Crédits (Mds FCFA)', 'chart_label_2' => 'Dépôts (Mds FCFA)',
                'chart_categories' => ['2019', '2020', '2021', '2022', '2023', '2024'],
                'chart_dataset_1' => [1420, 1380, 1495, 1620, 1730, 1842],
                'chart_dataset_2' => [2100, 2050, 2280, 2520, 2890, 3247],
            ],
            [
                'slug' => 'microfinance', 'titre' => 'Microfinance', 'sante' => 'moy',
                'kpis' => [
                    ['l' => 'IMF agréées', 'v' => '28', 'd' => 'Stables'],
                    ['l' => 'Clients actifs', 'v' => '185 000', 'd' => '▲ +9%'],
                    ['l' => 'Encours crédit', 'v' => '42 Mds FCFA', 'd' => '▲ +7,7%'],
                    ['l' => 'Taux impayés moy.', 'v' => '12,3%', 'd' => '▼ Norme 5%'],
                ],
                'branches' => [
                    ['n' => 'FINIDEV', 'pib' => 22, 'ev' => 4, 'note' => 'Bon'],
                    ['n' => 'COOPEC réseau MUCODEC', 'pib' => 31, 'ev' => 2, 'note' => 'Moy'],
                    ['n' => 'Autres IMF cat.1', 'pib' => 18, 'ev' => 3, 'note' => 'Moy'],
                    ['n' => 'IMF cat.2', 'pib' => 29, 'ev' => 6, 'note' => 'Bon'],
                ],
                'chart_label_1' => 'Encours crédit (Mds FCFA)', 'chart_label_2' => 'Clients actifs (milliers)',
                'chart_categories' => ['2020', '2021', '2022', '2023', '2024'],
                'chart_dataset_1' => [28, 30, 33, 36, 42],
                'chart_dataset_2' => [130, 145, 158, 170, 185],
            ],
            [
                'slug' => 'assurance', 'titre' => 'Secteur assurance', 'sante' => 'moy',
                'kpis' => [
                    ['l' => 'Primes collectées', 'v' => '145 Mds FCFA', 'd' => '▲ +5,2%'],
                    ['l' => 'Taux de sinistralité', 'v' => '68%', 'd' => '▼ -2pts'],
                    ['l' => 'Compagnies agréées', 'v' => '14', 'd' => 'Stables'],
                    ['l' => 'Pénétration assurance', 'v' => '1,3%', 'd' => 'Faible'],
                ],
                'branches' => [
                    ['n' => 'NSIA Vie', 'pib' => 28, 'ev' => 6, 'note' => 'Bon'],
                    ['n' => 'AXA Gabon', 'pib' => 22, 'ev' => 3, 'note' => 'Bon'],
                    ['n' => 'OGAR Dommages', 'pib' => 18, 'ev' => 1, 'note' => 'Moy'],
                    ['n' => 'Autres compagnies', 'pib' => 32, 'ev' => 4, 'note' => 'Moy'],
                ],
                'chart_label_1' => 'Primes (Mds FCFA)', 'chart_label_2' => 'Sinistralité (%)',
                'chart_categories' => ['2020', '2021', '2022', '2023', '2024'],
                'chart_dataset_1' => [110, 118, 124, 138, 145],
                'chart_dataset_2' => [68, 72, 71, 70, 68],
            ],
            [
                'slug' => 'paiement', 'titre' => 'Paiement & Monnaie électronique', 'sante' => 'bon',
                'kpis' => [
                    ['l' => 'Transactions mobiles 2024', 'v' => '48 M', 'd' => '▲ +31%'],
                    ['l' => 'Valeur transactions', 'v' => '1 820 Mds FCFA', 'd' => '▲ +28%'],
                    ['l' => 'Comptes actifs', 'v' => '1,4 M', 'd' => '▲ +22%'],
                    ['l' => 'Opérateurs agréés', 'v' => '7', 'd' => '▲ +2 en 2024'],
                ],
                'branches' => [
                    ['n' => 'Airtel Money', 'pib' => 42, 'ev' => 18, 'note' => 'Bon'],
                    ['n' => 'Moov Money', 'pib' => 38, 'ev' => 22, 'note' => 'Bon'],
                    ['n' => 'Autres PSP', 'pib' => 20, 'ev' => 35, 'note' => 'Bon'],
                ],
                'chart_label_1' => 'Valeur transactions (Mds FCFA)', 'chart_label_2' => 'Transactions (millions)',
                'chart_categories' => ['2021', '2022', '2023', '2024'],
                'chart_dataset_1' => [480, 820, 1420, 1820],
                'chart_dataset_2' => [18, 28, 36, 48],
            ],
            [
                'slug' => 'petrole', 'titre' => 'Pétrole & Mines', 'sante' => 'moy',
                'kpis' => [
                    ['l' => 'Production pétrole', 'v' => '170 kb/j', 'd' => '▼ -4%'],
                    ['l' => 'Recettes État pétrole', 'v' => '4 240 Mds', 'd' => '▼ -3,1%'],
                    ['l' => 'Production manganèse', 'v' => '7,8 MT', 'd' => '▲ +3%'],
                    ['l' => 'IDE secteur extractif', 'v' => '620 Mds FCFA', 'd' => '▼ -8%'],
                ],
                'branches' => [
                    ['n' => 'Exploration pétrolière', 'pib' => 28, 'ev' => -6, 'note' => 'Dif'],
                    ['n' => 'Production pétrolière', 'pib' => 62, 'ev' => -4, 'note' => 'Moy'],
                    ['n' => 'Mines de manganèse', 'pib' => 82, 'ev' => 3, 'note' => 'Bon'],
                    ['n' => 'Raffinage & services', 'pib' => 15, 'ev' => -2, 'note' => 'Moy'],
                ],
                'chart_label_1' => 'Production (kb/j)', 'chart_label_2' => 'Recettes État (Mds FCFA)',
                'chart_categories' => ['2020', '2021', '2022', '2023', '2024'],
                'chart_dataset_1' => [200, 195, 188, 177, 170],
                'chart_dataset_2' => [3800, 5200, 6100, 4380, 4240],
            ],
            [
                'slug' => 'agri', 'titre' => 'Agriculture, Forêt & Pêche', 'sante' => 'moy',
                'kpis' => [
                    ['l' => 'Part du PIB', 'v' => '5,2%', 'd' => '▲ +0,4pt'],
                    ['l' => 'Exportations bois', 'v' => '420 000 m³', 'd' => '▼ -8%'],
                    ['l' => 'Production palmier', 'v' => '280 000 T', 'd' => '▲ +12%'],
                    ['l' => 'Crédit rural accordé', 'v' => '18 Mds FCFA', 'd' => '▲ +15%'],
                ],
                'branches' => [
                    ['n' => 'Palmier à huile', 'pib' => 35, 'ev' => 12, 'note' => 'Bon'],
                    ['n' => 'Bois & Transformation', 'pib' => 38, 'ev' => -8, 'note' => 'Moy'],
                    ['n' => 'Cultures vivrières', 'pib' => 14, 'ev' => 4, 'note' => 'Moy'],
                    ['n' => 'Pêche artisanale', 'pib' => 8, 'ev' => -2, 'note' => 'Dif'],
                    ['n' => 'Élevage', 'pib' => 5, 'ev' => 3, 'note' => 'Moy'],
                ],
                'chart_label_1' => 'Prod. palmier (000T)', 'chart_label_2' => 'Crédit rural (Mds FCFA)',
                'chart_categories' => ['2020', '2021', '2022', '2023', '2024'],
                'chart_dataset_1' => [280, 295, 310, 340, 380],
                'chart_dataset_2' => [5, 8, 12, 16, 18],
            ],
            [
                'slug' => 'btp', 'titre' => 'BTP, Commerce & Services', 'sante' => 'bon',
                'kpis' => [
                    ['l' => 'Valeur ajoutée BTP', 'v' => '715 Mds FCFA', 'd' => '▲ +6%'],
                    ['l' => "Chiffre d'aff. commerce", 'v' => '1 240 Mds FCFA', 'd' => '▲ +4,2%'],
                    ['l' => 'Emplois formels créés', 'v' => '4 200', 'd' => '▲ +8%'],
                    ['l' => 'Crédit secteur privé', 'v' => '420 Mds FCFA', 'd' => '▲ +9%'],
                ],
                'branches' => [
                    ['n' => 'Travaux publics & infra.', 'pib' => 42, 'ev' => 8, 'note' => 'Bon'],
                    ['n' => 'Bâtiment & immobilier', 'pib' => 38, 'ev' => 5, 'note' => 'Bon'],
                    ['n' => 'Commerce de gros', 'pib' => 55, 'ev' => 3, 'note' => 'Bon'],
                    ['n' => 'Commerce de détail', 'pib' => 45, 'ev' => 4, 'note' => 'Bon'],
                    ['n' => 'Hôtellerie & Tourisme', 'pib' => 18, 'ev' => 12, 'note' => 'Bon'],
                    ['n' => 'Télécoms', 'pib' => 62, 'ev' => 9, 'note' => 'Bon'],
                ],
                'chart_label_1' => 'Val. BTP (Mds FCFA)', 'chart_label_2' => 'CA Commerce (Mds FCFA)',
                'chart_categories' => ['2020', '2021', '2022', '2023', '2024'],
                'chart_dataset_1' => [480, 520, 580, 670, 715],
                'chart_dataset_2' => [900, 950, 1080, 1190, 1240],
            ],
        ];

        foreach ($secteurs as $i => $s) {
            SecteurEconomique::create($s + ['ordre' => $i]);
        }
    }
}
