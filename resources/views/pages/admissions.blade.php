@extends('layouts.app')

@section('title', 'Admissions | INSG Gabon')
@section('meta_description', 'Conditions, procédures et formulaire de pré-inscription à l\'INSG.')
@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Admissions' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Admissions &amp; Inscriptions 2026-2027</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
<p class="chapo">Toutes les informations utiles pour préparer votre candidature et rejoindre l'INSG.</p><h2>Comment rejoindre l’INSG ?</h2><p>L’admission est organisée selon un parcours transparent, de la préparation du dossier à la confirmation définitive.</p><ul><li><strong>Choisir sa formation :</strong> Consultez les parcours et vérifiez les conditions d’accès.</li><li><strong>Préparer le dossier :</strong> Rassemblez les pièces académiques et administratives demandées.</li><li><strong>Déposer la candidature :</strong> Complétez le formulaire et transmettez des documents lisibles.</li></ul><h3>Premier cycle</h3><p>Consultez les parcours accessibles selon votre série de baccalauréat et vérifiez les conditions d’accès auprès du service des admissions.</p><h3>Candidature en Master</h3><p>Préparez votre candidature à l'une des spécialités de Master de l'INSG. L'admission est fondée sur l'analyse de votre dossier.</p>
</div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Les étapes de la candidature à l'INSG Gabon</h2>
                        <div class="paragraphe__contenu--4 toolbox">
<p>La commission évalue la cohérence du parcours, les résultats académiques, la motivation et le projet professionnel.</p><dl aria-label="Accordéons" class="ckeditor-accordion"><dt>1. Dépôt</dt><dd><p>Préparez vos diplômes, relevés, CV, lettre de motivation et pièce d’identité. Contactez le service des admissions pour connaître les modalités de dépôt.</p></dd><dt>2. Vérification</dt><dd><p>Le service des admissions contrôle la conformité du dossier.</p></dd><dt>3. Décision</dt><dd><p>La décision et les modalités d’inscription sont communiquées par email.</p></dd></dl>
</div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Candidatures 2026-2027</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <p>Consultez les avis officiels de l’Institut pour connaître les dates et modalités de candidature.</p>
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
