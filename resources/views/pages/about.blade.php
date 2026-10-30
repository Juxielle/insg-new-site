@extends('layouts.app')

@section('title', 'À propos de l\'INSG')
@section('meta_description', 'Découvrez l\'histoire, la mission et la gouvernance de l\'INSG Gabon.')
@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Institut' => '']])

        <div id="contenu-encadres">
            <div id="avec_nav_sans_encadres" class="contenu" role="main">
                <h1>L'Institut National des Sciences de Gestion (INSG Gabon)</h1>

                <div class="ligne_1"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
<h2>Un institut historique au service du Gabon</h2><p>Fondé en 1973, l’Institut National des Sciences de Gestion (INSG) est un établissement public d’enseignement supérieur et de recherche. Sa mission est de former des cadres compétents dans les différents domaines des sciences de gestion.</p><p>Depuis sa création, l’Institut accompagne les transformations de l’administration, des entreprises et de l’économie gabonaise. Il a contribué à former plusieurs générations de professionnels appelés à exercer des responsabilités dans les secteurs public et privé.</p><p>Fort de plus de cinquante années d’expérience, l’INSG affirme aujourd’hui une identité singulière, à la croisée de l’université publique et de la grande école de management. Cet héritage nourrit un projet pédagogique fondé sur l’exigence académique, l’ouverture et la proximité avec le monde professionnel.</p>
<h2>Une institution, trois dimensions</h2><p>L’INSG réunit les missions de service public, de production scientifique et de préparation aux métiers du management. Trois dimensions complémentaires définissent sa vocation et guident son action.</p><ul><li><strong>Une école nationale :</strong> Acteur de l’intégration sociale, l’INSG accompagne l’État dans sa politique de formation et d’accès à un enseignement supérieur de qualité. Elle contribue à donner aux étudiants les moyens de construire leur avenir et de servir le développement national.</li><li><strong>Une école universitaire :</strong> Ancré dans l’enseignement supérieur gabonais, l’Institut offre un espace d’excellence scientifique consacré au management public et privé. Il encourage la recherche, la coopération académique, le partage des connaissances et la formation des formateurs.</li><li><strong>Une école de management :</strong> À la manière d’une <em>Business School</em>, l’INSG rapproche les apprentissages des réalités professionnelles. Ses formations développent les compétences opérationnelles, le leadership, l’employabilité et la capacité à entreprendre.</li></ul>
<h2>Une référence du management en Afrique</h2><p>Notre ambition est de faire de l’INSG une école universitaire de management de référence en Afrique, reconnue pour la qualité de ses formations, la pertinence de sa recherche et la réussite de ses diplômés.</p><p>À l’image des grandes <em>Business Schools</em> internationales, l’Institut œuvre à l’amélioration continue de la qualité académique, au rayonnement scientifique et au renforcement de ses partenariats avec les universités, les entreprises et les institutions publiques.</p><p>Cette vision place l’étudiant au cœur du projet institutionnel. Elle vise à former des femmes et des hommes responsables, capables d’innover, de conduire le changement et de participer activement au développement économique et social du Gabon.</p>
<h2>Notre mission au quotidien</h2><p>L’INSG propose des parcours qui associent connaissances fondamentales, maîtrise des outils de gestion et mise en pratique. Les enseignements, projets, stages et rencontres professionnelles permettent aux apprenants de mieux comprendre les réalités des organisations.</p><p>L’Institut soutient également la production et la diffusion de connaissances utiles à la décision. Il encourage les travaux consacrés aux enjeux du management, de la gouvernance, de l’entrepreneuriat et de la transformation des organisations africaines.</p><p>À travers son organisation administrative et pédagogique, son service de scolarité et l’engagement de ses équipes, l’INSG veille à offrir un accompagnement de qualité tout au long du parcours étudiant.</p>
</div><!-- .paragraphe__contenu--0 .toolbox -->
                    </div><!-- paragraphe--0 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_1 -->

                <div class="ligne_2" id="mot-directeur"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Une Direction engagée pour la réussite</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <figure class="photo vignette_gauche" style="float: left; margin: 0 1.5em 1em 0;">
                                <img src="{{ $director->photo_url ?? asset('assets/images/directeur-1.png') }}" alt="{{ $director->name ?? 'Directrice Générale de l\'INSG' }}" style="width: 180px; max-width: 180px;" />
                                <figcaption class="legende">
                                    <strong>{{ $director->name ?? 'Pr. Murielle Natacha M\'BOUNA' }}</strong><br>
                                    <small>{{ $director->role ?? 'Directeur Général de l\'INSG' }}</small>
                                </figcaption>
                            </figure>
                            <p class="chapo">« {{ $director->quote ?? 'Depuis sa création, l\'Institut National des Sciences de Gestion s\'est imposé comme une référence dans la formation des cadres gabonais. Notre ambition associe rigueur académique, ouverture internationale et proximité avec le monde socio-économique pour faire de chaque étudiant un acteur compétitif du développement.' }} »</p>
                            <p>► <a href="{{ route('formations.index') }}" class="lien_interne"><strong>Découvrir toutes les offres de formations de l'INSG</strong></a></p>
                            <div style="clear: both;"></div>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_2 -->

                <div class="ligne_3" id="gouvernance-axes"><div class="colonne_1">
                    <div class="colonne_deco"><div class="paragraphe--4">
                        <h2 class="paragraphe__titre--4">Organisation &amp; Pôles d'Excellence</h2>
                        <div class="paragraphe__contenu--4 toolbox">
                            <p>Une vue d’ensemble claire de la gouvernance, des pôles et des services qui structurent le fonctionnement administratif et pédagogique de l’INSG.</p>
                            <ul><li><strong>Une école nationale :</strong> Acteur de l’intégration sociale, l’INSG accompagne l’État dans sa politique de formation et d’accès à un enseignement supérieur de qualité. Elle contribue à donner aux étudiants les moyens de construire leur avenir et de servir le développement national.</li><li><strong>Une école universitaire :</strong> Ancré dans l’enseignement supérieur gabonais, l’Institut offre un espace d’excellence scientifique consacré au management public et privé. Il encourage la recherche, la coopération académique, le partage des connaissances et la formation des formateurs.</li><li><strong>Une école de management :</strong> À la manière d’une <em>Business School</em>, l’INSG rapproche les apprentissages des réalités professionnelles. Ses formations développent les compétences opérationnelles, le leadership, l’employabilité et la capacité à entreprendre.</li></ul>
                            <p>► <a href="/gouvernance" class="lien_interne"><strong>Consulter la gouvernance complète et l'organigramme</strong></a><br>
                               ► <a href="/chiffres-cles" class="lien_interne"><strong>Consulter les chiffres clés de l'INSG</strong></a><br>
                               ► <a href="{{ route('campus') }}" class="lien_interne"><strong>Découvrir le campus de Libreville</strong></a></p>
                        </div><!-- .paragraphe__contenu--4 .toolbox -->
                    </div><!-- paragraphe--4 --></div><!-- colonne_deco -->
                </div><!-- .colonne_1 --></div><!-- .ligne_3 -->

            </div><!-- #avec_nav_sans_encadres .contenu -->
        </div><!-- #contenu-encadres -->

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div><!-- #page_deco -->
    <div class="separateur"></div>
</main>
@endsection
