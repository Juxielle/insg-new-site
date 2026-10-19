@extends('layouts.app')

@section('title', 'Contactez l\'Administration de l\'INSG Gabon - Libreville')
@section('meta_description', 'Formulaire de contact et coordonnées de l\'Institut National des Sciences de Gestion : scolarité, inscriptions, relations entreprises, campus.')

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Contact' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>Contactez l'INSG Gabon</h1>

                <div class="ligne_1">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--0">
                                <div class="paragraphe__contenu--0 toolbox">
                                    <p class="chapo">Une question sur nos filières, les procédures de concours, les bourses d'études ou un partenariat d'entreprise ? Transmettez-nous votre message via le formulaire ci-dessous ou contactez directement nos services administratifs.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact form and details layout --}}
                <div class="ligne_2">
                    <div class="colonne_1">
                        <div class="colonne_deco">
                            <div class="paragraphe--4">
                                <div class="paragraphe__contenu--4 toolbox">
                                    
                                    <div style="display: flex; gap: 2.5rem; align-items: flex-start; flex-wrap: wrap; margin: 1.5rem 0;">
                                        
                                        {{-- Form Column --}}
                                        <div style="flex: 1 1 480px; background: #ffffff; border: 1px solid #e2e4e8; border-radius: 6px; padding: 2rem; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
                                            <h2 style="margin-top: 0; color: var(--uas-couleur-principale, #1f234b); font-size: 1.3rem;">
                                                Envoyer un message
                                            </h2>

                                            @if($errors->any())
                                                <div style="background: #ffebee; border-left: 4px solid #c62828; padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
                                                    <p style="margin: 0 0 0.5rem 0; font-weight: 700; color: #c62828;">Veuillez corriger les erreurs suivantes :</p>
                                                    <ul style="margin: 0; padding-left: 1.25rem; color: #c62828; font-size: 0.9rem;">
                                                        @foreach($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <form action="{{ route('contact.store') }}" method="POST">
                                                @csrf

                                                <div style="margin-bottom: 1.25rem;">
                                                    <label for="name" style="display: block; font-weight: 600; margin-bottom: 0.35rem; font-size: 0.9rem; color: #333;">
                                                        Nom complet <span style="color: #c62828;">*</span>
                                                    </label>
                                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 0.65rem 0.8rem; border: 1px solid {{ $errors->has('name') ? '#c62828' : '#ccc' }}; border-radius: 4px; font-size: 0.95rem;" placeholder="Ex: Jean-Marc ONDO" />
                                                </div>

                                                <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 1.25rem;">
                                                    <div style="flex: 1 1 200px;">
                                                        <label for="email" style="display: block; font-weight: 600; margin-bottom: 0.35rem; font-size: 0.9rem; color: #333;">
                                                            Adresse email <span style="color: #c62828;">*</span>
                                                        </label>
                                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width: 100%; padding: 0.65rem 0.8rem; border: 1px solid {{ $errors->has('email') ? '#c62828' : '#ccc' }}; border-radius: 4px; font-size: 0.95rem;" placeholder="exemple@domaine.com" />
                                                    </div>
                                                    <div style="flex: 1 1 200px;">
                                                        <label for="phone" style="display: block; font-weight: 600; margin-bottom: 0.35rem; font-size: 0.9rem; color: #333;">
                                                            Téléphone (facultatif)
                                                        </label>
                                                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" style="width: 100%; padding: 0.65rem 0.8rem; border: 1px solid #ccc; border-radius: 4px; font-size: 0.95rem;" placeholder="+241 077 00 00 00" />
                                                    </div>
                                                </div>

                                                <div style="margin-bottom: 1.25rem;">
                                                    <label for="subject" style="display: block; font-weight: 600; margin-bottom: 0.35rem; font-size: 0.9rem; color: #333;">
                                                        Objet de votre demande <span style="color: #c62828;">*</span>
                                                    </label>
                                                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required style="width: 100%; padding: 0.65rem 0.8rem; border: 1px solid {{ $errors->has('subject') ? '#c62828' : '#ccc' }}; border-radius: 4px; font-size: 0.95rem;" placeholder="Ex: Renseignements admission Licence Finance" />
                                                </div>

                                                <div style="margin-bottom: 1.5rem;">
                                                    <label for="message" style="display: block; font-weight: 600; margin-bottom: 0.35rem; font-size: 0.9rem; color: #333;">
                                                        Votre message <span style="color: #c62828;">*</span>
                                                    </label>
                                                    <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 0.65rem 0.8rem; border: 1px solid {{ $errors->has('message') ? '#c62828' : '#ccc' }}; border-radius: 4px; font-size: 0.95rem; line-height: 1.5;" placeholder="Détaillez votre question...">{{ old('message') }}</textarea>
                                                </div>

                                                <div>
                                                    <button type="submit" class="button" style="background: var(--uas-couleur-principale, #1f234b); color: #fff; padding: 0.75rem 2rem; border: none; border-radius: 4px; font-size: 1rem; font-weight: 700; cursor: pointer;">
                                                        Envoyer le message &rarr;
                                                    </button>
                                                </div>
                                            </form>
                                        </div>

                                        {{-- Sidebar Info Column --}}
                                        <div style="flex: 0 0 320px; max-width: 100%;">
                                            <div style="background: #f7f8fa; border: 1px solid #e2e4e8; border-radius: 6px; padding: 1.75rem;">
                                                <h3 style="margin-top: 0; color: var(--uas-couleur-principale, #1f234b); font-size: 1.15rem; border-bottom: 2px solid var(--uas-couleur-principale, #1f234b); padding-bottom: 0.5rem;">
                                                    Coordonnées de l'INSG
                                                </h3>

                                                <div style="margin-top: 1.25rem;">
                                                    <p style="margin: 0 0 0.25rem 0; font-weight: 700; color: #333; font-size: 0.9rem;">Adresse physique :</p>
                                                    <p style="margin: 0 0 1rem 0; font-size: 0.9rem; color: #666; line-height: 1.4;">
                                                        Institut National des Sciences de Gestion<br />
                                                        Boulevard Triomphal Omar Bongo<br />
                                                        BP 2368 Libreville, Gabon
                                                    </p>
                                                </div>

                                                <div style="margin-top: 1rem;">
                                                    <p style="margin: 0 0 0.25rem 0; font-weight: 700; color: #333; font-size: 0.9rem;">Téléphone :</p>
                                                    <p style="margin: 0 0 1rem 0; font-size: 0.9rem; color: #666;">
                                                        +241 (0)11 76 20 40<br />
                                                        +241 (0)66 00 12 34
                                                    </p>
                                                </div>

                                                <div style="margin-top: 1rem;">
                                                    <p style="margin: 0 0 0.25rem 0; font-weight: 700; color: #333; font-size: 0.9rem;">Courrier électronique :</p>
                                                    <p style="margin: 0 0 1rem 0; font-size: 0.9rem; color: #666;">
                                                        contact@insg-gabon.ga<br />
                                                        scolarite@insg-gabon.ga
                                                    </p>
                                                </div>

                                                <div style="margin-top: 1rem;">
                                                    <p style="margin: 0 0 0.25rem 0; font-weight: 700; color: #333; font-size: 0.9rem;">Horaires d'accueil :</p>
                                                    <p style="margin: 0; font-size: 0.9rem; color: #666;">
                                                        Lundi au Vendredi : 07h30 – 15h30<br />
                                                        Samedi : 08h30 – 12h00
                                                    </p>
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
        </div>

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div>
    <div class="separateur"></div>
</main>
@endsection

