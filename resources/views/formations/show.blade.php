@extends('layouts.app')

@section('title', $formation->title . ' - Formations INSG Gabon')
@section('meta_description', Str::limit(strip_tags($formation->description), 155))

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => [
            'Formations' => route('formations.index'),
            $formation->title => ''
        ]])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>{{ $formation->title }}</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">
                            <strong>{{ $formation->level }}</strong> &ndash; {{ $formation->department }}
                            @if($formation->duration) &bull; Durée : {{ $formation->duration }} @endif
                        </p>

                        @if($formation->image_url)
                            <figure class="photo" style="margin: 1.5em 0;">
                                <img src="{{ $formation->image_url }}" alt="{{ $formation->title }}" style="width: 100%; max-height: 400px; object-fit: cover;" />
                                <figcaption class="legende">{{ $formation->title }} &ndash; INSG Gabon</figcaption>
                            </figure>
                        @endif

                        <h2>Présentation de la filière</h2>
                        <p>{!! nl2br(e($formation->description)) !!}</p>

                        @if($formation->objectives)
                            <h2>Objectifs de la formation</h2>
                            <div>{!! nl2br(e($formation->objectives)) !!}</div>
                        @endif

                        @if($formation->admission_requirements)
                            <h2>Conditions d'admission &amp; Prérequis</h2>
                            <div>{!! nl2br(e($formation->admission_requirements)) !!}</div>
                        @endif

                        <p style="margin-top: 2.5em;">
                            <a href="{{ route('formations.index') }}" class="lien_interne"><strong>&laquo; Retour à l'ensemble des formations</strong></a>
                        </p>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                @if(isset($relatedFormations) && $relatedFormations->count() > 0)
                    <div class="ligne_2"><div class="colonne_1">
                        <div class="colonne_deco"><div class="paragraphe--4">
                            <h2 class="paragraphe__titre--4">Formations similaires</h2>
                            <div class="paragraphe__contenu--4 toolbox">
                                <ul class="objets actualites">
                                    @foreach($relatedFormations as $rf)
                                        <li class="avec_vignette">
                                            <div class="vignette_deco">
                                                <a href="{{ route('formations.show', $rf->slug) }}">
                                                    <img class="vignette" src="{{ $rf->image_url }}" alt="{{ $rf->title }}">
                                                </a>
                                            </div>
                                            <div class="vignette_deco2">
                                                <strong><a href="{{ route('formations.show', $rf->slug) }}" class="lien_interne">{{ $rf->title }}</a></strong>
                                                <div class="date"><span class="date--debut">{{ $rf->level }} &bull; {{ $rf->department }}</span></div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div></div>
                    </div></div>
                @endif

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Fiche Synthétique</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <ul>
                            <li><strong>Niveau :</strong> {{ $formation->level }}</li>
                            <li><strong>Département :</strong> {{ $formation->department }}</li>
                            <li><strong>Durée :</strong> {{ $formation->duration ?? '3 ans' }}</li>
                            <li><strong>Régime :</strong> Formation Initiale / Continue</li>
                            <li><strong>Campus :</strong> Libreville</li>
                            <li><strong>Validation :</strong> Diplôme National d'État (CAMES)</li>
                        </ul>
                        <p>
                            <a href="{{ route('admissions') }}" class="button"><span>Candidater à cette filière</span></a>
                        </p>
                        <p>
                            ► <a href="{{ route('contact') }}" class="lien_interne">Poser une question</a>
                        </p>
                    </div>
                </div>

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Admissions &amp; Concours</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('admissions') }}" class="lien_interne">Modalités de candidature</a><br>
                        ► <a href="/calendrier-orientation-et-insertion-professionnelle" class="lien_interne">Calendrier des épreuves</a><br>
                        ► <a href="/alternance" class="lien_interne">Formation continue</a>
                    </div>
                </div>
            </aside>
        </div><!-- #contenu-encadres -->

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div><!-- #page_deco -->
    <div class="separateur"></div>
</main>
@endsection
