<?php

namespace Database\Seeders;

use App\Models\MediationLitige;
use Illuminate\Database\Seeder;

class MediationLitigeSeeder extends Seeder
{
    public function run(): void
    {
        $litiges = [
            ['nature' => 'Contestation de frais / commissions', 'dossiers' => 98, 'resolus' => 86, 'taux' => 87, 'tendance' => '+12%', 'tendance_niveau' => 'g'],
            ['nature' => 'Transaction non autorisée / fraude', 'dossiers' => 74, 'resolus' => 58, 'taux' => 78, 'tendance' => '+28%', 'tendance_niveau' => 'y'],
            ['nature' => 'Clôture / blocage de compte', 'dossiers' => 52, 'resolus' => 47, 'taux' => 90, 'tendance' => '-4%', 'tendance_niveau' => 'g'],
            ['nature' => 'Sinistre assurance non réglé', 'dossiers' => 45, 'resolus' => 34, 'taux' => 75, 'tendance' => '+8%', 'tendance_niveau' => 'y'],
            ['nature' => 'Problème de remboursement crédit', 'dossiers' => 38, 'resolus' => 32, 'taux' => 84, 'tendance' => '-2%', 'tendance_niveau' => 'g'],
            ['nature' => 'Mobile money / paiement électronique', 'dossiers' => 35, 'resolus' => 30, 'taux' => 85, 'tendance' => '+41%', 'tendance_niveau' => 'r'],
        ];

        foreach ($litiges as $i => $l) {
            MediationLitige::create($l + ['ordre' => $i]);
        }
    }
}
