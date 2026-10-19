<?php

namespace Database\Seeders;

use App\Models\MediationEtablissement;
use Illuminate\Database\Seeder;

class MediationEtablissementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            '1- Établissements de crédits' => [
                'AFG Bank',
                'BGFI Bank Gabon',
                'Citibank-Gabon',
                'Ecobank Gabon',
                'Orabank Gabon',
                'UGB',
                'UBA',
                'BCEG',
                'BOA GABON',
                'Coris Bank International (CBI Gabon)',
                'Alios Finance',
                'Société de Garantie du Gabon (SGG)',
            ],
            '2- Établissements de Micro Finance (EMF)' => [
                'CECAG EMF',
                'CFEC EMF',
                'SOCREPA EMF',
                'CECAA EMF',
                'COOFIGA EMF',
                'COFIDEC EMF',
                'EMERALD SECURITIES SERVICES',
                'FINAM',
                'SODEC EMF',
                'EXPRESS UNION',
                'EDG EMF',
                'LA REGIONALE EMF',
                'FIDELIS EMF',
                'COFINA EMF',
                'BAMBOO EMF',
                'La PEYRIE',
                'AMIFA EMF',
                'ARIANE FINANCE EMF',
                'SIBAFI',
            ],
            '3- Établissements de paiement' => [
                'AIRTEL MONEY',
                'CLIKPAY GABON',
                'MOOV MONEY',
            ],
            '4- Assurances' => [
                'BGFI ASSURANCE',
                'SANLAM ASSURANCE',
                'AXA GABON',
                'OGAR',
                'SUNU ASSURANCES',
                'NSIA ASSURANCES',
                'SGRE',
            ],
            '5- Intermédiaires marchés' => [
                'BGFIBourse',
                'FINANCIA ASSET MANAGEMENT',
                'AFRICA BRIGHT ASSET MANAGEMENT',
                'ESS BOURSE',
                'ELITE CAPITAL GROUP',
                'DIGITAL BOURSE',
                'FEDHEN CAPITAL',
            ],
        ];

        $globalOrder = 1;

        foreach ($categories as $categorie => $noms) {
            foreach ($noms as $nom) {
                MediationEtablissement::updateOrCreate(
                    ['nom' => $nom],
                    [
                        'categorie' => $categorie,
                        'actif' => true,
                        'ordre' => $globalOrder++,
                    ]
                );
            }
        }
    }
}
