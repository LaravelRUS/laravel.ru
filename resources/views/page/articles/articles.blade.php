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

        <aside class="grid-4">
            Правая колонка, доверстаю потом 🐵
        </aside>
    </section>
@stop