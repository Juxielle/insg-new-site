@extends('layouts.app')

@section('title', $page['label'].' | INSG Gabon')
@section('meta_description', $page['intro'])
@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => ['Incubateur' => route('incubateur.index'), $page['label'] => '']])
        <div id="contenu-encadres">
            <div id="avec_nav_avec_encadres" class="contenu" role="main">
                <h1>{{ $page['title'] }}</h1>
                <div class="ligne_1"><div class="colonne_1"><div class="colonne_deco">
                    <div class="paragraphe--0"><div class="paragraphe__contenu--0 toolbox">
                        <p class="chapo">{{ $page['intro'] }}</p>
                        @include('partials.editorial-photo', [
                            'theme' => $currentPage === 'recherche' ? 'recherche' : 'incubateur',
                            'photoIndex' => $currentPage === 'entrepreneuriat-etudiant' ? 1 : 0,
                            'caption' => $currentPage === 'recherche' ? 'Colloque international Gabon PME 2025.' : 'Accompagnement des porteurs de projets de l’incubateur HCO.',
                        ])
                        @foreach($page['blocks'] as $block)
                            @switch($block['type'])
                                @case('photo')
                                    <figure class="photo" style="margin: 1.5em 0;">
                                        <img src="{{ asset($block['path']) }}" alt="{{ $block['text'] }}" width="1600" height="1348" loading="lazy" style="display: block; width: 100%; height: auto;" />
                                        <figcaption class="legende">{{ $block['text'] }}</figcaption>
                                    </figure>
                                    @break
                                @case('heading')
                                    <h2>{{ $block['text'] }}</h2>
                                    @break
                                @case('subheading')
                                    <h3>{{ $block['text'] }}</h3>
                                    @break
                                @case('eyebrow')
                                    <p><strong>{{ $block['text'] }}</strong></p>
                                    @break
                                @case('link')
                                    <p><a class="lien_interne" href="{{ $block['href'] }}">{{ $block['text'] }}</a></p>
                                    @break
                                @default
                                    <p>{{ $block['text'] }}</p>
                            @endswitch
                        @endforeach
                    </div></div>
                </div></div></div>
            </div>
            <aside id="encadres" role="complementary">
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Incubateur</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <ul>
                            @foreach($pages as $slug => $entry)
                                <li><a class="lien_interne" href="{{ route('incubateur.page', $slug) }}" @if($slug === $currentPage) aria-current="page" @endif>{{ $entry['label'] }}</a></li>
                            @endforeach
                        </ul>
                        <p><a class="lien_interne" href="{{ route('contact') }}">Nous contacter</a></p>
                    </div>
                </div>
                <div class="encadre encadre_fiche encadre--2">
                    <h2 class="encadre__titre--2">Repères HCO</h2>
                    <div class="encadre_contenu encadre__contenu--2 toolbox">
                        <ul>
                            <li><strong>20 décembre 2023 :</strong> inauguration de l’incubateur.</li>
                            <li><strong>29 novembre 2024 :</strong> première rentrée.</li>
                            <li><strong>15 incubés</strong> issus de plusieurs établissements dans la première cuvée.</li>
                            <li><strong>2024-2025 :</strong> formations et conférences pour cette première cuvée.</li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <div class="separateur"></div>
</main>
@endsection
