<section class="nav">
    <div class="container">
        <nav>
            <a href="{{ route('home') }}" class="{{ $nav->match('home') }}">Главная</a>
            <a href="{{ route('docs') }}" class="{{ $nav->match('docs') }}">Документаця</a>
            <a href="{{ route('articles') }}" class="{{ $nav->match('articles') }}">Статьи</a>
            <a href="#">Пакеты</a>
            <a href="#">Работа</a>
            <a href="#" class="hidden-sm">Pastebin</a>
            <a href="#" class="ideas hidden-sm"></a>
        </nav>
    </div>
</section>
