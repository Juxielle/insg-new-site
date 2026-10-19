<?php

namespace Database\Seeders;

use App\Models\Actualite;
use Illuminate\Database\Seeder;

class ActualiteSeeder extends Seeder
{
    public function run(): void
    {
        $actus = [
            ['categorie' => 'reglementation', 'badge_label' => 'Réglementation', 'badge_couleur' => '#E8A317', 'fond_couleur' => '#E8F4EE', 'titre' => 'Arrêté N° 002.25 MEP — Désignation et attributions des médiateurs financiers', 'contenu' => "Fixe la procédure de désignation des médiateurs financiers en RG : conditions d'éligibilité (master + 5 ans), dossier de candidature en 13 pièces, rôle de la COBAC/CIMA/COSUMAF dans la validation. Enregistré au CNEF le 09 janvier 2025.", 'date_publication' => '07 janvier 2025'],
            ['categorie' => 'reglementation', 'badge_label' => 'Réglementation', 'badge_couleur' => '#E8A317', 'fond_couleur' => '#E8F0FE', 'titre' => 'Arrêté N° 001.25 MEP — Modalités de la procédure de médiation financière', 'contenu' => "Précise les règles de saisine (personnes physiques uniquement, réclamation préalable de 45 jours), le déroulement contradictoire et confidentiel, et les 5 cas de clôture de la procédure.", 'date_publication' => '07 janvier 2025'],
            ['categorie' => 'reglementation', 'badge_label' => 'Décret présidentiel', 'badge_couleur' => '#059669', 'fond_couleur' => '#FEF3D9', 'titre' => 'Décret N° 0121/PR/MEP — Organisation de la médiation financière au Gabon', 'contenu' => "Organise la médiation en trois branches : crédit/microfinance/paiement (COBAC), assurance (CIMA) et intermédiaires de marché (COSUMAF). Signé par le Général Oligui Nguema, P.M. Raymond Ndong Sima et Ministre Mays Mouissi.", 'date_publication' => '21 mars 2024'],
            ['categorie' => 'communique', 'badge_label' => 'Publication CNEF', 'badge_couleur' => '#2563EB', 'fond_couleur' => '#E8F4EE', 'titre' => 'Rapport annuel sur la stabilité financière du Gabon 2024', 'contenu' => "Rapport adressé au Président de la République, au Parlement et au Conseil Économique et Social, conformément à l'article 18 du Règlement N° 03/2019/CEMAC/UMAC/CM.", 'date_publication' => 'Janvier 2025'],
            ['categorie' => 'evenement', 'badge_label' => 'Événement', 'badge_couleur' => '#8B5CF6', 'fond_couleur' => '#FEF3D9', 'titre' => "Semaine nationale de l'éducation financière 2025", 'contenu' => "Le CNEF organise la Semaine Nationale de l'Éducation Financière dans les neuf provinces du Gabon, conformément à l'article 9 du Règlement CEMAC sur les missions des CNEF.", 'date_publication' => 'Mai 2025'],
        ];

        foreach ($actus as $i => $a) {
            Actualite::create($a + ['ordre' => $i]);
        }
    }
}
