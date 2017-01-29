@extends('layout.master')

@push('header')
    @include('partials.welcome')
@endpush

@section('content')
    <h1>Hello World!</h1>
@stop