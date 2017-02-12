@extends('layout.master')

@push('header')
    @include('partials.welcome')
@endpush

@section('content')
    <section class="articles-list home-page">
        <div class="container-12">
            <h2>Последние новости</h2>

            @foreach($articles as $i => $article)
                <article class="article @if($i === 0) article-main grid-12 @else grid-4 @endif">
                    @include('page.articles.partials.article-preview', [
                        'article' => $article,
                        'isMain'  => $i === 0
                    ])
                </article>
            @endforeach
        </div>
    </section>
@stop