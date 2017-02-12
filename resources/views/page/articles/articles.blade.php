@extends('layout.master')

@section('content')
    <section class="articles-list container-12">
        <h2>Последние новости</h2>

        @foreach($articles as $i => $article)
            <article class="article article-main grid-12">
                @include('page.articles.partials.article-preview', [
                    'article' => $article,
                    'isMain'  => true
                ])
            </article>
        @endforeach
    </section>
@stop