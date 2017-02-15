@extends('layout.master')

@section('content')
    <section class="articles-list container-12">

        <div class="grid-8">
            <h2>Наши публикации</h2>

            @foreach($articles as $i => $article)
                <article class="article article-main">
                    @include('page.articles.partials.article-preview', [
                        'article'     => $article,
                        'isMain'      => true,
                        'withContent' => true
                    ])
                </article>
            @endforeach

            <footer>
                <a href="#" class="button main">Ещё</a>
            </footer>
        </div>

        <aside class="grid-4" data-vm="StickyPanelViewModel" style="position: relative">
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
    <link rel="prev" href="{{ $articles->previousPageUrl() }}">
@endif
@if($articles->hasMorePages())
    <link rel="next" href="{{ $articles->nextPageUrl() }}">
    <link rel="prerender" href="{{ $articles->nextPageUrl() }}">
@endif
@endpush