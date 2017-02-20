@extends('layout.master')

@push('title', 'Наши публикации &mdash; ')

@section('content')
    <section class="articles-list container-12" data-vm="ArticleListViewModel">

        <div class="grid-8">
            <h2>Наши публикации</h2>

            @{{#foreach articles}}
                <article class="article article-main @{{ loaded() ? '' : 'article-hidden' }}"
                         data-bind="inview: visible">
                    @include('page.articles.partials.article-preview')
                </article>
            @{{/foreach}}

            @{{#if loading}}
                <div class="preloader"></div>
            @{{/if}}

            <footer>
                <a href="#" data-bind="click: fetchNextPage" class="button main">Ещё</a>
            </footer>
        </div>

        <aside class="grid-4" data-bind="with: aside" style="position: relative">
            <div data-bind="attr: {
                style: 'top: 0; width: 300px; position: ' + (fixed() ? 'fixed' : 'relative') + ';'
            }">
                <div style="padding: 30px 20px; box-sizing: border-box; width: 100%; box-shadow: inset 1px 0 0 #eee">
                    <strong>Правая колонка</strong>
                    <br />
                    <br />
                    <br />
                    Доверстаю потом 🐵
                </div>
            </div>
        </aside>
    </section>
@stop


@push('head')
    @if($articles->previousPageUrl())
        <link rel="prev" href="{{ $articles->previousPageUrl() }}" />
        <link rel="prerender" href="{{ $articles->previousPageUrl() }}" />
    @endif

    @if($articles->hasMorePages())
        <link rel="next" href="{{ $articles->nextPageUrl() }}" />
        <link rel="prerender" href="{{ $articles->nextPageUrl() }}" />
    @endif
@endpush
