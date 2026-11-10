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
                        @foreach($page['blocks'] as $block)
                            @switch($block['type'])
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
            </aside>
        </div>
    </div>
    <div class="separateur"></div>
</main>
@endsection
