@extends('layouts.app')

@section('title', 'Nos formations | INSG Gabon')
@section('meta_description', 'Découvrez les Licences, Masters et parcours professionnels proposés par l\'INSG.')
@section('content')
<main id="page" class="insg-formations-page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Formations' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Nos Formations d'Excellence</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
<p class="chapo">L’INSG déploie une offre structurée autour de la formation initiale et de la formation continue. Ces deux voies associent excellence académique, professionnalisation et adaptation aux besoins des organisations.</p>
</div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                @php($initialGroups = collect(\App\Support\InitialFormationCatalogue::data()['groups']))
                <div class="ligne_2">
                    @foreach(['Gestion Appliquée (GA)', 'Marketing et Affaires Internationales (MAI)'] as $department)
                    <div class="colonne_{{ $loop->iteration }}">
                        <div class="colonne_deco"><div class="paragraphe--4">
                            <h2 class="paragraphe__titre--4">Département {{ $department }}</h2>
                            <div class="paragraphe__contenu--4 toolbox">
                                <p class="chapo">Formation initiale</p>
                                @foreach($initialGroups->where('department', $department) as $group)
                                    <h3>{{ $group['label'] }}</h3>
                                    <ul>
                                        @foreach($group['courses'] as $course)
                                            <li><a class="lien_interne" href="{{ route('formations.show', $course['slug']) }}">{{ $course['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
                        </div></div>
                    </div>
                    @endforeach
                </div>

                <div class="ligne_3"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Master Recherche et partenariats</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <h3>Formation initiale — Master Recherche</h3>
                            @foreach($initialGroups->where('department', '') as $group)
                                @foreach($group['courses'] as $course)
                                    <p><a class="lien_interne" href="{{ route('formations.show', $course['slug']) }}">{{ $course['title'] }}</a>, en partenariat avec l’Université Omar Bongo (UOB).</p>
                                @endforeach
                            @endforeach
                            <p>La Licence Gestion Économie Mines et Pétrole (GEMP) résulte d’un partenariat académique et financier avec l’Université des Sciences et Techniques de Masuku (USTM) et l’Agence Nationale des Bourses et Stages (ANBG).</p>
                            <p>La Licence GEMP et la Licence Informatique de Gestion sont notamment accessibles aux titulaires d’un baccalauréat scientifique.</p>
                        </div>
                    </div></div>
                </div><div class="colonne_2">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Formation continue</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            @foreach(collect(json_decode(file_get_contents(resource_path('content/insg-source.json')), true)['catalogue'])->where('mode', 'Formation continue') as $group)
                                <h3>{{ $group['level'] }}</h3>
                                <ul>
                                    @foreach($group['courses'] as $course)
                                        <li>{{ $course }}</li>
                                    @endforeach
                                </ul>
                            @endforeach
                            <p><a class="lien_interne" href="/alternance">En savoir plus sur la formation continue</a></p>
                        </div>
                    </div></div>
                </div></div>

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--4">
                    <h2 class="encadre__titre--4">&#192; télécharger</h2>
                    <div class="encadre_contenu encadre__contenu--4 toolbox">
                        ► <a class="lien_interne" href="{{ route('admissions') }}">Guide des admissions</a><br>
                        ► <a class="lien_interne" href="/calendrier-orientation-et-insertion-professionnelle">Calendrier académique 2026-2027</a><br>
                        ► <a class="lien_interne" href="/alternance">Guide de la formation continue</a>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Formation initiale en chiffres</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <ul>
                            <li><strong>2</strong> départements en formation initiale</li>
                            <li><strong>5</strong> filières de BTS</li>
                            <li><strong>6</strong> Licences professionnelles classiques</li>
                            <li><strong>6</strong> Licences professionnelles double compétence</li>
                            <li><strong>3</strong> parcours de Licence fondamentale</li>
                            <li><strong>5</strong> Masters professionnels</li>
                            <li><strong>1</strong> Master Recherche en partenariat avec l’UOB</li>
                        </ul>
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
