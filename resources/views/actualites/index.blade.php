@extends('layouts.app')

@section('title', 'Actualités de l\'INSG')
@section('meta_description', 'Suivez les actualités académiques, partenariats et événements de l\'INSG.')
@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Actualités' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Toutes les actualités de l'INSG Gabon</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">Restez informé de la vie académique, des concours, des innovations pédagogiques, des partenariats industriels et des grands rendez-vous de l'Institut National des Sciences de Gestion de Libreville.</p>
                        <h3>Suivez l'actualité de l'Institut</h3>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        @if($actualites->count() > 0)
                            <ul class="objets actualites avec-date">
                                @foreach($actualites as $act)
                                    <li class="avec_vignette">
                                        <div class="vignette_deco">
                                            <a href="{{ route('actualites.show', $act->slug) }}">
                                                <img class="vignette" src="{{ $act->image_url }}" alt="{{ $act->title }}">
                                            </a>
                                        </div>
                                        <div class="vignette_deco2">
                                            <strong>
                                                <a href="{{ route('actualites.show', $act->slug) }}" class="lien_interne">
                                                    {{ $act->title }}
                                                </a>
                                            </strong>
                                            @if($act->published_at)
                                                <div class="date">
                                                    <span class="date--debut">{{ $act->published_at->translatedFormat('d F Y') }}</span>
                                                </div>
                                            @endif
                                            <p>{{ $act->excerpt ?? Str::limit(strip_tags($act->content), 140) }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <p class="pagination" style="margin-top: 1.5em;">
                                {{ $actualites->links() }}
                            </p>
                        @else
                            <p><em>Aucune actualité ne correspond aux critères sélectionnés.</em></p>
                            <p>► <a href="{{ route('actualites.index') }}" class="lien_interne"><strong>Voir toutes les actualités</strong></a></p>
                        @endif
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Agenda</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('evenements.index') }}" class="lien_interne">Consulter l'agenda de l'Institut</a><br>
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
