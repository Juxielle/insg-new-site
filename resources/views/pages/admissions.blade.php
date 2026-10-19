@extends('layouts.app')

@section('title', 'Admissions & Inscriptions 2026-2027 - INSG Gabon')
@section('meta_description', 'Modalités d\'admission, concours d\'entrée et inscriptions pour les cycles BTS, Licence et Master Professionnel de l\'INSG Gabon à Libreville.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Admissions' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>Admissions &amp; Inscriptions 2026-2027</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <p class="chapo">L'admission à l'Institut National des Sciences de Gestion est sélective afin de garantir l'excellence de nos promotions et l'adéquation avec les besoins des entreprises. Découvrez les conditions d'accès selon votre profil académique.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Admission Paths Grid --}}
                <div class="ligne_2">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Modalités d'accès par cycle d'études</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(290px, 1fr)); gap: 1.5rem; margin: 1.5rem 0;">
                                        
                                        <div style="background: #ffffff; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.5rem; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                            <span style="display: inline-block; background: var(--uas-couleur-accent, #0091B5); color: #fff; font-size: 0.75rem; font-weight: 700; padding: 3px 8px; border-radius: 3px; text-transform: uppercase; margin-bottom: 0.75rem;">
                                                Bac + 2
                                            </span>
                                            <h3 style="margin: 0 0 0.5rem 0; color: var(--uas-couleur-principale, #1f234b);">Cycle BTS</h3>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;"><strong>Public visé :</strong> Titulaires du Baccalauréat (Séries B, C, D, CG, ACA ou équivalent homologué).</p>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;"><strong>Modalité :</strong> Concours national d'entrée comprenant des épreuves de culture générale, mathématiques financières et français.</p>
                                        </div>

                                        <div style="background: #ffffff; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.5rem; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                            <span style="display: inline-block; background: var(--uas-couleur-principale, #1f234b); color: #fff; font-size: 0.75rem; font-weight: 700; padding: 3px 8px; border-radius: 3px; text-transform: uppercase; margin-bottom: 0.75rem;">
                                                Bac + 3
                                            </span>
                                            <h3 style="margin: 0 0 0.5rem 0; color: var(--uas-couleur-principale, #1f234b);">Licence Professionnelle</h3>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;"><strong>Public visé :</strong> Titulaires d'un BTS, DUT ou DEUG (120 crédits ECTS validés) dans le domaine de la gestion ou de l'économie.</p>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;"><strong>Modalité :</strong> Examen rigoureux du dossier académique et test d'admissibilité écrit et oral devant un jury de professeurs.</p>
                                        </div>

                                        <div style="background: #ffffff; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.5rem; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                            <span style="display: inline-block; background: #6c5ce7; color: #fff; font-size: 0.75rem; font-weight: 700; padding: 3px 8px; border-radius: 3px; text-transform: uppercase; margin-bottom: 0.75rem;">
                                                Bac + 5
                                            </span>
                                            <h3 style="margin: 0 0 0.5rem 0; color: var(--uas-couleur-principale, #1f234b);">Master Spécialisé</h3>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;"><strong>Public visé :</strong> Titulaires d'une Licence Professionnelle ou d'un diplôme de niveau Bac+3 en sciences économiques, gestion, finance ou droit.</p>
                                            <p style="font-size: 0.9rem; color: #555; line-height: 1.5;"><strong>Modalité :</strong> Sélection sur dossier d'excellence et entretien de motivation professionnelle.</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Application Files Checklist --}}
                <div class="ligne_3">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Composition du dossier de candidature</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <ul style="line-height: 1.8; color: #444; font-size: 0.95rem;">
                                        <li>Une demande manuscrite adressée à Madame la Directrice Générale de l'INSG.</li>
                                        <li>Une copie certifiée conforme de l'attestation du Baccalauréat et des diplômes antérieurs.</li>
                                        <li>Les relevés de notes des deux dernières années d'études.</li>
                                        <li>Une copie certifiée conforme de l'acte de naissance ou de la carte nationale d'identité.</li>
                                        <li>Quatre (04) photos d'identité couleur récentes et conformes.</li>
                                        <li>Un curriculum vitae actualisé et une lettre de motivation (pour les cycles Licence et Master).</li>
                                        <li>Le reçu de paiement des frais de dossier de candidature (25 000 FCFA non remboursables).</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CTA Box --}}
                <div style="background: #f7f8fa; border: 1px solid #e2e4e8; border-radius: 6px; padding: 2rem; margin-top: 2rem; text-align: center;">
                    <h3 style="margin-top: 0; color: var(--uas-couleur-principale, #1f234b); font-size: 1.25rem;">Des questions sur votre inscription ?</h3>
                    <p style="color: #666; font-size: 0.95rem; max-width: 600px; margin: 0.5rem auto 1.5rem auto;">Le service de la scolarité et de l'orientation est à votre disposition pour vous assister dans la constitution de votre dossier.</p>
                    <a href="{{ route('contact') }}" class="button" style="display: inline-block;">Contacter le service des admissions</a>
                </div>

            </div>
        </div>

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div>
    <div class="separateur"></div>
</main>
@endsection

