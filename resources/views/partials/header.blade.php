<header data-vm="HeaderViewModel">
    <section class="container-12">
        <a class="logo" href="{{ URL::to('/') }}">
            @include('partials.logo')

            <h1>Laravel</h1>
            <span>Русское сообщество</span>
        </a>

        <nav>
            <a href="#">Документация</a>
            <a href="{{ route('articles') }}"
               class="{{ (url()->current() === route('articles')) ? 'active' : '' }}">Статьи</a>
            <a href="#">Пакеты</a>


            <div data-id="resources-handler"
                 data-bind="click: resources.toggle" class="dropdown @{{ resources.active }}">

                <span>Ресурсы</span>

                <nav>
                    <a target="_blank" href="https://gitter.im/LaravelRUS/GitterBot">Чат</a>
                    <a target="_blank" href="https://github.com/LaravelRUS/Laravel-Karma">GitHub</a>
                    <hr />
                    <a target="_blank" href="http://laravel.su/docs">Документация</a>
                    <a target="_blank" href="http://vk.com/laravel_rus">Сообщество</a>
                </nav>
            </div>


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
    </section>
</header>