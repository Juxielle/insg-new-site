<?php

namespace Database\Seeders;

use App\Models\Actualite;
use App\Models\Evenement;
use App\Models\Formation;
use App\Models\Partenaire;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@insg-gabon.ga'],
            [
                'name' => 'Direction INSG',
                'password' => bcrypt('password'),
            ]
        );

        // 2. Partenaires officiels
        $partenaires = [
            [
                'name' => 'BGFI Bank',
                'slug' => 'bgfi-bank',
                'category' => 'Bancaire & Finance',
                'logo' => 'assets/images/partners/bgfi.png',
                'website_url' => 'https://www.bgfi.com',
                'description' => 'Partenaire bancaire de premier plan, parrain de l\'Incubateur des Métiers et financeur de bourses d\'excellence.',
                'order' => 1,
            ],
            [
                'name' => 'CNSS Gabon',
                'slug' => 'cnss-gabon',
                'category' => 'Institutionnel & Prévoyance',
                'logo' => 'assets/images/partners/cnss.png',
                'website_url' => 'https://www.cnss.ga',
                'description' => 'Caisse Nationale de Sécurité Sociale, partenaire privilégié pour l\'accueil de stagiaires en gestion et RH.',
                'order' => 2,
            ],
            [
                'name' => 'Union Gabonaise de Banque',
                'slug' => 'ugb',
                'category' => 'Bancaire & Finance',
                'logo' => 'assets/images/partners/ugb.png',
                'website_url' => 'https://www.ugb.ga',
                'description' => 'Filiale du Groupe Attijariwafa Bank, partenaire pour les filières Banque, Finance et Audit.',
                'order' => 3,
            ],
            [
                'name' => 'TotalEnergies Gabon',
                'slug' => 'totalenergies-gabon',
                'category' => 'Énergie & Industrie',
                'logo' => 'assets/images/partners/total.jpeg',
                'website_url' => 'https://totalenergies.ga',
                'description' => 'Acteur majeur de l\'énergie au Gabon, soutien aux formations managériales et logistiques.',
                'order' => 4,
            ],
            [
                'name' => 'Airtel Gabon',
                'slug' => 'airtel-gabon',
                'category' => 'Télécommunications & Numérique',
                'logo' => 'assets/images/partners/airtel.png',
                'website_url' => 'https://www.airtel.ga',
                'description' => 'Opérateur leader de télécommunications, partenaire digital et d\'insertion professionnelle.',
                'order' => 5,
            ],
        ];

        foreach ($partenaires as $p) {
            Partenaire::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // 3. Formations d'Excellence INSG
        $formations = [
            [
                'title' => 'Licence Professionnelle Finance - Comptabilité',
                'slug' => 'licence-pro-finance-comptabilite',
                'level' => 'Licence Pro',
                'department' => 'Finance & Comptabilité',
                'duration' => '3 ans (6 semestres)',
                'summary' => 'Formation de référence préparant aux carrières d\'analyste financier, de responsable comptable et de contrôleur financier junior.',
                'description' => 'La Licence Professionnelle en Finance et Comptabilité de l\'INSG offre un socle théorique rigoureux et une immersion pratique intensive. Les étudiants maîtrisent les normes comptables OHADA révisées, la fiscalité des entreprises, la gestion de trésorerie et les outils informatiques de gestion financière.',
                'admission_requirements' => 'Baccalauréat séries B, C, D, CG ou équivalent. Sélection sur concours écrit (Mathématiques, Culture générale, Anglais) et examen de dossier.',
                'career_opportunities' => 'Comptable d\'entreprise, Analyste crédit, Contrôleur de gestion junior, Auditeur financier stagiaire, Gestionnaire de paie.',
                'curriculum' => 'Comptabilité générale approfondie, Analyse financière, Droit des affaires OHADA, Fiscalité des sociétés, Mathématiques financières, Informatique de gestion.',
                'image' => 'assets/images/insg-back-4.jpeg',
                'is_active' => true,
            ],
            [
                'title' => 'Master Professionnel Audit et Contrôle de Gestion',
                'slug' => 'master-pro-audit-controle-gestion',
                'level' => 'Master Pro',
                'department' => 'Finance & Comptabilité',
                'duration' => '2 ans (4 semestres)',
                'summary' => 'Programme d\'excellence pour futurs directeurs financiers, auditeurs internes, auditeurs en cabinets internationaux et contrôleurs de gestion stratégiques.',
                'description' => 'Le Master Pro Audit et Contrôle de Gestion forme des cadres supérieurs capables de concevoir et piloter les systèmes d\'information financière, d\'évaluation des risques et de gouvernance d\'entreprise. Co-animé par des professeurs chevronnés et des experts-comptables de renom.',
                'admission_requirements' => 'Licence ou diplôme Bac+3 en sciences économiques, gestion, finance ou comptabilité. Sélection sur dossier et entretien de motivation.',
                'career_opportunities' => 'Auditeur interne / externe en cabinet international (Big 4), Contrôleur de gestion groupe, Directeur administratif et financier (DAF), Consultant en organisation.',
                'curriculum' => 'Audit financier et légal, Contrôle de gestion stratégique, Gestion des risques & conformité, IFRS et consolidation, Diagnostic stratégique d\'entreprise.',
                'image' => 'assets/images/insg-back-2.jpeg',
                'is_active' => true,
            ],
            [
                'title' => 'Licence Professionnelle Marketing et Commerce International',
                'slug' => 'licence-pro-marketing-commerce-international',
                'level' => 'Licence Pro',
                'department' => 'Marketing & Commerce',
                'duration' => '3 ans (6 semestres)',
                'summary' => 'Prépare aux métiers du marketing digital, de la prospection commerciale, des douanes et du commerce transfrontalier.',
                'description' => 'Cette formation allie techniques commerciales de pointe, stratégies de communication moderne et maîtrise des procédures d\'import-export en Afrique centrale et à l\'international.',
                'admission_requirements' => 'Baccalauréat toutes séries. Concours d\'entrée INSG.',
                'career_opportunities' => 'Responsable marketing opérationnel, Chargé d\'études de marché, Responsable commercial export, Chef de produit junior, Community manager.',
                'curriculum' => 'Marketing stratégique, Digital marketing, Techniques de négociation, Logistique internationale, Douanes et incoterms, Droit du commerce international.',
                'image' => 'assets/images/insg-back-5.jpeg',
                'is_active' => true,
            ],
            [
                'title' => 'Master Professionnel Management des Ressources Humaines',
                'slug' => 'master-pro-management-ressources-humaines',
                'level' => 'Master Pro',
                'department' => 'Management & RH',
                'duration' => '2 ans (4 semestres)',
                'summary' => 'Développe les compétences stratégiques en gestion prévisionnelle des emplois, droit social, dialogue social et transformation des organisations.',
                'description' => 'Le Master RH de l\'INSG répond aux exigences croissantes des grandes entreprises et institutions publiques gabonaises et régionales pour une gestion moderne et éthique du capital humain.',
                'admission_requirements' => 'Bac+3 en Gestion, Droit, Psychologie du travail ou Sciences sociales. Concours et entretien.',
                'career_opportunities' => 'Directeur des Ressources Humaines (DRH), Responsable recrutement et formation, Consultant RH, Responsable relations sociales.',
                'curriculum' => 'Droit du travail approfondi, GPEC, Politique de rémunération, Psychologie des organisations, Audit social et RSE, Négociation collective.',
                'image' => 'assets/images/insg-back-3.jpeg',
                'is_active' => true,
            ],
            [
                'title' => 'BTS Gestion des Transports et Logistique',
                'slug' => 'bts-gestion-transports-logistique',
                'level' => 'BTS',
                'department' => 'Logistique & Transport',
                'duration' => '2 ans (4 semestres)',
                'summary' => 'Formation courte et professionnalisante dans un secteur en pleine expansion au Gabon et en zone CEMAC.',
                'description' => 'Ce BTS dispense une formation concrète sur l\'organisation des flux de marchandises, la gestion des entrepôts, le fret maritime et aérien, ainsi que l\'exploitation des plateformes multimodales.',
                'admission_requirements' => 'Baccalauréat toutes séries techniques ou générales. Sélection sur dossier.',
                'career_opportunities' => 'Agent de transit, Gestionnaire de stocks, Déclarant en douane, Coordinateur transport, Responsable quai.',
                'curriculum' => 'Gestion d\'entrepôt, Droit du transport, Transit maritime et aérien, Systèmes d\'information logistiques, Anglais commercial.',
                'image' => 'assets/images/insg-back-11.jpeg',
                'is_active' => true,
            ],
            [
                'title' => 'Master Professionnel Stratégie, Entrepreneuriat et Innovation',
                'slug' => 'master-pro-strategie-entrepreneuriat',
                'level' => 'Master Pro',
                'department' => 'Management & Stratégie',
                'duration' => '2 ans (4 semestres)',
                'summary' => 'En liaison directe avec l\'Incubateur des Métiers de la Fondation BGFIBank pour accompagner la création d\'entreprises viables.',
                'description' => 'Ce cursus immersif combine l\'apprentissage de la finance d\'entreprise, du business modeling, du venture capital et de la gestion de projets innovants pour faire émerger les champions économiques de demain.',
                'admission_requirements' => 'Bac+3 en Gestion, Économie, Ingénierie ou Sciences. Projet entrepreneurial évalué lors de la candidature.',
                'career_opportunities' => 'Fondateur d\'entreprise, Responsable de pépinière / incubateur, Consultant en innovation, Chef de projet transformation numérique.',
                'curriculum' => 'Business Model & Lean Startup, Financement de l\'innovation, Stratégie concurrentielle, Propriété intellectuelle, Pitch & levée de fonds.',
                'image' => 'assets/images/insg-back-10.jpeg',
                'is_active' => true,
            ],
        ];

        foreach ($formations as $f) {
            Formation::updateOrCreate(['slug' => $f['slug']], $f);
        }

        // 4. Actualités Récentes INSG
        $actualites = [
            [
                'title' => 'Cérémonie solennelle de remise des diplômes : 450 lauréats célébrés',
                'slug' => 'ceremonie-solennelle-remise-diplomes-2026',
                'category' => 'Vie académique',
                'excerpt' => 'L\'amphithéâtre principal de l\'INSG a vibré lors de la remise des toques et parchemins aux promotions de Licence et Master professionnel.',
                'content' => '<p>C\'est dans une ferveur exceptionnelle que s\'est tenue la cérémonie de graduation des lauréats des promotions 2025-2026 de l\'Institut National des Sciences de Gestion (INSG).</p><p>Devant un parterre d\'officiels, de représentants des ministères de tutelle, d\'éminents partenaires économiques et de familles émues, plus de 450 diplômés ont reçu leurs parchemins marquant la fin de leur cycle académique et leur entrée réussie dans le monde de l\'entreprise.</p><p>Dans son allocution magistrale, la Direction Générale a rappelé les valeurs cardinales qui forgent l\'identité de l\'INSG : la rigueur scientifique, l\'éthique professionnelle et le sens des responsabilités au service du développement économique du Gabon et de l\'Afrique centrale.</p>',
                'image' => 'assets/images/1759791578740.jpg.jpeg',
                'is_featured' => true,
                'published_at' => now()->subDays(2),
                'views_count' => 1240,
            ],
            [
                'title' => 'Concours d\'entrée 2026-2027 : Ouverture officielle des inscriptions en ligne',
                'slug' => 'concours-entree-2026-2027-inscriptions-ouvertes',
                'category' => 'Admissions',
                'excerpt' => 'Les bacheliers et titulaires de diplômes universitaires peuvent dès à présent déposer leur candidature pour les cycles BTS, Licence et Master.',
                'content' => '<p>La Direction des Études de l\'INSG informe le public et les candidats bacheliers de l\'ouverture de la session principale du concours d\'entrée au titre de l\'année académique 2026-2027.</p><p>Toutes les filières de gestion, finance, comptabilité, marketing et transport sont ouvertes aux candidatures. Un guichet unique d\'accompagnement est disponible au campus de Libreville ainsi qu\'une plateforme d\'inscription dématérialisée.</p>',
                'image' => 'assets/images/insg-back-11.jpeg',
                'is_featured' => true,
                'published_at' => now()->subDays(5),
                'views_count' => 3890,
            ],
            [
                'title' => 'Partenariat avec la Fondation BGFIBank : Nouvelle impulsion pour l\'Incubateur des Métiers',
                'slug' => 'partenariat-fondation-bgfibank-incubateur-metiers',
                'category' => 'Partenariat',
                'excerpt' => 'Signature d\'une convention stratégique triennale pour booster les startups étudiantes et les stages d\'immersion professionnelle.',
                'content' => '<p>L\'INSG et la Fondation BGFIBank ont consolidé leur alliance stratégique à travers le renouvellement de la convention d\'appui à l\'Incubateur des Métiers de l\'INSG.</p><p>Ce dispositif novateur permet aux porteurs de projets étudiants de bénéficier d\'un mentorat par des banquiers et cadres du premier groupe financier en zone CEMAC, ainsi que d\'un fonds de soutien aux premières phases d\'amorçage.</p>',
                'image' => 'assets/images/insg-back-10.jpeg',
                'is_featured' => true,
                'published_at' => now()->subDays(8),
                'views_count' => 1650,
            ],
            [
                'title' => 'Tournoi Inter-Classes 2026 : La finale de football enflamme le campus',
                'slug' => 'tournoi-inter-classes-2026-football',
                'category' => 'Sport & Vie étudiante',
                'excerpt' => 'Une compétition sportive mémorable réunissant l\'ensemble des promotions dans un esprit de camaraderie et de saine émulation.',
                'content' => '<p>Le complexe sportif de l\'INSG a accueilli la grande finale du Tournoi Inter-Classes de football opposant les Masters en Finance aux Licences en Commerce International.</p><p>Sous les acclamations des supporters et en présence des autorités académiques, les athlètes ont offert un spectacle d\'une grande intensité, couronné par la remise des trophées et une grande fête d\'intégration étudiante.</p>',
                'image' => 'assets/images/insg-back-9.jpeg',
                'is_featured' => false,
                'published_at' => now()->subDays(12),
                'views_count' => 980,
            ],
            [
                'title' => 'Forum Annuel de l\'Emploi et des Stages : Plus de 35 entreprises au rendez-vous',
                'slug' => 'forum-annuel-emploi-stages-entreprises',
                'category' => 'Insertion professionnelle',
                'excerpt' => 'Une opportunité unique pour les futurs diplômés de rencontrer les directeurs des ressources humaines et décrocher des contrats.',
                'content' => '<p>Le Forum de l\'Emploi et des Stages de l\'INSG a rassemblé plus de 35 multinationales, banques, cabinets d\'audit et PME gabonaises venues recruter leurs futurs talents parmi les étudiants de l\'INSG.</p><p>Ateliers de simulation d\'entretiens, relecture de CV, conférences sectorielles et sessions de speed-recruiting ont rythmé cette journée décisive pour l\'insertion professionnelle de nos apprenants.</p>',
                'image' => 'assets/images/insg-back-12.jpeg',
                'is_featured' => false,
                'published_at' => now()->subDays(18),
                'views_count' => 2100,
            ],
            [
                'title' => 'Modernisation des infrastructures : Inauguration des nouvelles salles connectées',
                'slug' => 'inauguration-nouvelles-salles-connectees',
                'category' => 'Campus & Recherche',
                'excerpt' => 'Des espaces équipés de vidéoprojecteurs interactifs et de connexions haut débit pour une pédagogie résolument moderne.',
                'content' => '<p>Dans le cadre de son plan de transformation numérique, l\'INSG a inauguré six nouvelles salles d\'enseignement connectées ainsi qu\'un espace de cotravail dédié aux étudiants-chercheurs.</p><p>Ces aménagements de pointe favorisent la pédagogie active, le travail collaboratif à distance et l\'accès aux ressources documentaires mondiales.</p>',
                'image' => 'assets/images/insg-back-6.jpeg',
                'is_featured' => false,
                'published_at' => now()->subDays(25),
                'views_count' => 840,
            ],
        ];

        foreach ($actualites as $actu) {
            Actualite::updateOrCreate(['slug' => $actu['slug']], $actu);
        }

        // 5. Événements Universitaires
        $evenements = [
            [
                'title' => 'Journée Portes Ouvertes & Orientation 2026',
                'slug' => 'journee-portes-ouvertes-orientation-2026',
                'date_start' => now()->addDays(14)->setTime(9, 0),
                'date_end' => now()->addDays(14)->setTime(17, 0),
                'location' => 'Hall Central & Amphithéâtres, Campus Libreville',
                'summary' => 'Rencontrez les doyens de facultés, enseignants-chercheurs et étudiants ambassadeurs pour préparer votre orientation.',
                'description' => 'La Journée Portes Ouvertes de l\'INSG est le rendez-vous incontournable des élèves de terminale et étudiants désireux de s\'orienter vers les métiers de la gestion, de l\'audit et du commerce. Visites guidées, stands thématiques et ateliers d\'orientation personnalisés au programme.',
                'image' => 'assets/images/insg-back-11.jpeg',
                'organizer' => 'Direction des Études et Scolarité',
            ],
            [
                'title' => 'Colloque International : Gouvernance et Finance Durable en Afrique Centrale',
                'slug' => 'colloque-international-gouvernance-finance-durable',
                'date_start' => now()->addDays(28)->setTime(8, 30),
                'date_end' => now()->addDays(30)->setTime(18, 0),
                'location' => 'Amphithéâtre d\'Honneur, INSG Libreville',
                'summary' => 'Trois jours de débats académiques et d\'échanges avec des experts internationaux autour des enjeux de finance durable.',
                'description' => 'Ce colloque réunit des universitaires d\'Afrique, d\'Europe et d\'Amérique autour des défis de la transparence financière, des critères ESG et du financement de la transition écologique dans le bassin du Congo.',
                'image' => 'assets/images/1759791577009.jpg.jpeg',
                'organizer' => 'Laboratoire de Recherche en Gestion (LAREG)',
            ],
            [
                'title' => 'Gala Annuel & Cérémonie de remise des prix d\'excellence',
                'slug' => 'gala-annuel-remise-prix-excellence',
                'date_start' => now()->addDays(45)->setTime(19, 0),
                'date_end' => now()->addDays(45)->setTime(23, 30),
                'location' => 'Grand Palais des Congrès, Libreville',
                'summary' => 'Soirée de prestige récompensant les majors de promotion et les initiatives étudiantes marquantes de l\'année.',
                'description' => 'Le Gala de l\'INSG réunit alumni, partenaires d\'entreprises et étudiants dans une ambiance festive et élégante pour célébrer l\'excellence académique.',
                'image' => 'assets/images/1759791577830.jpg.jpeg',
                'organizer' => 'Bureau des Étudiants (BDE) & Direction',
            ],
        ];

        foreach ($evenements as $e) {
            Evenement::updateOrCreate(['slug' => $e['slug']], $e);
        }

        // 6. Dynamic Front-End Seeders
        $this->call([
            SlideSeeder::class,
            StatistiqueSeeder::class,
            TemoignageSeeder::class,
            GouvernanceSeeder::class,
            InfrastructureSeeder::class,
        ]);
    }
}
