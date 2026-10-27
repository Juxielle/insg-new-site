@extends('layouts.app')

@section('title', $title . ' - INSG Gabon')
@section('meta_description', Str::limit(strip_tags($bodyContent), 160))

@section('content')
{!! $bodyContent !!}
@endsection

