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

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <p class="chapo"><strong>Fondé en 1973 à Libreville</strong>, l'<strong>Institut National des Sciences de Gestion (INSG)</strong> est l'établissement public d'enseignement supérieur de référence au Gabon et dans la sous-région CEMAC. Fort de plus de 50 années d'excellence académique, l'INSG forme les cadres, gestionnaires, auditeurs et dirigeants qui pilotent l'économie et les entreprises gabonaises.</p>
                                    <p>L'Institut National des Sciences de Gestion conjugue la rigueur scientifique de l'institut public avec le professionnalisme des grandes écoles de management. Il propose des formations professionnalisantes du Bac+2 (BTS) au Master Professionnel (Bac+5), en formation initiale comme en formation continue, au sein de ses filières spécialisées en <strong>Finance, Comptabilité, Marketing, Ressources Humaines, Management, Banque, Audit et Informatique de Gestion</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Speech of Director General --}}
                <div class="ligne_2" id="mot-directeur">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Une Direction engagée pour la réussite</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <div style="display:flex; gap:2.5rem; align-items:flex-start; flex-wrap:wrap; margin:1.5rem 0;">
                                        <div style="flex:0 0 190px; text-align:center;">
                                            <img src="{{ $director->photo_url ?? asset('assets/images/directeur-1.png') }}" alt="{{ $director->name ?? 'Directrice Générale de l\'INSG' }}" style="width:100%; max-width:180px; border-radius:4px; box-shadow:0 2px 6px rgba(0,0,0,0.15);" />
                                            <p style="margin-top:0.5rem; margin-bottom:0.2rem; font-weight:700; color:#1e1213; font-size:0.95rem;">{{ $director->name ?? 'Pr. Murielle Natacha M\'BOUNA' }}</p>
                                            <span style="font-size:0.85rem; color:#666;">{{ $director->role ?? 'Directeur Général de l\'INSG' }}</span>
                                        </div>
                                        <div style="flex:1; min-width:260px;">
                                            <p style="font-style:italic; color:#333; font-size:1.05rem; line-height:1.6; margin-top:0;">« {{ $director->quote ?? 'Depuis sa création, l\'Institut National des Sciences de Gestion s\'est imposé comme une référence dans la formation des cadres gabonais. Notre ambition associe rigueur académique, ouverture internationale et proximité avec le monde socio-économique pour faire de chaque étudiant un acteur compétitif du développement.' }} »</p>
                                            <p>► <a href="{{ route('formations.index') }}" class="lien_interne"><strong>Découvrir toutes les offres de formations de l'INSG</strong></a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Campus Libreville --}}
                <div class="ligne_3">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Un cadre d'études moderne au cœur de Libreville</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <p>Implanté sur le <strong>Boulevard Triomphal</strong> au cœur de Libreville, le campus de l'INSG offre un environnement d'apprentissage privilégié et sécurisé. Il dispose d'amphithéâtres modernes, de salles de cours multimédias climatisées, d'une bibliothèque connectée et d'espaces de travail collaboratif adaptés aux exigences de l'enseignement supérieur contemporain.</p>
                                    <p>► <a class="lien_interne" href="{{ route('campus') }}"><strong>Visiter notre campus et nos infrastructures</strong></a></p>
                                    <div style="text-align:left; margin:1.5rem 0; display:flex; gap:12px; flex-wrap:wrap;">
                                        <img src="{{ asset('assets/images/insg-back-6.jpeg') }}" alt="Campus INSG Libreville" style="max-height:200px; border-radius:3px; object-fit:cover; box-shadow:0 2px 6px rgba(0,0,0,0.12);" />
                                        <img src="{{ asset('assets/images/insg-back-3.jpeg') }}" alt="Bibliothèque INSG" style="max-height:200px; border-radius:3px; object-fit:cover; box-shadow:0 2px 6px rgba(0,0,0,0.12);" />
                                        <img src="{{ asset('assets/images/insg-back-11.jpeg') }}" alt="Étudiants INSG" style="max-height:200px; border-radius:3px; object-fit:cover; box-shadow:0 2px 6px rgba(0,0,0,0.12);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Key Figures --}}
                <div class="ligne_4" id="chiffres-cles">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">L'INSG en chiffres clés</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <ul>
                                        @if(isset($statistiques) && $statistiques->isNotEmpty())
                                            @foreach($statistiques as $st)
                                                <li><strong>{{ $st->value }} {{ $st->label }}</strong> {{ $st->description ? '– ' . $st->description : '' }}</li>
                                            @endforeach
                                        @else
                                            <li><strong>3 200+ étudiants</strong> formés chaque année au sein de nos différents cycles académiques.</li>
                                            <li><strong>140+ enseignants et experts professionnels</strong> issus du monde académique, bancaire et entrepreneurial.</li>
                                            <li><strong>8 filières d'excellence</strong> en BTS, Licence et Master professionnel.</li>
                                            <li><strong>92 % de taux d'insertion professionnelle</strong> pour nos diplômés dans les 12 mois suivant l'obtention du diplôme.</li>
                                            <li><strong>42 entreprises et institutions partenaires</strong> engagées aux côtés de l'INSG.</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Governance / Organigramme --}}
                <div class="ligne_5" id="organigramme">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Gouvernance et Organisation</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <p>L'INSG Gabon est administré par un Conseil d'Administration et dirigé par une Direction Générale assistée de directions collégiales :</p>
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.25rem; margin: 1.5rem 0;">
                                        @if(isset($gouvernances) && $gouvernances->isNotEmpty())
                                            @foreach($gouvernances as $gov)
                                                <div style="background: #f7f8fa; padding: 1.25rem; border-left: 4px solid var(--uas-couleur-principale, #1f234b); border-radius: 4px;">
                                                    <h3 style="margin-top: 0; font-size: 1.05rem; color: var(--uas-couleur-principale, #1f234b);">{{ $gov->division ?? $gov->role }}</h3>
                                                    <strong style="display:block; margin-bottom:0.35rem; color:#1e1213; font-size:0.95rem;">{{ $gov->name }}</strong>
                                                    <p style="margin: 0; font-size: 0.9rem; color: #555;">{{ $gov->bio ?? $gov->role }}</p>
                                                </div>
                                            @endforeach
                                        @else
                                            <div style="background: #f7f8fa; padding: 1.25rem; border-left: 4px solid var(--uas-couleur-principale, #1f234b); border-radius: 4px;">
                                                <h3 style="margin-top: 0; font-size: 1.05rem; color: var(--uas-couleur-principale, #1f234b);">Direction Générale</h3>
                                                <p style="margin: 0; font-size: 0.9rem; color: #555;">Supervision générale, prospective stratégique, relations ministérielles et partenariats internationaux.</p>
                                            </div>
                                            <div style="background: #f7f8fa; padding: 1.25rem; border-left: 4px solid var(--uas-couleur-accent, #0091B5); border-radius: 4px;">
                                                <h3 style="margin-top: 0; font-size: 1.05rem; color: var(--uas-couleur-accent, #0091B5);">Direction des Affaires Académiques</h3>
                                                <p style="margin: 0; font-size: 0.9rem; color: #555;">Coordination pédagogique, gestion des examens, encadrement des corps professoraux et stages.</p>
                                            </div>
                                            <div style="background: #f7f8fa; padding: 1.25rem; border-left: 4px solid #1f234b; border-radius: 4px;">
                                                <h3 style="margin-top: 0; font-size: 1.05rem; color: #1f234b);">Secrétariat Général</h3>
                                                <p style="margin: 0; font-size: 0.9rem; color: #555;">Ressources humaines, gestion financière, logistique, sécurité et entretien des infrastructures du campus.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
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

