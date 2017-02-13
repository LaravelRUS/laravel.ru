@extends('layout.master')

@push('header')
    @include('partials.welcome')
@endpush

@section('content')
    <section class="articles-list home-page">
        <div class="container-12">
            <h2>Последние новости</h2>

            @foreach($articles as $i => $article)
                <div class="grid-{{ $i ? '4' : '12' }}">
                    <article class="article @if($i === 0) article-main @endif">
                        @include('page.articles.partials.article-preview', [
                            'article' => $article,
                            'isMain'  => $i === 0
                        ])
                    </article>
                </div>
            @endforeach

            <footer>
                <a href="{{ route('articles') }}" class="button main icon-show-more">
                    Все новости
                </a>
            </footer>
        </div>
    </section>
@stop