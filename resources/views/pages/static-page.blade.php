@extends('layouts.app')

@section('title', $title . ' - INSG Gabon')
@section('meta_description', Str::limit(strip_tags($bodyContent), 160))

@section('content')
<main id="page">
    <div id="page_deco">
        @include('partials.banner', ['breadcrumbs' => [$title => '']])

        {!! $bodyContent !!}

        <div class="date-miseajour">Mise &agrave; jour :&nbsp;{{ date('d F Y') }}</div>
        <div id="redacteur-date-impression"></div>
    </div>
    <div class="separateur"></div>
</main>
@endsection

