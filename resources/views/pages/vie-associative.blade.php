@extends('layouts.app')

@section('title', 'Vie étudiante | INSG')
@section('meta_description', 'Clubs, événements et activités étudiantes de l\'INSG.')
@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Vie Associative' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Vie Associative &amp; Engagement Étudiant</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
<p class="chapo">Clubs, associations, sport et culture : la vie à l'INSG ne s'arrête pas aux salles de cours.</p><h2>Développez vos talents en dehors des cours</h2><p>Les activités associatives développent le leadership, la créativité et l’engagement citoyen.</p><ul><li><strong>Finance et investissement :</strong> Analyses de cas, simulations et rencontres professionnelles.</li><li><strong>Art oratoire et débat :</strong> Ateliers de prise de parole et compétitions inter-écoles.</li><li><strong>Digital et innovation :</strong> Veille technologique, hackathons et entrepreneuriat numérique.</li></ul>
</div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Sports, Événements et Culture</h2>
                        <div class="paragraphe__contenu--4 toolbox"><p>L’INSG veille au bien-être, à l’épanouissement et à la santé de sa communauté étudiante.</p><ul><li><strong>Santé &amp; Écoute :</strong> Orientation médico-sociale, prévention et cellule d’écoute pour accompagner les étudiants.</li><li><strong>Inclusion &amp; Handicap :</strong> Aménagements d’études et accessibilité pour garantir l’égalité des chances.</li><li><strong>Sport &amp; Culture :</strong> Activités sportives universitaires, tournois inter-facultés et événements culturels.</li></ul>

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
