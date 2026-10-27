@extends('layouts.app')

@section('title', $evenement->title . ' - Événements INSG Gabon')
@section('meta_description', $evenement->summary ?? Str::limit(strip_tags($evenement->description), 150))

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => [
            'Agenda & Événements' => route('evenements.index'),
            $evenement->title => ''
        ]])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <div class="date-publication-maj">
                    <span class="date-publication">Date : {{ $evenement->formatted_period ?? ($evenement->start_date ? $evenement->start_date->translatedFormat('d F Y') : '') }}</span>
                    @if($evenement->location) &ndash; <span>Lieu : {{ $evenement->location }}</span> @endif
                </div>

                <h1>{{ $evenement->title }}</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        @if($evenement->image)
                            <figure class="photo" style="margin: 1.5em 0;">
                                <img src="{{ $evenement->image_url }}" alt="{{ $evenement->title }}" style="width: 100%; max-height: 440px; object-fit: cover;" />
                                <figcaption class="legende">{{ $evenement->title }}</figcaption>
                            </figure>
                        @endif

                        @if($evenement->summary)
                            <p class="chapo">
                                {{ $evenement->summary }}
                            </p>
                        @endif

                        <div id="description" class="toolbox">
                            {!! nl2br(e($evenement->description)) !!}
                        </div>

                        <p style="margin-top: 2.5em;">
                            <a href="{{ route('evenements.index') }}" class="lien_interne"><strong>&laquo; Retour à l'agenda</strong></a>
                        </p>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Agenda</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('evenements.index') }}" class="lien_interne">Consulter tout l'agenda</a><br>
                        ► <a href="{{ route('actualites.index') }}" class="lien_interne">Toutes les actualités</a>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Informations</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        @if($evenement->location)
                            <p><strong>Lieu :</strong> {{ $evenement->location }}</p>
                        @endif
                        @if($evenement->organizer)
                            <p><strong>Organisateur :</strong> {{ $evenement->organizer }}</p>
                        @endif
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
