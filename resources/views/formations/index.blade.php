@extends('layouts.app')

@section('title', 'Offre de Formations - BTS, Licences & Masters | INSG Gabon')
@section('meta_description', 'Découvrez les filières et diplômes d\'excellence de l\'INSG Gabon : Finance, Comptabilité, Contrôle & Audit, Marketing, Commerce International, Management des RH.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Formations' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Nos Formations d'Excellence</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">L'<strong>Institut National des Sciences de Gestion</strong> propose un éventail complet de diplômes d'État et de titres professionnels homologués, orientés vers l'employabilité immédiate, l'éthique managériale et la performance en entreprise.</p>
                        <h2><strong>L'offre de formation de l'INSG Gabon</strong></h2>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">1. Cycle BTS (Bac+2)</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <p>Une formation professionnalisante en 2 ans associant enseignements théoriques rigoureux et stages d'immersion :</p>
                            <ul>
                                <li><strong>Comptabilité et Gestion des Organisations (CGO)</strong></li>
                                <li><strong>Action Commerciale &amp; Force de Vente (AC)</strong></li>
                                <li><strong>Commerce International &amp; Douanes (CI)</strong></li>
                            </ul>
                            <p>► <a href="{{ route('formations.index', ['level' => 'BTS']) }}" class="lien_interne">Voir les BTS</a></p>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --><div class="colonne_2">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">2. Cycle Licence Professionnelle (Bac+3)</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <p>Nos filières spécialisées en Sciences de Gestion homologuées CAMES :</p>
                            <ul>
                                <li><strong>Finance &amp; Comptabilité</strong></li>
                                <li><strong>Marketing &amp; Commerce</strong></li>
                                <li><strong>Management des Ressources Humaines</strong></li>
                                <li><strong>Informatique de Gestion &amp; SI</strong></li>
                            </ul>
                            <p>► <a href="{{ route('formations.index', ['level' => 'Licence']) }}" class="lien_interne">Voir les Licences</a></p>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_2 --></div><!-- .ligne_2 -->

                <div class="ligne_3"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">3. Cycle Master Professionnel &amp; MBA (Bac+5)</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <p>Formations de haut niveau pour futurs cadres dirigeants, experts-comptables et consultants :</p>
                            <ul>
                                <li><strong>Audit &amp; Contrôle de Gestion</strong></li>
                                <li><strong>Banque &amp; Ingénierie Financière</strong></li>
                                <li><strong>Stratégie d'Entreprise &amp; Entrepreneuriat</strong></li>
                            </ul>
                            <p>► <a href="{{ route('formations.index', ['level' => 'Master']) }}" class="lien_interne">Voir les Masters</a></p>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_3 -->

                {{-- Dynamic Formations Results --}}
                <div class="ligne_4"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0">
                        <h2 class="paragraphe__titre--4" style="margin-top: 1.5em;">Catalogue des filières @if(request('level') || request('department') || request('q')) &ndash; Résultats filtrés @endif</h2>

                        @if($formations->count() > 0)
                            <ul class="objets actualites" id="liste_resultats">
                                @foreach($formations as $formation)
                                    <li class="avec_vignette">
                                        <div class="vignette_deco">
                                            <a href="{{ route('formations.show', $formation->slug) }}">
                                                <img class="vignette" src="{{ $formation->image_url }}" alt="{{ $formation->title }}">
                                            </a>
                                        </div>
                                        <div class="vignette_deco2">
                                            <strong>
                                                <a href="{{ route('formations.show', $formation->slug) }}" class="lien_interne">
                                                    {{ $formation->title }}
                                                </a>
                                            </strong>
                                            <div class="date">
                                                <span class="date--debut">{{ $formation->level }} &bull; {{ $formation->department }} @if($formation->duration) &bull; {{ $formation->duration }} @endif</span>
                                            </div>
                                            <p>{{ Str::limit(strip_tags($formation->description), 140) }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <p class="pagination" style="margin-top: 1.5em;">
                                {{ $formations->links() }}
                            </p>
                        @else
                            <div class="toolbox">
                                <p><em>Aucune formation ne correspond aux critères sélectionnés.</em></p>
                                <p>► <a href="{{ route('formations.index') }}" class="lien_interne"><strong>Voir l'ensemble du catalogue</strong></a></p>
                            </div>
                        @endif
                    </div><!-- .paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_4 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            {{-- Authentic Univ Lyon 3 Encadrés --}}
            <aside id="encadres" role="complementary">
                <div class="encadre encadre_recherche encadre--2">
                    <h2 class="encadre__titre--2">Rechercher une formation</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <form action="{{ route('formations.index') }}" method="get">
                            <p>
                                <label for="f-q">Mot-clé :</label><br>
                                <input type="text" name="q" id="f-q" value="{{ request('q') ?? request('search') }}" style="width:100%; box-sizing:border-box;">
                            </p>
                            <p>
                                <label for="f-niv">Niveau :</label><br>
                                <span class="select_style" style="width:100%;">
                                    <select name="level" id="f-niv" style="width:100%;">
                                        <option value="">Tous les niveaux</option>
                                        @foreach($niveaux as $niv)
                                            @if($niv)
                                                <option value="{{ $niv }}" {{ (request('level') == $niv || request('niveau') == $niv) ? 'selected' : '' }}>{{ $niv }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </span>
                            </p>
                            <p>
                                <label for="f-dept">Département :</label><br>
                                <span class="select_style" style="width:100%;">
                                    <select name="department" id="f-dept" style="width:100%;">
                                        <option value="">Tous les départements</option>
                                        @foreach($departements as $dept)
                                            @if($dept)
                                                <option value="{{ $dept }}" {{ (request('department') == $dept || request('departement') == $dept) ? 'selected' : '' }}>{{ $dept }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </span>
                            </p>
                            <p>
                                <button type="submit" class="button"><span>Filtrer</span></button>
                                @if(request('q') || request('level') || request('department') || request('niveau') || request('departement'))
                                    <a href="{{ route('formations.index') }}" class="lien_interne" style="margin-left: 8px;">Réinitialiser</a>
                                @endif
                            </p>
                        </form>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Chiffres clés</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <ul>
                            <li><strong>3</strong> filières de BTS</li>
                            <li><strong>8</strong> parcours de Licence professionnelle</li>
                            <li><strong>8</strong> spécialités de Master &amp; MBA</li>
                            <li>Diplômes homologués et reconnus CAMES</li>
                            <li>Partenariats actifs avec le secteur bancaire et pétrolier</li>
                        </ul>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--1">
                    <h2 class="encadre__titre--1">&#192; télécharger</h2>
                    <div class="encadre_contenu encadre__contenu--1 toolbox">
                        ► <a class="lien_interne" href="{{ route('admissions') }}">Guide des admissions</a><br>
                        ► <a class="lien_interne" href="/calendrier-orientation-et-insertion-professionnelle">Calendrier académique 2026-2027</a><br>
                        ► <a class="lien_interne" href="/alternance">Guide de la formation continue</a>
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
