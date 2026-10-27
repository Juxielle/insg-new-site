@extends('layouts.app')

@section('title', 'L\'Institut National des Sciences de Gestion (INSG Gabon) - Présentation')
@section('meta_description', 'Fondé en 1973 à Libreville, l\'INSG est l\'établissement public d\'enseignement supérieur de référence au Gabon et dans la zone CEMAC pour les sciences managériales.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Institut' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>L'Institut National des Sciences de Gestion (INSG Gabon)</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo"><strong>Fondé en 1973 à Libreville</strong>, l'<strong>Institut National des Sciences de Gestion (INSG)</strong> est l'établissement public d'enseignement supérieur de référence au Gabon et dans la sous-région CEMAC. Fort de plus de 50 années d'excellence académique, l'INSG forme les cadres, gestionnaires, auditeurs et dirigeants qui pilotent l'économie et les entreprises gabonaises.</p>
                        <p>L'Institut National des Sciences de Gestion conjugue la rigueur scientifique de l'institut public avec le professionnalisme des grandes écoles de management. Il propose des formations professionnalisantes du Bac+2 (BTS) au Master Professionnel (Bac+5), en formation initiale comme en formation continue, au sein de ses filières spécialisées en <strong>Finance, Comptabilité, Marketing, Ressources Humaines, Management, Banque, Audit et Informatique de Gestion</strong>.</p>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2" id="mot-directeur"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Une Direction engagée pour la réussite</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <figure class="photo vignette_gauche" style="float: left; margin: 0 1.5em 1em 0;">
                                <img src="{{ $director->photo_url ?? asset('assets/images/directeur-1.png') }}" alt="{{ $director->name ?? 'Directrice Générale de l\'INSG' }}" style="width: 180px; max-width: 180px;" />
                                <figcaption class="legende">
                                    <strong>{{ $director->name ?? 'Pr. Murielle Natacha M\'BOUNA' }}</strong><br>
                                    <small>{{ $director->role ?? 'Directeur Général de l\'INSG' }}</small>
                                </figcaption>
                            </figure>
                            <p class="chapo">« {{ $director->quote ?? 'Depuis sa création, l\'Institut National des Sciences de Gestion s\'est imposé comme une référence dans la formation des cadres gabonais. Notre ambition associe rigueur académique, ouverture internationale et proximité avec le monde socio-économique pour faire de chaque étudiant un acteur compétitif du développement.' }} »</p>
                            <p>► <a href="{{ route('formations.index') }}" class="lien_interne"><strong>Découvrir toutes les offres de formations de l'INSG</strong></a></p>
                            <div style="clear: both;"></div>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

                <div class="ligne_3" id="gouvernance-axes"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Organisation &amp; Pôles d'Excellence</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <p>L'Institut National des Sciences de Gestion est structuré autour de directions opérationnelles et de comités scientifiques garantissant la fluidité du parcours académique et l'insertion professionnelle :</p>
                            @if(isset($gouvernances) && $gouvernances->isNotEmpty())
                                <ul>
                                    @foreach($gouvernances as $gov)
                                        <li>
                                            <strong>{{ $gov->division ?? $gov->role }} :</strong> {{ $gov->name }} &ndash; <em>{{ $gov->bio ?? $gov->role }}</em>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul>
                                    <li><strong>Direction Générale :</strong> Pilotage stratégique, gouvernance institutionnelle, partenariats nationaux et sous-régionaux.</li>
                                    <li><strong>Direction des Affaires Académiques :</strong> Coordination pédagogique, gestion des examens, encadrement des corps professoraux et stages.</li>
                                    <li><strong>Secrétariat Général :</strong> Ressources humaines, gestion financière, logistique, sécurité et entretien des infrastructures du campus.</li>
                                    <li><strong>Direction de la Recherche :</strong> Animation des équipes de recherche CERME, CRDG et CERGIC.</li>
                                </ul>
                            @endif
                            <p>► <a href="/gouvernance" class="lien_interne"><strong>Consulter la gouvernance complète et l'organigramme</strong></a><br>
                               ► <a href="/chiffres-cles" class="lien_interne"><strong>Consulter les chiffres clés de l'INSG</strong></a><br>
                               ► <a href="{{ route('campus') }}" class="lien_interne"><strong>Découvrir le campus de Libreville</strong></a></p>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_3 -->

            </div><!-- #avec_nav_sans_encadres .contenu -->
        </div><!-- #contenu-encadres -->

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div><!-- #page_deco -->
    <div class="separateur"></div>
</main>
@endsection
