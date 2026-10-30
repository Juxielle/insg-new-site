@extends('layouts.app')

@section('title', 'Partenaires et entreprises | INSG')
@section('meta_description', 'Découvrez les partenaires et opportunités professionnelles de l\'INSG.')
@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Entreprises & Partenaires' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Relations Entreprises &amp; Partenariats</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
<p class="chapo">Entreprises, institutions et diplômés : construisons ensemble les compétences dont le Gabon a besoin.</p><h2>Un réseau engagé aux côtés de l’INSG</h2><ul><li><strong>Banque et finance :</strong> UGB, BGFI, FINAM, BICIG, La Régionale d’Épargne et de Crédit du Gabon, Olsen Courtage, Luxo Finance.</li><li><strong>Audit et conseil :</strong> KPMG, Deloitte, Ernst &amp; Young, IMPROM, AC Consulting, K.T.A., Cabinet Ramses, Salmane International Trade, Cabinet Fidicia, Metodik Audit &amp; Conseils, 2AD Consulting.</li><li><strong>Industrie et services :</strong> SOGAFRIC / SODIM TP / GESPARC, Bernabé Gabon, EDG SA, CAISTAB, SEEG, PERENCO, LABOREX, Vocal Centre.</li><li><strong>Transport et logistique :</strong> SETRAG, BM-Transit, DHL, ASECNA, OCT Owendo, Gabon Port Management, AVS International, Soma Trans International.</li><li><strong>Institutions publiques :</strong> Conseil Gabonais des Chargeurs, Ministère de la Santé, DGCPT, Ministère des Comptes publics.</li></ul>
</div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Nos offres pour les entreprises</h2>
                        <div class="paragraphe__contenu--4 toolbox">
<p>Les partenariats rapprochent la formation des besoins réels des organisations.</p><ul><li><strong>Recruter nos talents :</strong> Diffusez vos offres de stage, d’alternance et d’emploi auprès de profils formés à l’excellence.</li><li><strong>Projets &amp; Conférences :</strong> Animez des masterclasses, proposez des études de cas réels et participez aux jurys de soutenance.</li><li><strong>Taxe d’apprentissage &amp; Soutien :</strong> Investissez dans les équipements pédagogiques et soutenez les chaires de formation professionnelle.</li></ul><p>► <a href="/contact" class="lien_interne">Échanger sur un partenariat avec l’INSG</a></p>
</div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Contact Entreprises</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <p><strong>Pôle Insertion &amp; Relations Entreprises</strong><br>
                        Email : contact@insg-gabon.ga<br>
                        Tél : +241 01 23 45 67</p>
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
