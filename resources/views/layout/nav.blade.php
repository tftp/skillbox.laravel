
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="#">Subscribe</a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="#">Large</a>
            </div>

            <div class="col-4 d-flex justify-content-end align-items-center" id="navbarSupportedContent">
                <a class="text-muted" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                </a>
                @guest
                    @if (Route::has('login'))
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif

                    @if (Route::has('register'))
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                        <a id="navbarDropdown" class="btn btn-sm btn-outline-secondary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                @endguest
            </div>


        </div>
    </header>

    @admin
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            Админ раздел:
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="{{ route('admin.articles') }}">Список статей</a>
                    <a class="nav-item nav-link" href="{{ route('admin.feedback') }}">Обратная связь</a>
                    <a class="nav-item nav-link" href="{{ route('news.create') }}">Создать новость</a>
                    <a class="nav-item nav-link" href="{{ route('information') }}">Информация о портале</a>
                </div>
            </div>
        </nav>
    @endadmin

    <div class="nav-scroller py-1 mb-2">
        <nav class="nav">
            <a class="p-2 text-muted" href="{{ route('home') }}">Главная</a>
            @if(auth()->check() && ! auth()->user()->isAdmin())
                <a class="p-2 text-muted" href="{{ route('owner.articles') }}">Мои статьи</a>
            @endif
            <a class="p-2 text-muted" href="{{ route('about') }}">О нас</a>
            <a class="p-2 text-muted" href="{{ route('news.index') }}">Новости</a>
            <a class="p-2 text-muted" href="{{ route('contacts.create') }}">Контакты</a>
            <a class="p-2 text-muted" href="{{ route('articles.create') }}">Создать статью</a>
        </nav>
    </div>
</div>
