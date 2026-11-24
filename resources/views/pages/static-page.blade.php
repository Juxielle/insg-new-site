@extends('layouts.app')

@section('title', $title . ' - INSG Gabon')
@section('meta_description', Str::limit(strip_tags($bodyContent), 160))

@if(request()->is('organiser-un-evenement-1'))
    @section('bandeau_style', 'background-image: url(' . asset('assets/images/reportages/campus-01.webp') . '); background-color: #1f234b;')
@endif

@push('styles')
    @if(!empty($staticLayoutCss))
        <style>{!! $staticLayoutCss !!}</style>
    @endif
@endpush

@section('content')
{!! $bodyContent !!}
@endsection

