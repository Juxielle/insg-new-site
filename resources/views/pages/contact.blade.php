@extends('layouts.app')

@section('title', 'Contactez l\'INSG')
@section('meta_description', 'Coordonnées et formulaire de contact de l\'INSG Gabon.')
@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Contact' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>Contactez l'INSG Gabon</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">Une question sur nos formations, les admissions ou un partenariat ? Notre équipe vous répond.</p>

                        @if(session('success'))
                            <div class="message_confirmation" style="background:#e8f5e9; border-left:4px solid #2e7d32; padding:1em; margin-bottom:1.5em; color:#2e7d32;">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="message_erreur" style="background:#ffebee; border-left:4px solid #c62828; padding:1em; margin-bottom:1.5em; color:#c62828;">
                                <p><strong>Veuillez corriger les erreurs suivantes :</strong></p>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h2>Formulaire de contact</h2>

                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <p>
                                <label for="name"><strong>Nom complet :</strong> <span style="color:#c62828;">*</span></label><br>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width:100%; box-sizing:border-box;" placeholder="Votre nom et prénom" />
                            </p>

                            <p>
                                <label for="email"><strong>Adresse email :</strong> <span style="color:#c62828;">*</span></label><br>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width:100%; box-sizing:border-box;" placeholder="exemple@domaine.ga" />
                            </p>

                            <p>
                                <label for="phone"><strong>Téléphone :</strong></label><br>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" style="width:100%; box-sizing:border-box;" placeholder="+241 077 00 00 00" />
                            </p>

                            <p>
                                <label for="subject"><strong>Objet de votre demande :</strong> <span style="color:#c62828;">*</span></label><br>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required style="width:100%; box-sizing:border-box;" placeholder="Ex: Renseignements admission Master Finance" />
                            </p>

                            <p>
                                <label for="message"><strong>Message :</strong> <span style="color:#c62828;">*</span></label><br>
                                <textarea id="message" name="message" rows="6" required style="width:100%; box-sizing:border-box;" placeholder="Détaillez votre demande ici...">{{ old('message') }}</textarea>
                            </p>

                            <p>
                                <button type="submit" class="button"><span>Envoyer le message</span></button>
                            </p>
                        </form>
                    </div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

            </div><!-- #avec_nav_avec_encadres .contenu -->

            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Coordonnées</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <p><strong>Institut National des Sciences de Gestion</strong><br>
                        Boulevard Triomphal<br>
                        Libreville, Gabon</p>
                        <p><strong>Téléphone :</strong><br>
                        +241 01 23 45 67<br>
                        +241 01 23 45 67</p>
                        <p><strong>Email officiel :</strong><br>
                        contact@insg-gabon.ga</p>
                    </div><!-- .encadre_contenu -->
                </div><!-- .encadre -->

                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Horaires d'accueil</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <p>Du lundi au vendredi :<br>
                        Horaires communiqués par l’Institut</p>
                        <p>Fermé les samedis, dimanches et jours fériés.</p>
                        <p>► <a href="{{ route('campus') }}" class="lien_interne">Plan d'accès au campus</a></p>
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
