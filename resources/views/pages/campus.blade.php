@extends('layouts.app')

@section('title', 'Le Campus INSG Libreville - Infrastructures & Vie de Campus')
@section('meta_description', 'Découvrez le campus de l\'INSG Gabon à Libreville : amphithéâtres modernes, bibliothèque universitaire, laboratoires informatiques et cadre de travail stimulant.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Campus Libreville' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Le Campus INSG Libreville</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">Situé au cœur de la capitale gabonaise sur le <strong>Boulevard Triomphal</strong> Omar BONGO, le campus de l'Institut National des Sciences de Gestion offre à ses 3 200 étudiants un environnement d'études exceptionnel, alliant modernité des équipements et convivialité des espaces de vie.</p>
                        
                        <figure class="photo" style="margin: 1.5em 0;">
                            <img src="{{ asset('assets/images/insg-back-11.jpeg') }}" alt="Campus INSG Libreville" />
                            <figcaption class="legende">Le campus universitaire de l'INSG &ndash; Boulevard Triomphal, Libreville</figcaption>
                        </figure>

                        <h2>Des infrastructures modernes dédiées à l'apprentissage</h2>
                        <p>Le campus regroupe l'ensemble des installations nécessaires à la formation supérieure en management, à la recherche et à la vie étudiante :</p>
                        <ul>
                            @forelse($infrastructures as $infra)
                                <li>
                                    <strong>{{ $infra->name }} :</strong> {{ $infra->description }}
                                    @if($infra->capacity) <em>(Capacité : {{ $infra->capacity }})</em> @endif
                                </li>
                            @empty
                                <li><strong>Amphithéâtres connectés :</strong> Équipés de vidéoprojecteurs interactifs et de sonorisation pour les cours magistraux et colloques.</li>
                                <li><strong>Salles de travaux dirigés :</strong> Espaces modulaires favorisant les études de cas pratiques et le travail en équipe.</li>
                                <li><strong>Laboratoires informatiques :</strong> Plus de 150 postes connectés à l'Internet haut débit avec logiciels professionnels de gestion (Sage, Sphinx, etc.).</li>
                                <li><strong>Bibliothèque universitaire :</strong> Fonds documentaire de référence en sciences économiques, de gestion et droit des affaires.</li>
                            @endforelse
                        </ul>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Accès &amp; Vie pratique</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <p>Idéalement desservi par les transports urbains, le campus de l'INSG est au cœur du quartier des affaires et des institutions de Libreville :</p>
                            <ul>
                                <li><strong>Transports :</strong> Lignes de bus et taxis collectifs desservant l'axe Boulevard Triomphal.</li>
                                <li><strong>Restauration :</strong> Restaurant universitaire et cafétéria proposant des repas complets et équilibrés.</li>
                                <li><strong>Santé &amp; Social :</strong> Infirmerie universitaire assurant les premiers soins et la prévention médicale.</li>
                            </ul>
                            <p>► <a href="{{ route('vie-associative') }}" class="lien_interne"><strong>Découvrir les clubs et la vie associative</strong></a><br>
                               ► <a href="/transports" class="lien_interne"><strong>Plans d'accès et transports</strong></a><br>
                               ► <a href="/bibliotheques-universitaires-3" class="lien_interne"><strong>Bibliothèque et ressources documentaires</strong></a></p>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Informations pratiques</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <p><strong>Campus Principal :</strong><br>
                        Boulevard Triomphal Omar BONGO<br>
                        BP 403 Libreville, Gabon</p>
                        <p><strong>Horaires d'ouverture :</strong><br>
                        Du lundi au vendredi : 07h30 &ndash; 18h30<br>
                        Samedi : 08h00 &ndash; 13h00</p>
                        <p><a href="{{ route('contact') }}" class="button"><span>Nous contacter</span></a></p>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Services aux étudiants</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('vie-associative') }}" class="lien_interne">Vie associative &amp; BDE</a><br>
                        ► <a href="/sport-1" class="lien_interne">Activités sportives</a><br>
                        ► <a href="/restauration" class="lien_interne">Restauration sur le campus</a><br>
                        ► <a href="/logement" class="lien_interne">Guide du logement étudiant</a>
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
