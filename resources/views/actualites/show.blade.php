@extends('layouts.app')

@section('title', $actualite->title . ' - Actualités INSG Gabon')
@section('meta_description', $actualite->excerpt ?? Str::limit(strip_tags($actualite->content), 150))

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => [
            'Actualités' => route('actualites.index'),
            $actualite->title => ''
        ]])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <div class="date-publication-maj">
                    <span class="date-publication">Publié le {{ $actualite->formatted_date }}</span>
                    @if($actualite->category) &ndash; <span class="rubrique_actualite">{{ $actualite->category }}</span> @endif
                </div>

                <h1>{{ $actualite->title }}</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        @if($actualite->image)
                            <figure class="photo" style="margin: 1.5em 0;">
                                <img src="{{ $actualite->image_url }}" alt="{{ $actualite->title }}" style="width: 100%; max-height: 440px; object-fit: cover;" />
                                <figcaption class="legende">{{ $actualite->title }}</figcaption>
                            </figure>
                        @endif

                        @if($actualite->excerpt)
                            <p class="chapo">
                                {{ $actualite->excerpt }}
                            </p>
                        @endif

                        <div id="description" class="toolbox">
                            {!! nl2br(e($actualite->content)) !!}
                        </div>

                        <p style="margin-top: 2.5em;">
                            <a href="{{ route('actualites.index') }}" class="lien_interne"><strong>&laquo; Retour à toutes les actualités</strong></a>
                        </p>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Actualités de l'Institut</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('actualites.index') }}" class="lien_interne">Toute l'actualité</a><br>
                        ► <a href="/actualites-recherche" class="lien_interne">Actualités de la recherche</a><br>
                        ► <a href="/communiques" class="lien_interne">Communiqués officiels</a>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Agenda &amp; Événements</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('evenements.index') }}" class="lien_interne">Consulter l'agenda</a><br>
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
