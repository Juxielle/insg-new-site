<?php

namespace Database\Seeders;

use App\Models\Actualite;
use App\Models\Evenement;
use App\Models\Formation;
use App\Models\Gouvernance;
use App\Models\Slide;
use App\Models\Statistique;
use App\Models\Temoignage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/** Import the reviewed editorial snapshot; never connect to the source site. */
class InsgSourceContentSeeder extends Seeder
{
    public function run(): void
    {
        $source = json_decode(file_get_contents(resource_path('content/insg-source.json')), true, 512, JSON_THROW_ON_ERROR);

        DB::transaction(function () use ($source) {
            $pages = collect($source['pages'])->keyBy('slug');
            $sections = collect($source['sections'])->keyBy('key');

            // Preserve slide images, order, links and the existing carousel.
            $slideTexts = [
                [$pages['home']['hero_title'], $pages['home']['hero_text']],
                [$pages['admissions']['hero_title'], $pages['admissions']['hero_text']],
                [$pages['entreprises']['hero_title'], $pages['entreprises']['hero_text']],
                [$pages['about']['hero_title'], $pages['about']['hero_text']],
                [$sections['campus-life']['title'], $sections['campus-life']['body']],
            ];
            foreach (Slide::orderBy('order')->limit(5)->get() as $i => $slide) {
                $slide->update(['title' => $slideTexts[$i][0], 'subtitle' => $slideTexts[$i][1], 'link_text' => 'En savoir plus']);
            }

            // The source's detailed catalogue supersedes the old sample courses.
            // Keep old records and their URLs available instead of deleting them.
            $legacySlugs = [
                'licence-pro-finance-comptabilite', 'master-pro-audit-controle-gestion',
                'licence-pro-marketing-commerce-international', 'master-pro-management-ressources-humaines',
                'bts-gestion-transports-logistique', 'master-pro-strategie-entrepreneuriat',
            ];
            Formation::whereIn('slug', $legacySlugs)->update(['is_active' => false]);
            foreach ($source['catalogue'] as $group) {
                $level = match ($group['level']) {
                    'Licence professionnelle' => 'Licence Pro',
                    'Licence en science de gestion' => 'Licence',
                    'Master professionnel' => 'Master Pro',
                    'Master recherche' => 'Master Recherche',
                    default => 'BTS',
                };
                foreach ($group['courses'] as $course) {
                    $slug = Str::slug($group['key'].'-'.$course);
                    $record = Formation::firstOrNew(['slug' => $slug]);
                    $record->fill([
                        'title' => $course,
                        'level' => $level,
                        'department' => $group['mode'],
                        // No duration or admission rule is invented from a title.
                        'duration' => '',
                        'summary' => $group['level'].' — '.$group['mode'],
                        'description' => $group['level'].' — '.$course.'. '.$group['mode'].'. '.
                            ($group['mode'] === 'Formation continue'
                                ? 'La formation continue s’adresse aux salariés, aux demandeurs d’emploi et à toute personne souhaitant renforcer, actualiser ou réorienter ses compétences. Elle comprend des parcours diplômants et un programme de perfectionnement professionnel dispensé en cours du soir.'
                                : 'La formation initiale constitue la mission centrale de l’INSG en tant qu’établissement public. Elle prépare les étudiants à exercer dans les principaux domaines de la gestion, du commerce, de la finance et du management.'),
                        'admission_requirements' => 'Consultez les conditions d’admission auprès du service de scolarité pour préparer votre candidature.',
                        'is_active' => true,
                    ]);
                    if (! $record->exists) {
                        $record->image = 'assets/images/insg-back-4.jpeg';
                    }
                    $record->save();
                }
            }

            $keys = ['students_per_year' => 'etudiants', 'programs' => 'filieres', 'teachers' => 'enseignants', 'employment_rate' => 'insertion'];
            foreach ($source['statistics'] as $stat) {
                Statistique::updateOrCreate(['key' => $keys[$stat['key']]], [
                    'value' => (string) $stat['value'].($stat['suffix'] ?? ''),
                    'label' => $stat['label'],
                    'is_active' => true,
                ]);
            }
            Statistique::where('key', 'entreprises')->update([
                'value' => (string) collect($source['partners'])->where('active', 1)->count(),
                'label' => 'partenaires institutionnels et professionnels',
            ]);
            Statistique::where('key', 'laboratoires')->update(['value' => '1973', 'label' => 'année de fondation']);
            Statistique::where('key', 'associations')->update(['value' => '50+', 'label' => 'années d’expérience']);

            $oldNames = ['Marc Ndong Mba', 'Sarah Biyoghe', 'Brice Ondimba'];
            foreach ($source['testimonials'] as $index => $item) {
                $testimonial = Temoignage::where('name', $item['name'])->first()
                    ?? Temoignage::where('name', $oldNames[$index])->first()
                    ?? new Temoignage;
                $testimonial->fill([
                    'name' => $item['name'],
                    'role' => $item['role'], 'content' => $item['quote'],
                    'promotion' => null, 'is_featured' => (bool) $item['featured'], 'order' => $index + 1,
                ]);
                $testimonial->save();
                // Retire the previous sample quote when an earlier import exists.
                Temoignage::where('name', $oldNames[$index])->update(['is_featured' => false]);
            }

            $director = Gouvernance::where('name', 'like', '%Murielle%')->first();
            $director?->update([
                'bio' => 'Maître de conférences, agrégée des universités en sciences de gestion. Responsable du Groupe de Recherche en Gestion. Laboratoire CIREGED, Université Omar Bongo, Libreville.',
                'quote' => trim(html_entity_decode(strip_tags(explode('</p>', $sections['director-message']['body'])[0]))),
            ]);

            Actualite::whereIn('slug', [
                'ceremonie-solennelle-remise-diplomes-2026', 'concours-entree-2026-2027-inscriptions-ouvertes',
                'partenariat-fondation-bgfibank-incubateur-metiers', 'tournoi-inter-classes-2026-football',
                'forum-annuel-emploi-stages-entreprises', 'inauguration-nouvelles-salles-connectees',
            ])->update(['published_at' => null, 'is_featured' => false]);
            foreach ($source['articles'] as $article) {
                $record = Actualite::firstOrNew(['slug' => $article['slug']]);
                $record->fill([
                    'title' => $article['title'], 'category' => $article['category'],
                    'excerpt' => $article['excerpt'], 'content' => $article['content'],
                    'published_at' => $article['published_at'], 'is_featured' => (bool) $article['featured'],
                ]);
                if (! $record->exists) {
                    $record->image = 'assets/images/rentree.png';
                }
                $record->save();
            }
            $legacyEvents = [
                'journee-portes-ouvertes-orientation-2026',
                'colloque-international-gouvernance-finance-durable',
                'gala-annuel-remise-prix-excellence',
            ];
            foreach ($source['events'] as $index => $event) {
                $record = Evenement::where('slug', $legacyEvents[$index])->first()
                    ?? Evenement::firstOrNew(['slug' => Str::slug($event['title'])]);
                $record->fill([
                    'title' => $event['title'], 'location' => $event['location'],
                    'date_start' => $event['starts_at'], 'date_end' => $event['ends_at'],
                    'summary' => $event['title'], 'description' => $event['title'],
                ]);
                $record->save();
            }
        });
    }
}
