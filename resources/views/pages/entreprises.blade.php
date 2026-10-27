@extends('layouts.app')

@section('title', 'Relations Entreprises & Partenariats - INSG Gabon')
@section('meta_description', 'L\'INSG Gabon développe des partenariats stratégiques avec les entreprises : stages, recrutement, formation continue sur-mesure et taxe d\'apprentissage.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Entreprises & Partenaires' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Relations Entreprises &amp; Partenariats</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">Partenaire privilégié des acteurs économiques gabonais et internationaux, l'Institut National des Sciences de Gestion développe des liens étroits avec les entreprises pour favoriser l'insertion professionnelle et co-construire les compétences managériales de demain.</p>

                        <h2>Nos partenariats stratégiques de référence</h2>
                        <p>L'INSG collabore activement avec les fleurons du secteur bancaire, pétrolier, minier, logistique et des services au Gabon et dans la sous-région CEMAC :</p>
                        <ul>
                            @forelse($partenaires as $p)
                                <li><strong>{{ $p->name }} :</strong> {{ $p->description ?? 'Partenaire institutionnel de l\'INSG Gabon' }}</li>
                            @empty
                                <li><strong>BGFI Bank :</strong> Partenaire historique de l'institut, soutien à l'insertion professionnelle et aux bourses d'excellence.</li>
                                <li><strong>TotalEnergies Gabon :</strong> Accueil de stagiaires en gestion de projets et contrôle financier.</li>
                                <li><strong>Comilog (Groupe Eramet) :</strong> Coopération en formation des cadres et gestion des approvisionnements.</li>
                                <li><strong>Gabon Telecom :</strong> Stages et insertion dans les filières Informatique de Gestion &amp; SI.</li>
                            @endforelse
                        </ul>
                        <p>Parmi nos partenaires historiques majeurs, <strong>BGFI Bank</strong> et les grandes institutions financières de la sous-région jouent un rôle central dans l'accueil en stage et l'embauche de nos diplômés.</p>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Nos offres pour les entreprises</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <ul>
                                <li><strong>Formation continue sur-mesure :</strong> Montée en compétences de vos managers, cadres comptables et auditeurs internes.</li>
                                <li><strong>Recrutement &amp; Stages :</strong> Diffusion prioritaire de vos offres de stages, d'alternance et d'emplois auprès de nos promotions.</li>
                                <li><strong>Taxe d'apprentissage :</strong> Versement de la taxe pour moderniser nos laboratoires informatiques et soutenir l'innovation pédagogique.</li>
                            </ul>
                            <p>► <a href="/former-ses-collaborateurs" class="lien_interne"><strong>Former vos collaborateurs avec l'INSG</strong></a><br>
                               ► <a href="/recruter-ses-collaborateurs" class="lien_interne"><strong>Déposer une offre de stage ou d'emploi</strong></a><br>
                               ► <a href="/verser-la-taxe-dapprentissage" class="lien_interne"><strong>Verser la taxe d'apprentissage</strong></a></p>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Contact Entreprises</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <p><strong>Pôle Insertion &amp; Relations Entreprises</strong><br>
                        Email : entreprises@insg-gabon.ga<br>
                        Tél : +241 011 76 25 20</p>
                        <p><a href="{{ route('contact') }}" class="button"><span>Nous contacter</span></a></p>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Services Entreprises</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="/former-ses-collaborateurs" class="lien_interne">Formation sur-mesure</a><br>
                        ► <a href="/recruter-ses-collaborateurs" class="lien_interne">Recruter un diplômé</a><br>
                        ► <a href="/marches-publics" class="lien_interne">Marchés Publics</a>
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
