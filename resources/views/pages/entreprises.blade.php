@extends('layouts.app')

@section('title', 'Relations Entreprises & Partenariats - INSG Gabon')
@section('meta_description', 'Partenariats stratégiques de l\'INSG Gabon avec les leaders industriels et financiers : BGFI Bank, CNSS, UGB, TotalEnergies, Airtel. Stages et recrutement.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Entreprises' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>Relations Entreprises &amp; Partenariats</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <p class="chapo">Depuis plus de cinquante ans, l'Institut National des Sciences de Gestion bâtit des ponts solides entre le monde académique et le tissu économique gabonais. Plus de 42 entreprises et institutions partenaires soutiennent nos formations, accueillent nos stagiaires et recrutent nos diplômés.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Key Pillars --}}
                <div class="ligne_2" id="incubateur">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">L'Incubateur des Métiers BGFI-INSG</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <div style="display:flex; gap:2rem; align-items:flex-start; flex-wrap:wrap; margin:1.5rem 0;">
                                        <div style="flex:0 0 200px; text-align:center;">
                                            <img src="{{ asset('assets/images/partners/bgfi.png') }}" alt="Partenaire BGFI Bank" style="width:100%; max-width:180px; object-fit:contain;" />
                                        </div>
                                        <div style="flex:1; min-width:280px;">
                                            <p style="margin-top:0; font-size:1rem; line-height:1.6; color:#333;">Fruit d'une convention majeure avec le groupe bancaire BGFI, l'Incubateur des Métiers accompagne les étudiants porteurs de projets d'entreprises innovantes et soutient les filières d'excellence dans le domaine bancaire, financier et managérial.</p>
                                            <ul style="color:#555; font-size:0.9rem; line-height:1.6;">
                                                <li>Mentorat par des directeurs et experts financiers en exercice</li>
                                                <li>Bourses d'excellence et immersion dans les filiales du groupe</li>
                                                <li>Accompagnement à la création d'entreprises à fort potentiel</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Internships & Careers --}}
                <div class="ligne_3" id="stages">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Stages professionnels &amp; Forum annuel de recrutement</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <p>Chaque année en novembre, le <strong>Forum de l'Emploi et des Stages</strong> réunit sur le campus plus de 30 entreprises leaders et recruteurs du Gabon. C'est l'occasion pour nos étudiants de Licence et Master de passer des entretiens d'embauche et de décrocher leurs stages de fin d'études.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Partners Logos Grid --}}
                <div class="ligne_4">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Nos Partenaires Privilégiés</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:1.5rem; margin:2rem 0; align-items:center;">
                                        @foreach($partenaires as $partenaire)
                                            <div style="background:#ffffff; border:1px solid #e2e4e8; border-radius:6px; padding:1.5rem; text-align:center; box-shadow:0 2px 5px rgba(0,0,0,0.03); min-height:100px; display:flex; align-items:center; justify-content:center;">
                                                <img src="{{ $partenaire->image_url }}" alt="{{ $partenaire->name }}" style="max-height:55px; max-width:140px; object-fit:contain; vertical-align:middle;" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact CTA --}}
                <div style="background: linear-gradient(135deg, var(--uas-couleur-principale, #1f234b) 0%, #151834 100%); color: #fff; padding: 2rem; border-radius: 8px; margin-top: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
                    <div>
                        <h2 style="color: #fff; margin: 0 0 0.5rem 0; font-size: 1.35rem;">Vous représentez une entreprise ?</h2>
                        <p style="color: rgba(255,255,255,0.85); margin: 0; font-size: 0.95rem;">Proposez vos offres de stage, soutenez nos programmes ou développez un partenariat sur-mesure avec l'INSG.</p>
                    </div>
                    <div>
                        <a href="{{ route('contact') }}" class="button" style="background: #fff; color: var(--uas-couleur-principale, #1f234b); font-weight: 700; border: none; padding: 0.75rem 1.5rem;">
                            Proposer un partenariat &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div>
    <div class="separateur"></div>
</main>
@endsection

