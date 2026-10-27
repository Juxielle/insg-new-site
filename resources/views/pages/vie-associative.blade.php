@extends('layouts.app')

@section('title', 'Vie Associative & Engagement Étudiant - INSG Gabon')
@section('meta_description', 'Découvrez la vie associative riche et dynamique de l\'INSG Gabon : Bureau des Étudiants (BDE), clubs spécialisés, activités sportives et événements culturels.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Vie Associative' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Vie Associative &amp; Engagement Étudiant</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">À l'Institut National des Sciences de Gestion, la vie étudiante est au cœur du développement personnel et professionnel. Avec plus de 15 clubs et associations actives, les étudiants développent leur sens des responsabilités, leur esprit d'équipe et leur réseau.</p>

                        <h2>Le Bureau Des Étudiants (BDE) et les Clubs</h2>
                        <p>Porte-parole officiel de la communauté estudiantine, le <strong>Bureau Des Étudiants</strong> anime la vie du campus, organise les journées d'intégration, les forums métiers, les conférences thématiques et les soirées de gala.</p>

                        <h3>Les clubs thématiques de l'INSG :</h3>
                        <ul>
                            <li><strong>Club Finance &amp; Bourse :</strong> Ateliers d'analyse financière, simulations de marchés boursiers et préparation aux certifications.</li>
                            <li><strong>Club Entrepreneuriat &amp; Innovation :</strong> Concours de pitchs de start-ups, rencontres avec de jeunes dirigeants gabonais et incubateur d'idées.</li>
                            <li><strong>Club Débat &amp; Éloquence :</strong> Tournois d'art oratoire, simulations de négociations commerciales et plaidoyers.</li>
                            <li><strong>Club Marketing &amp; Digital :</strong> Projets de communication événementielle, gestion de réseaux sociaux et veille stratégique.</li>
                        </ul>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Sports, Événements et Culture</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <p>Le sport et les activités culturelles constituent des piliers de cohésion et d'équilibre à l'INSG :</p>
                            <ul>
                                <li><strong>Tournoi omnisports annuel de l'INSG :</strong> Football, basketball, volleyball inter-filières et inter-promotions.</li>
                                <li><strong>Journées culturelles et gastronomiques :</strong> Célébration de la diversité des terroirs et des cultures africaines représentées au sein de l'institut.</li>
                                <li><strong>Cérémonie de remise des diplômes :</strong> Événement solennel réunissant chaque année familles, enseignants et partenaires du monde des affaires.</li>
                            </ul>

                            @if(isset($temoignages) && $temoignages->isNotEmpty())
                                <h3 style="margin-top: 2em;">Paroles d'Alumni &amp; Réussites</h3>
                                @foreach($temoignages as $item)
                                    <blockquote>
                                        <p>« {{ $item->content }} »</p>
                                        <p style="text-align: right;"><strong>{{ $item->name }}</strong> &ndash; {{ $item->role }} @if($item->promotion) (Promo {{ $item->promotion }}) @endif</p>
                                    </blockquote>
                                @endforeach
                            @endif
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Vie étudiante</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <p>Vous souhaitez rejoindre un club ou créer une association étudiante ?</p>
                        <p><a href="{{ route('contact') }}" class="button"><span>Contacter le BDE</span></a></p>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Activités &amp; Campus</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('campus') }}" class="lien_interne">Découvrir le campus</a><br>
                        ► <a href="/culture-1" class="lien_interne">Activités culturelles</a><br>
                        ► <a href="/sport-1" class="lien_interne">Sport universitaire</a>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->
            </aside>
        </div><!-- #contenu-encadres -->

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div><!-- #page_deco -->
    <div class="separateur"></div>
</main>
@endsection
