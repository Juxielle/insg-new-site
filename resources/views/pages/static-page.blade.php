@extends('layouts.app')

@section('title', $title . ' - INSG Gabon')
@section('meta_description', Str::limit(strip_tags($bodyContent), 160))

@push('styles')
    @if(!empty($staticLayoutCss))
        <style>{!! $staticLayoutCss !!}</style>
    @endif
@endpush

@section('content')
{!! $bodyContent !!}
@endsection

