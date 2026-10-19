@extends('layouts.app')

@section('title', 'Vie Associative & Engagement Étudiant - INSG Gabon')
@section('meta_description', 'Découvrez la vie associative riche et dynamique de l\'INSG Gabon : Bureau des Étudiants (BDE), clubs spécialisés, activités sportives et événements culturels.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Vie Associative' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>Vie Associative &amp; Engagement Étudiant</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <p class="chapo">À l'Institut National des Sciences de Gestion, la vie étudiante est au cœur du développement personnel et professionnel. Avec plus de 15 clubs et associations actives, les étudiants développent leur sens des responsabilités, leur esprit d'équipe et leur réseau.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- BDE & Clubs Section --}}
                <div class="ligne_2" id="clubs">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Le Bureau des Étudiants (BDE) et les Clubs spécialisés</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin: 1.5rem 0;">
                                        
                                        <div style="background: #f7f8fa; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.5rem;">
                                            <div style="font-size: 1.75rem; margin-bottom: 0.5rem;">🎓</div>
                                            <h3 style="margin-top: 0; color: var(--uas-couleur-principale, #1f234b);">Bureau Des Étudiants (BDE)</h3>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;">Porte-parole officiel de la communauté estudiantine, le BDE anime la vie du campus, organise la semaine d'intégration, les conférences thématiques et les soirées de gala.</p>
                                        </div>

                                        <div style="background: #f7f8fa; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.5rem;">
                                            <div style="font-size: 1.75rem; margin-bottom: 0.5rem;">📈</div>
                                            <h3 style="margin-top: 0; color: var(--uas-couleur-principale, #1f234b);">Club Finance &amp; Bourse</h3>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;">Ateliers de simulation boursière, analyse financière des entreprises de la sous-région et préparation aux certifications professionnelles du secteur bancaire.</p>
                                        </div>

                                        <div style="background: #f7f8fa; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.5rem;">
                                            <div style="font-size: 1.75rem; margin-bottom: 0.5rem;">💡</div>
                                            <h3 style="margin-top: 0; color: var(--uas-couleur-principale, #1f234b);">Club Entrepreneuriat &amp; Innovation</h3>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;">Incubateur d'idées en lien direct avec l'Incubateur BGFI-INSG, concours de pitchs de start-ups et rencontres avec de jeunes chefs d'entreprises gabonais.</p>
                                        </div>

                                        <div style="background: #f7f8fa; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.5rem;">
                                            <div style="font-size: 1.75rem; margin-bottom: 0.5rem;">📢</div>
                                            <h3 style="margin-top: 0; color: var(--uas-couleur-principale, #1f234b);">Club Débat &amp; Éloquence</h3>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;">Tournois d'art oratoire, simulations de négociations commerciales et plaidoyers favorisant l'assurance verbale et la prise de parole en public.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sports & Culture --}}
                <div class="ligne_3">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Sports, Tournois et Culture</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <p>Le sport et les activités culturelles constituent des piliers de cohésion et d'équilibre à l'INSG :</p>
                                    <ul style="line-height: 1.8; color: #444; font-size: 0.95rem;">
                                        <li><strong>Tournoi omnisports annuel de l'INSG :</strong> football, basketball, volleyball inter-filières et inter-promotions.</li>
                                        <li><strong>Journées culturelles et gastronomiques :</strong> célébration de la diversité des terroirs et des cultures africaines représentées au sein de l'institut.</li>
                                        <li><strong>Cérémonie de remise des diplômes :</strong> événement solennel réunissant chaque année familles, enseignants et partenaires du monde des affaires.</li>
                                    </ul>

                                    <div style="margin: 2rem 0; display: flex; gap: 12px; flex-wrap: wrap;">
                                        <img src="{{ asset('assets/images/insg-back-11.jpeg') }}" alt="Étudiants INSG" style="max-height: 200px; border-radius: 4px; object-fit: cover;" />
                                        <img src="{{ asset('assets/images/1759791578740.jpg.jpeg') }}" alt="Gala INSG" style="max-height: 200px; border-radius: 4px; object-fit: cover;" />
                                        <img src="{{ asset('assets/images/insg-back-9.jpeg') }}" alt="Activités INSG" style="max-height: 200px; border-radius: 4px; object-fit: cover;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                {{-- Témoignages & Paroles d'Alumni Section --}}
                @if(isset($temoignages) && $temoignages->isNotEmpty())
                <div class="ligne_4" id="temoignages">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="card temoignagelyon3Card">
                                <div class="temoignage_entete">
                                    <h2>Paroles d'Alumni &amp; Réussites</h2>
                                    <p>Découvrez les retours d'expérience et parcours inspirants de nos diplômés en poste au Gabon et à l'international.</p>
                                </div>
                                <div class="temoignages_grid">
                                    @foreach($temoignages as $item)
                                        <div class="temoignage_item">
                                            <div class="temoignage_quote">
                                                <p>« {{ $item->content }} »</p>
                                            </div>
                                            <div class="temoignage_author">
                                                <img src="{{ $item->avatar_url }}" alt="{{ $item->name }}" class="temoignage_avatar" />
                                                <div class="temoignage_info">
                                                    <strong class="temoignage_name">{{ $item->name }}</strong>
                                                    <span class="temoignage_role">{{ $item->role }}</span>
                                                    @if($item->promotion)
                                                        <span class="temoignage_promo">{{ $item->promotion }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div>
    <div class="separateur"></div>
</main>
@endsection

