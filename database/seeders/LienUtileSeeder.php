<?php

namespace Database\Seeders;

use App\Models\LienUtile;
use Illuminate\Database\Seeder;

class LienUtileSeeder extends Seeder
{
    public function run(): void
    {
        $groupes = [
            'CNEF des autres pays de la CEMAC' => [
                ['nom' => 'CNEF Cameroun', 'pays' => 'Cameroun', 'capitale' => 'Yaoundé', 'description' => 'Site officiel — bulletins économiques, statistiques, éducation financière, comparateur bancaire', 'url' => 'https://cnefcameroun.cm', 'statut' => 'Actif', 'drapeau_svg' => '<svg width="52" height="32" viewBox="0 0 3 2" style="border-radius:4px;display:block;margin-bottom:10px"><rect width="1" height="2" fill="#007A5E"/><rect x="1" width="1" height="2" fill="#CE1126"/><rect x="2" width="1" height="2" fill="#FCD116"/><polygon points="1.5,0.45 1.62,0.82 1.14,0.57 1.86,0.57 1.38,0.82" fill="#FCD116"/></svg>'],
                ['nom' => 'CNEF Congo', 'pays' => 'Congo-Brazzaville', 'capitale' => 'Brazzaville', 'description' => 'Publications du CNEF via le Ministère des Finances — comptes rendus de sessions, notes conjoncturelles', 'url' => 'https://www.finances.gouv.cg', 'statut' => 'Actif', 'drapeau_svg' => '<svg width="52" height="32" viewBox="0 0 3 2" style="border-radius:4px;display:block;margin-bottom:10px"><rect width="3" height="2" fill="#FBDE4A"/><polygon points="0,0 1.8,0 0,2" fill="#009A44"/><polygon points="3,0 3,2 1.2,2" fill="#DC241F"/></svg>'],
                ['nom' => 'CNEF Tchad', 'pays' => 'Tchad', 'capitale' => "N'Djamena", 'description' => 'Comité National Économique et Financier du Tchad — site institutionnel en cours de déploiement', 'url' => 'https://www.beac.int', 'statut' => 'En déploiement', 'drapeau_svg' => '<svg width="52" height="32" viewBox="0 0 3 2" style="border-radius:4px;display:block;margin-bottom:10px"><rect width="1" height="2" fill="#002664"/><rect x="1" width="1" height="2" fill="#FECB00"/><rect x="2" width="1" height="2" fill="#DC143C"/></svg>'],
                ['nom' => 'CNEF RCA', 'pays' => 'République Centrafricaine', 'capitale' => 'Bangui', 'description' => 'Comité National Économique et Financier de la République Centrafricaine — site en cours de déploiement', 'url' => 'https://www.beac.int', 'statut' => 'En déploiement', 'drapeau_svg' => '<svg width="52" height="32" viewBox="0 0 4 3" style="border-radius:4px;display:block;margin-bottom:10px"><rect width="4" height="0.75" fill="#003082"/><rect y="0.75" width="4" height="0.75" fill="#FFFFFF"/><rect y="1.5" width="4" height="0.75" fill="#289728"/><rect y="2.25" width="4" height="0.75" fill="#FFCB00"/><rect width="0.55" height="3" fill="#DC241F"/></svg>'],
                ['nom' => 'CNEF Guinée Éq.', 'pays' => 'Guinée Équatoriale', 'capitale' => 'Malabo', 'description' => 'Comité Nacional Económico y Financiero de Guinea Ecuatorial — site en cours de déploiement', 'url' => 'https://www.beac.int', 'statut' => 'En déploiement', 'drapeau_svg' => '<svg width="52" height="32" viewBox="0 0 3 2" style="border-radius:4px;display:block;margin-bottom:10px"><rect width="3" height="0.667" fill="#3E9A00"/><rect y="0.667" width="3" height="0.667" fill="#FFFFFF"/><rect y="1.334" width="3" height="0.666" fill="#E32118"/><rect width="0.55" height="2" fill="#0032A0"/></svg>'],
            ],
            'Régulateurs régionaux CEMAC' => [
                ['nom' => 'BEAC', 'description' => "Banque des États de l'Afrique Centrale — banque centrale de la zone CEMAC, tutelle des CNEF", 'url' => 'https://www.beac.int', 'statut' => 'Actif'],
                ['nom' => 'COBAC', 'description' => "Commission Bancaire de l'Afrique Centrale — superviseur bancaire de la CEMAC", 'url' => 'https://www.beac.int/la-cobac/', 'statut' => 'Actif'],
                ['nom' => 'COSUMAF', 'description' => "Commission de Surveillance du Marché Financier de l'Afrique Centrale", 'url' => 'https://cosumaf.org', 'statut' => 'Actif'],
                ['nom' => 'CIMA', 'description' => "Conférence Interafricaine des Marchés d'Assurances — siège à Libreville, Gabon", 'url' => 'https://cima-afrique.org', 'statut' => 'Actif'],
                ['nom' => 'GABAC', 'description' => "Groupe d'Action contre le Blanchiment en Afrique Centrale — LBC/FT dans la CEMAC", 'url' => 'https://www.beac.int/le-gabac/', 'statut' => 'Actif'],
                ['nom' => 'BVMAC', 'description' => "Bourse des Valeurs Mobilières de l'Afrique Centrale — marché financier régional", 'url' => 'https://www.bvm-ac.org', 'statut' => 'Actif'],
            ],
            'Institutions financières internationales' => [
                ['nom' => 'GIMAC', 'description' => "Groupement Interbancaire Monétique de l'Afrique Centrale — interopérabilité des paiements dans la CEMAC", 'url' => 'https://gimac-afr.com', 'statut' => 'Actif'],
                ['nom' => 'Banque Mondiale', 'description' => 'Groupe Banque Mondiale — financement du développement et réduction de la pauvreté', 'url' => 'https://www.worldbank.org', 'statut' => 'Actif'],
                ['nom' => 'FMI', 'description' => 'Fonds Monétaire International — stabilité monétaire et financière mondiale', 'url' => 'https://www.imf.org', 'statut' => 'Actif'],
                ['nom' => 'Banque Africaine de Développement', 'description' => 'BAD — principale institution de financement du développement en Afrique', 'url' => 'https://www.afdb.org', 'statut' => 'Actif'],
                ['nom' => 'BRI', 'description' => 'Banque des Règlements Internationaux — coopération entre banques centrales', 'url' => 'https://www.bis.org', 'statut' => 'Actif'],
                ['nom' => 'IFC', 'description' => 'Société Financière Internationale — financement du secteur privé dans les pays en développement', 'url' => 'https://www.ifc.org', 'statut' => 'Actif'],
                ['nom' => 'BDEAC', 'description' => "Banque de Développement des États de l'Afrique Centrale", 'url' => 'https://www.bdeac.org', 'statut' => 'Actif'],
            ],
            'Banques centrales africaines et mondiales' => [
                ['nom' => 'BCEAO', 'description' => "Banque Centrale des États de l'Afrique de l'Ouest — zone UEMOA", 'url' => 'https://www.bceao.int', 'statut' => 'Actif'],
                ['nom' => 'Bank Al-Maghrib', 'description' => 'Banque Centrale du Royaume du Maroc', 'url' => 'https://www.bkam.ma', 'statut' => 'Actif'],
                ['nom' => 'Banque de France', 'description' => "Banque Centrale française — membre de l'Eurosystème, partenaire BEAC", 'url' => 'https://www.banque-france.fr', 'statut' => 'Actif'],
                ['nom' => 'BCE', 'description' => 'Banque Centrale Européenne — politique monétaire de la zone euro', 'url' => 'https://www.ecb.europa.eu', 'statut' => 'Actif'],
                ['nom' => 'Banque du Maroc', 'description' => 'Bank Al-Maghrib — référence régionale en supervision bancaire et innovation', 'url' => 'https://www.bkam.ma', 'statut' => 'Actif'],
                ['nom' => 'Banque de l\'Algérie', 'description' => 'Autorité monétaire et de contrôle bancaire de la République Algérienne', 'url' => 'https://www.bank-of-algeria.dz', 'statut' => 'Actif'],
            ],
            'Organisations africaines et internationales' => [
                ['nom' => 'Union Africaine', 'description' => 'Union Africaine — intégration continentale et développement économique', 'url' => 'https://au.int', 'statut' => 'Actif'],
                ['nom' => 'CEA — Nations Unies', 'description' => 'Commission Économique pour l\'Afrique — Nations Unies', 'url' => 'https://www.uneca.org', 'statut' => 'Actif'],
                ['nom' => 'OHADA', 'description' => "Organisation pour l'Harmonisation en Afrique du Droit des Affaires", 'url' => 'https://www.ohada.com', 'statut' => 'Actif'],
                ['nom' => 'CEMAC', 'description' => "Communauté Économique et Monétaire de l'Afrique Centrale", 'url' => 'https://www.cemac.int', 'statut' => 'Actif'],
                ['nom' => 'CNUCED', 'description' => 'Conférence des Nations Unies sur le Commerce et le Développement', 'url' => 'https://unctad.org', 'statut' => 'Actif'],
            ],
        ];

        $ordre = 0;
        foreach ($groupes as $groupe => $liens) {
            foreach ($liens as $lien) {
                LienUtile::create($lien + ['groupe' => $groupe, 'ordre' => $ordre++]);
            }
        }
    }
}
