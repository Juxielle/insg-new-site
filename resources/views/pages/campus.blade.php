@extends('layouts.app')

@section('title', 'Le Campus INSG Libreville - Infrastructures & Vie de Campus')
@section('meta_description', 'Découvrez le campus de l\'INSG Gabon à Libreville : amphithéâtres modernes, bibliothèque universitaire, laboratoires informatiques et cadre de travail stimulant.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Campus Libreville' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>Le Campus INSG Libreville</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <p class="chapo">Situé au cœur de la capitale gabonaise, le campus de l'Institut National des Sciences de Gestion offre à ses 3 200 étudiants un environnement d'études exceptionnel, alliant modernité des équipements et convivialité des espaces de vie.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Campus Facilities Grid --}}
                <div class="ligne_2">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Des infrastructures modernes dédiées à l'apprentissage</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin: 1.5rem 0;">
                                        @forelse($infrastructures as $infra)
                                            <div style="background: #ffffff; border: 1px solid #e2e4e8; border-radius: 6px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.04); display: flex; flex-direction: column;">
                                                <img src="{{ $infra->image_url }}" alt="{{ $infra->name }}" style="width: 100%; height: 180px; object-fit: cover;" />
                                                <div style="padding: 1.25rem; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                                                    <div>
                                                        @if($infra->category)
                                                            <span style="font-size: 0.75rem; font-weight: 700; color: var(--uas-couleur-accent, #0091B5); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.25rem;">{{ $infra->category }}</span>
                                                        @endif
                                                        <h3 style="margin: 0 0 0.5rem 0; color: var(--uas-couleur-principale, #1f234b);">{{ $infra->name }}</h3>
                                                        <p style="margin: 0; font-size: 0.9rem; color: #555; line-height: 1.5;">{{ $infra->description }}</p>
                                                    </div>
                                                    @if($infra->capacity)
                                                        <div style="margin-top: 1rem; padding-top: 0.75rem; border-top: 1px solid #f0f0f0; font-size: 0.82rem; color: #777;">
                                                            <strong>Capacité :</strong> {{ $infra->capacity }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @empty
                                            <div style="background: #ffffff; border: 1px solid #e2e4e8; border-radius: 6px; overflow: hidden;">
                                                <img src="{{ asset('assets/images/insg-back-4.jpeg') }}" alt="Amphithéâtres INSG" style="width: 100%; height: 180px; object-fit: cover;" />
                                                <div style="padding: 1.25rem;">
                                                    <h3 style="margin: 0 0 0.5rem 0; color: var(--uas-couleur-principale, #1f234b);">Amphithéâtres connectés</h3>
                                                    <p style="margin: 0; font-size: 0.9rem; color: #555;">Des amphithéâtres équipés de systèmes audiovisuels de pointe.</p>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Campus Life & Location --}}
                <div class="ligne_3">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <h2 class="paragraphe__titre--4">Situation géographique &amp; Accès</h2>
                                <div class="paragraphe__contenu--4 toolbox">
                                    <div style="display: flex; gap: 2rem; align-items: flex-start; flex-wrap: wrap;">
                                        <div style="flex: 1 1 340px;">
                                            <p>Le campus de l'INSG est idéalement situé sur le <strong>Boulevard Triomphal Omar Bongo</strong> à Libreville, à proximité immédiate des principales institutions publiques, des banques et des sièges sociaux des grandes entreprises partenaires.</p>
                                            <ul style="line-height: 1.8; color: #444; font-size: 0.95rem;">
                                                <li><strong>Adresse :</strong> Boulevard Triomphal, BP 2368, Libreville, Gabon</li>
                                                <li><strong>Horaires d'ouverture :</strong> Lundi – Vendredi : 07h30 – 18h00 / Samedi : 08h00 – 13h00</li>
                                                <li><strong>Téléphone :</strong> +241 (0)11 76 20 40</li>
                                                <li><strong>Email :</strong> contact@insg-gabon.ga</li>
                                            </ul>
                                            <p>
                                                <a href="{{ route('contact') }}" class="button" style="display: inline-block;">Nous contacter / Prendre rendez-vous</a>
                                            </p>
                                        </div>
                                        <div style="flex: 1 1 300px;">
                                            <div style="background: #f7f8fa; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.5rem; text-align: center;">
                                                <span class="icon icon-location" style="font-size: 2.5rem; color: var(--uas-couleur-principale, #1f234b); display: block; margin-bottom: 0.5rem;"></span>
                                                <h3 style="margin-top: 0; color: var(--uas-couleur-principale, #1f234b);">Accès &amp; Transports</h3>
                                                <p style="font-size: 0.9rem; color: #555; margin: 0;">Le campus est facilement accessible en transport en commun (taxis et bus urbains) avec des arrêts dédiés juste en face de l'entrée principale.</p>
                                            </div>
                                        </div>
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

