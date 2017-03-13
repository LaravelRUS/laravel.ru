<header>
    <section class="container-12">
        <aside class="grid-3">
            <a class="logo" href="{{ route('home') }}">
                @include('partials.logo')

                <h1>Laravel</h1>
                <span>Русское сообщество</span>
            </a>
        </aside>

        <section class="grid-9 search">
            <div class="select">
                <select>
                    <option>Документация</option>
                    <option>Статьи</option>
                    <option>Пакеты</option>
                </select>
                <span class="select-arrow"></span>
            </div>

            <input type="text" placeholder="Поиск по сайту" />
            <a href="#" class="button main">Найти</a>
        </section>
    </section>
</header>

<section class="sub-header" data-vm="HeaderViewModel">
    <article class="container-12 sub-header-fixed">
        <nav class="nav">
            <a href="{{ route('docs') }}" class="{{ $nav->match('docs') }}">Документация</a>
            <a href="{{ route('articles') }}" class="{{ $nav->match('articles') }}">Статьи</a>
            <a href="#">Пакеты</a>
            <a target="_blank" href="http://vk.com/laravel_rus">Сообщество</a>
            <a target="_blank" href="https://gitter.im/LaravelRUS/chat">Чат</a>
            <a target="_blank" href="https://github.com/LaravelRUS/laravel.ru">GitHub</a>
            <a href="{{ route('graphql.graphiql') }}">API</a>

            @if($auth !== null)
                <div data-id="user-handler"
                     data-bind="click: user.toggle" class="dropdown @{{ user.active }}">

                    <span>
                        <img src="{{ $auth->avatar }}" alt="{{ $auth->name }}" />
                    </span>

                    <nav>
                        <a href="#" title="{{ $auth->name }}">
                            {{ $auth->name }}
                        </a>
                        <hr />
                        <a href="#">Публикации</a>
                        <a href="#">Комментарии</a>
                        <hr />
                        <a href="#">Настройки</a>

                        <form action="{{ route('logout') }}" method="POST" id="_logout">
                            {!! csrf_field() !!}
                        </form>

                        <a href="{{ route('logout') }}" rel="nofollow" onclick="_logout.submit();">
                            Выход
                        </a>
                    </nav>
                </div>
            @else
                <a href="{{ route('login', ['from' => Request::path()]) }}"
                   title="Аутентификация" class="auth-button"></a>
            @endif
        </nav>
    </article>
</section>