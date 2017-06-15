<section class="topline">
    <div class="container">
        <nav class="menu">
            <a href="#">Laravel</a>
            <a href="#">Lumen</a>
            <a href="#">SleepingOwlAdmin</a>
            <a href="#">Сообщество</a>
            <a href="#">Чат</a>
            <a href="#">GitHub</a>
            <a href="#">API</a>
            <a href="#">Karma</a>
        </nav>
        
        <nav class="user">
            @if (Auth::check())
                ...
            @else
                <a href="{{ route('login') }}" class="user-login">Войти</a>
            @endif
        </nav>
    </div>
</section>