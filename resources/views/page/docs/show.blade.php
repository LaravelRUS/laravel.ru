@extends('layout.master')

@section('content')
    <?php /** @var \App\Models\Docs $docs */ ?>

    <section class="container-12 docs-show" data-vm="DocsShowViewModel">
        <aside class="grid-4 docs-nav" data-bind="with: aside">
            <h3>Содержание</h3>

            <div data-id="nav" class="docs-navigation" data-bind="css: { fixed: fixed, 'bind-top': top }">
                <nav>
                    <ul>
                        @foreach($docs->getNav('h1', 'h2', 'h3', 'h4') as $link)
                            <li class="level-{{ $link->level }}">
                                <a href="#{{ $link->anchor or '' }}">
                                    {{ $link->title or 'undefined' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>

        </aside>

        <section class="grid-8 docs-content">
            <div data-bind="interpolation: false">
                <h1>{{ $docs->title }}</h1>

                {!! $docs->content_rendered !!}
            </div>
        </section>
    </section>
@stop