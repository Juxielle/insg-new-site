@extends('layouts.app')

@section('title', 'Admissions & Inscriptions 2026-2027 - INSG Gabon')
@section('meta_description', 'Modalités d\'admission, concours d\'entrée et inscriptions pour les cycles BTS, Licence et Master Professionnel de l\'INSG Gabon à Libreville.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Admissions' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Admissions &amp; Inscriptions 2026-2027</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">L'admission à l'Institut National des Sciences de Gestion est sélective afin de garantir l'excellence de nos promotions et l'adéquation avec les besoins des entreprises. Découvrez les conditions d'accès selon votre profil académique.</p>

                        <h2>Modalités d'accès par cycle d'études</h2>

                        <h3>Cycle BTS (Bac+2)</h3>
                        <p><strong>Public visé :</strong> Titulaires du Baccalauréat (Séries B, C, D, CG, ACA ou équivalent homologué).<br>
                        <strong>Modalité de recrutement :</strong> Concours national d'entrée comprenant des épreuves écrites de culture générale, de mathématiques financières et de français/anglais.</p>

                        <h3>Licence Professionnelle (Bac+3)</h3>
                        <p><strong>Public visé :</strong> Titulaires d'un BTS, DUT ou DEUG (120 crédits ECTS validés) en sciences de gestion, économie ou finance.<br>
                        <strong>Modalité de recrutement :</strong> Examen rigoureux du dossier académique par la commission pédagogique et test d'admissibilité oral.</p>

                        <h3>Master Professionnel &amp; MBA (Bac+5)</h3>
                        <p><strong>Public visé :</strong> Titulaires d'une Licence Professionnelle ou d'un diplôme de niveau Bac+3 équivalent en gestion, finance ou économie.<br>
                        <strong>Modalité de recrutement :</strong> Sélection sur dossier d'excellence et entretien de motivation professionnelle devant un jury d'enseignants-chercheurs et de dirigeants d'entreprises.</p>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Les étapes de la candidature à l'INSG Gabon</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <dl aria-label="Accordéons" class="ckeditor-accordion">
                                <dt>1. Dépôt du dossier de candidature</dt>
                                <dd>
                                    <p>Les candidats doivent constituer leur dossier comportant :</p>
                                    <ul>
                                        <li>Fiche de candidature dument remplie et signée</li>
                                        <li>Copies légalisées des diplômes et relevés de notes du baccalauréat et des années universitaires antérieures</li>
                                        <li>Copie d'acte de naissance ou pièce d'identité nationale certifiée</li>
                                        <li>Curriculum Vitae et lettre de motivation pour les cycles Licence et Master</li>
                                    </ul>
                                </dd>

                                <dt>2. Épreuves de sélection &amp; Commission pédagogique</dt>
                                <dd>
                                    <p>Les candidats au cycle BTS sont convoqués aux épreuves écrites du concours. Pour les cycles Licence 3 et Master, les dossiers sont instruits par la commission pédagogique, suivis d'entretiens de sélection.</p>
                                </dd>

                                <dt>3. Inscription administrative définitive</dt>
                                <dd>
                                    <p>Dès publication officielle de la liste des admis, les étudiants disposent d'un délai de 15 jours pour procéder au règlement des droits d'inscription et retirer leur carte d'étudiant.</p>
                                </dd>
                            </dl>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Candidatures 2026-2027</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <p>Les candidatures sont officiellement ouvertes pour la rentrée académique.</p>
                        <p><a href="{{ route('contact') }}" class="button"><span>Nous contacter</span></a></p>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">À consulter</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        ► <a href="{{ route('formations.index') }}" class="lien_interne">Toutes les offres de formations</a><br>
                        ► <a href="/calendrier-orientation-et-insertion-professionnelle" class="lien_interne">Calendrier des concours</a><br>
                        ► <a href="/alternance" class="lien_interne">Formation continue &amp; Alternance</a>
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
