<section class="search" data-vm="partials/Search">
    <div class="container">
        <a href="{{ route('home') }}" class="logo">
            @include('partials.logo')
            <h1>Laravel</h1>
            <h2>Русское сообщество</h2>
        </a>

        <div class="new-line-sm"></div>

        <section class="search-section">
            <ui-text class="search-input" params="value: value, placeholder: placeholder"></ui-text>

            <div class="new-line-sm"></div>

            <ui-dropdown params="options: options, value: category"></ui-dropdown>

            <a href="#" class="button">Найти</a>
        </section>
    </div>
</section>
