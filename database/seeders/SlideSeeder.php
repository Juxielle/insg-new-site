<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;

class SlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'title' => 'Cérémonie de Remise des Diplômes',
                'subtitle' => 'L\'Institut National des Sciences de Gestion célèbre ses diplômés de Licence et Master professionnel, prêts à intégrer le monde de l\'entreprise avec excellence et éthique.',
                'image' => 'assets/images/1759791578740.jpg.jpeg',
                'link_url' => '/formations',
                'link_text' => 'Découvrir nos filières',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Rentrée Académique 2026-2027 : Inscriptions',
                'subtitle' => 'Rejoignez une institution académique de premier plan à Libreville. Inscriptions et concours d\'entrée ouverts pour les filières BTS, Licence et Master.',
                'image' => 'assets/images/insg-back-11.jpeg',
                'link_url' => '/admissions',
                'link_text' => 'Candidater en ligne',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Partenariat Stratégique avec la Fondation BGFI Bank',
                'subtitle' => 'Un accord d\'envergure renforçant l\'Incubateur des Métiers, l\'immersion professionnelle et les bourses d\'excellence au sein du premier groupe financier en Afrique Centrale.',
                'image' => 'assets/images/insg-back-10.jpeg',
                'link_url' => '/entreprises-et-partenaires',
                'link_text' => 'En savoir plus',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Un Encadrement Pédagogique de Haut Niveau',
                'subtitle' => 'Des enseignants-chercheurs et praticiens experts engagés pour une formation rigoureuse en Finance, Comptabilité, Marketing, RH et Management.',
                'image' => 'assets/images/insg-back-2.jpeg',
                'link_url' => '/a-propos',
                'link_text' => 'Découvrir l\'INSG',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Infrastructures Modernes & Pédagogie Active',
                'subtitle' => 'Des amphithéâtres équipés et des environnements connectés favorisant le travail d\'équipe, le leadership et l\'esprit d\'innovation au cœur de Libreville.',
                'image' => 'assets/images/insg-back-4.jpeg',
                'link_url' => '/campus',
                'link_text' => 'Visiter le campus',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            Slide::updateOrCreate(
                ['title' => $slide['title']],
                $slide
            );
        }
    }
}

