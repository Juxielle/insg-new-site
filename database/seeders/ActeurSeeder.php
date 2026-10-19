<?php

namespace Database\Seeders;

use App\Models\Acteur;
use Illuminate\Database\Seeder;

class ActeurSeeder extends Seeder
{
    public function run(): void
    {
        $acteurs = [
            ['categorie' => 'bancaire', 'nom' => 'Banques commerciales', 'description' => "Établissements collectant des dépôts et distribuant des crédits au grand public et aux entreprises.", 'badge' => 'Agrément COBAC', 'icone_svg' => '<path d="M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11M20 10v11M8 10v11M16 10v11M12 10v11"/>'],
            ['categorie' => 'bancaire', 'nom' => 'Établissements financiers', 'description' => "Spécialisés dans une ou plusieurs opérations de banque : crédit-bail, affacturage, garanties.", 'badge' => 'Agrément COBAC', 'icone_svg' => '<path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-5v2m0 8v2m-5-5h2m8 0h2"/>'],
            ['categorie' => 'paiement', 'nom' => 'Établissements de paiement', 'description' => "Prestataires de services de paiement : virements, prélèvements, cartes, monnaie électronique.", 'badge' => 'Autorisation CNEF', 'icone_svg' => '<path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>'],
            ['categorie' => 'paiement', 'nom' => 'Opérateurs Mobile Money', 'description' => "Services de paiement via téléphonie mobile : Airtel Money, Moov Money et opérateurs agréés.", 'badge' => 'Autorisation CNEF', 'icone_svg' => '<path d="M12 18h.01M8 21h8a2 2 0 002-2v-2H6v2a2 2 0 002 2zm4-18a9 9 0 00-9 9h2a7 7 0 0114 0h2a9 9 0 00-9-9z"/>'],
            ['categorie' => 'marches', 'nom' => 'Sociétés de bourse', 'description' => "Intermédiaires agréés COSUMAF opérant sur la Bourse des Valeurs Mobilières de l'Afrique Centrale.", 'badge' => 'Agrément COSUMAF', 'icone_svg' => '<path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>'],
            ['categorie' => 'marches', 'nom' => 'Sociétés de gestion de portefeuille', 'description' => "Gestion collective d'actifs financiers pour le compte de tiers.", 'badge' => 'Agrément COSUMAF', 'icone_svg' => '<path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>'],
            ['categorie' => 'assurance', 'nom' => "Compagnies d'assurance vie", 'description' => "Assurance décès, capitalisation, épargne retraite. Soumises au Code CIMA avec avis CNEF.", 'badge' => 'Code CIMA', 'icone_svg' => '<path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>'],
            ['categorie' => 'assurance', 'nom' => 'Assurances dommages', 'description' => "Assurance auto, habitation, responsabilité civile, risques industriels et agricoles.", 'badge' => 'Code CIMA', 'icone_svg' => '<path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
            ['categorie' => 'microfinance', 'nom' => 'COOPEC', 'description' => "Coopératives d'épargne et de crédit : collecte de l'épargne et octroi de prêts aux membres.", 'badge' => 'Agrément COBAC', 'icone_svg' => '<path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
            ['categorie' => 'microfinance', 'nom' => 'IMF cat. 1 & 2', 'description' => "Sociétés de microfinance autorisées à collecter des dépôts (cat.1) ou distribuant seulement du crédit (cat.2).", 'badge' => 'Agrément COBAC', 'icone_svg' => '<path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'],
            ['categorie' => 'economique', 'nom' => 'Secteur pétrolier & minier', 'description' => "Opérateurs pétroliers, miniers et leurs prestataires soumis aux obligations LBC/FT et aux analyses sectorielles.", 'badge' => 'Suivi CNEF', 'icone_svg' => '<path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064"/>'],
            ['categorie' => 'economique', 'nom' => 'Agriculture, forêt & agro-industrie', 'description' => "Filières agricoles et forestières ; analyse du financement rural et des chaînes de valeur.", 'badge' => 'Suivi CNEF', 'icone_svg' => '<path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13"/>'],
            ['categorie' => 'economique', 'nom' => 'BTP, commerce & services', 'description' => "Entreprises des secteurs construction, commerce général, transport et services — analyse de leur accès au crédit.", 'badge' => 'Suivi CNEF', 'icone_svg' => '<path d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>'],
        ];

        foreach ($acteurs as $i => $a) {
            Acteur::create($a + ['ordre' => $i]);
        }
    }
}
