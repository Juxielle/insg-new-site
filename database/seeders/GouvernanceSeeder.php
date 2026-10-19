<?php

namespace Database\Seeders;

use App\Models\Gouvernance;
use Illuminate\Database\Seeder;

class GouvernanceSeeder extends Seeder
{
    public function run(): void
    {
        $membres = [
            [
                'name' => 'Pr. Murielle Natacha M\'BOUNA',
                'role' => 'Directeur Général de l\'INSG',
                'division' => 'Direction Générale',
                'bio' => 'Professeur titulaire en sciences économiques et de gestion, engagée pour l\'excellence académique, la digitalisation pédagogique et le rayonnement régional de l\'INSG.',
                'quote' => 'Depuis sa création, l\'Institut National des Sciences de Gestion s\'est imposé comme une référence dans la formation des cadres gabonais. Notre ambition associe rigueur académique, ouverture internationale et proximité avec le monde socio-économique pour faire de chaque étudiant un acteur compétitif du développement.',
                'photo' => 'assets/images/directeur-1.png',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Jean-Baptiste ELLA',
                'role' => 'Directeur des Affaires Académiques',
                'division' => 'Direction des Affaires Académiques',
                'bio' => 'Supervision des programmes de Licence et Master, coordination des départements pédagogiques, des jurys d\'examens et du suivi des stages professionnels.',
                'quote' => null,
                'photo' => null,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Mme Chantal NTOUTOUME',
                'role' => 'Secrétaire Générale',
                'division' => 'Secrétariat Général',
                'bio' => 'Pilotage des ressources humaines, de l\'administration générale, du budget, de la logistique campus et de la modernisation des infrastructures.',
                'quote' => null,
                'photo' => null,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Alain Patrick MVE',
                'role' => 'Directeur de la Recherche et de la Coopération',
                'division' => 'Direction de la Recherche',
                'bio' => 'Animation du Centre d\'Études et de Recherche en Management et Économie (CERME), partenariats interuniversitaires et publications scientifiques.',
                'quote' => null,
                'photo' => null,
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($membres as $m) {
            Gouvernance::updateOrCreate(
                ['name' => $m['name']],
                $m
            );
        }
    }
}

