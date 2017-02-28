@extends('layout.master')

@section('content')
    <?php /** @var \App\Models\Docs $docs */ ?>

    <section class="container-12">
        <aside class="grid-4">
            <nav>
                <h3>Table of contents</h3>
                <ul>
                    @foreach($docs->getNav('h1', 'h2', 'h3', 'h4') as $link)
                        <li>
                            <a href="#{{ $link->anchor or '' }}">{{ $link->title or 'undefined' }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>

        </aside>

        <section class="grid-8" data-vm="DocsShowViewModel">

            <div class="article" data-bind="interpolation: false">
                <h1>{{ $docs->title }}</h1>

                {!! $docs->content_rendered !!}
            </div>
        </section>
    </section>
@stop