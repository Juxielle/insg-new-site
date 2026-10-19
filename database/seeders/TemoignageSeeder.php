<?php

namespace Database\Seeders;

use App\Models\Temoignage;
use Illuminate\Database\Seeder;

class TemoignageSeeder extends Seeder
{
    public function run(): void
    {
        $temoignages = [
            [
                'name' => 'Marc Ndong Mba',
                'role' => 'Auditeur Financier Senior, PwC Gabon',
                'promotion' => 'Master Audit & Contrôle – Promo 2021',
                'content' => 'La formation à l\'INSG m\'a transmis une rigueur technique et une éthique managériale irréprochables. Dès ma sortie d\'école, j\'ai directement intégré un cabinet international grâce aux cas pratiques et aux normes OHADA révisées maîtrisées en cours.',
                'avatar' => 'assets/images/insg-back-11.jpeg',
                'rating' => 5,
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'name' => 'Sarah Biyoghe',
                'role' => 'Analyste Crédit Entreprises, BGFIBank Gabon',
                'promotion' => 'Licence Pro Finance & Comptabilité – Promo 2023',
                'content' => 'L\'Incubateur des Métiers et les stages en entreprise m\'ont permis de me confronter très tôt aux réalités du secteur bancaire. L\'INSG est indéniablement la référence en sciences de gestion au Gabon.',
                'avatar' => 'assets/images/insg-back-10.jpeg',
                'rating' => 5,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'name' => 'Brice Ondimba',
                'role' => 'Responsable Marketing Digital, Groupe Gabon Telecom',
                'promotion' => 'Master Marketing & Vente – Promo 2022',
                'content' => 'Des professeurs accessibles, un campus moderne et une vie associative dynamique. L\'INSG nous donne toutes les armes pour entreprendre ou piloter des projets d\'envergure dans les grandes entreprises de la sous-région.',
                'avatar' => 'assets/images/insg-back-2.jpeg',
                'rating' => 5,
                'is_featured' => true,
                'order' => 3,
            ],
        ];

        foreach ($temoignages as $item) {
            Temoignage::updateOrCreate(
                ['name' => $item['name']],
                $item
            );
        }
    }
}

