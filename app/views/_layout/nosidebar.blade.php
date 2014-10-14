@extends('_layout.main')

@section('container')


<div class="blog container">
    <div class="row">

        <div class="blog-entry section col-md-12 col-sm-12 col-xs-12">

            @yield('content')

        </div> <!-- blog-entry -->

    </div> <!-- row -->
</div> <!-- container -->


@stop