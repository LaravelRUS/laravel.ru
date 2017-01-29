<header data-vm="HeaderViewModel">
    <section class="container-12">
        <a class="logo" href="{{ URL::to('/') }}">
            @include('partials.logo')

            <h1>Laravel</h1>
            <span>Русское сообщество</span>
        </a>

        <nav>
            <a href="#">Документация</a>
            <a href="#">Статьи</a>
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


            <div data-id="user-handler"
                 data-bind="click: user.toggle" class="dropdown @{{ user.active }}">

                <span>Аккаунт</span>

                <nav>
                    <a href="#">Профиль</a>
                    <hr />
                    <a href="#">Публикации</a>
                    <a href="#">Комментарии</a>
                    <hr />
                    <a href="#">Настройки</a>
                    <a href="#">Выход</a>
                </nav>
            </div>
        </nav>
    </section>
</header>