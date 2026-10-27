@extends('layouts.app')

@section('title', 'Agenda & Événements - INSG Gabon')
@section('meta_description', 'Découvrez les événements, colloques, journées portes ouvertes, conférences et cérémonies officielles de l\'INSG Gabon à Libreville.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Agenda & Événements' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Agenda de l'Institut</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">Retrouvez l'ensemble des rendez-vous académiques, scientifiques, culturels et professionnels qui rythment l'année universitaire à l'INSG Gabon.</p>
                        <h3>Événements à venir</h3>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <ul class="objets actualites avec-date">
                            @forelse($evenements as $evt)
                                <li class="avec_vignette">
                                    <div class="vignette_deco">
                                        <a href="{{ route('evenements.show', $evt->slug) }}">
                                            <img class="vignette" src="{{ $evt->image_url }}" alt="{{ $evt->title }}">
                                        </a>
                                    </div>
                                    <div class="vignette_deco2">
                                        <strong>
                                            <a href="{{ route('evenements.show', $evt->slug) }}" class="lien_interne">
                                                {{ $evt->title }}
                                            </a>
                                        </strong>
                                        <div class="date">
                                            <span class="date--debut">{{ $evt->start_date ? $evt->start_date->translatedFormat('d F Y') : 'À venir' }}</span>
                                            @if($evt->end_date && $evt->end_date != $evt->start_date)
                                                <span class="date--fin">{{ $evt->end_date->translatedFormat('d F Y') }}</span>
                                            @endif
                                        </div>
                                        @if($evt->location)
                                            <p style="margin-bottom: 0.3em;"><strong>Lieu :</strong> {{ $evt->location }}</p>
                                        @endif
                                        @if($evt->description)
                                            <p>{{ Str::limit(strip_tags($evt->description), 140) }}</p>
                                        @endif
                                    </div>
                                </li>
                            @empty
                                <li><em>Aucun événement programmé pour le moment.</em></li>
                            @endforelse
                        </ul>

                        @if(method_exists($evenements, 'links'))
                            <p class="pagination" style="margin-top: 1.5em;">
                                {{ $evenements->links() }}
                            </p>
                        @endif
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Actualités de l'Institut</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('actualites.index') }}" class="lien_interne">Toute l'actualité</a><br>
                        ► <a href="/communiques" class="lien_interne">Communiqués officiels</a>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Vie de l'Institut</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('campus') }}" class="lien_interne">Le campus</a><br>
                        ► <a href="{{ route('vie-associative') }}" class="lien_interne">Vie associative &amp; clubs</a><br>
                        ► <a href="{{ route('formations.index') }}" class="lien_interne">Offre de formations</a>
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
