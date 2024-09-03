<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ active_link('home') }}" aria-current="page" href="{{ route('home') }}">{{__('Главная')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_link('products') }}" href="{{ route('products') }}">{{ __('Продукция') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ active_link('promotions') }}" href="{{ route('promotions') }}">{{ __('Акции') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Контакты') }}</a>
                </li>
                @role('Admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('Администрирование') }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="adminNavbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('products.list') }}">{{ __('Продукция') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.list') }}">{{ __('Оборудование') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('products.list') }}">{{ __('Организации') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('users') }}">{{ __('Пользователи') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('roles') }}">{{ __('Настройка прав доступа') }}</a></li>
                            <li><a class="dropdown-item" href="#">{{ __('Список заказов') }}</a></li>
                        </ul>
                    </li>
                @endrole
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <x-navbar.nav-item
                    active="{{ active_link('favorites') }}"
                    href="#"
                    icon="fa-solid fa-heart text-danger"
                >
                    {{__('Избранное')}}
                </x-navbar.nav-item>
                <x-navbar.nav-item
                    active="{{ active_link('cart') }}"
                    href="{{ route('cart') }}"
                    icon="fa-solid fa-basket-shopping"
                >
                    {{__('Корзина')}}
                </x-navbar.nav-item>
                @if(Route::has('login'))
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-regular fa-user"></i>
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="profileNavbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Профиль') }}</a></li>
                                <x-form action="{{ route('logout') }}" method="POST">
                                    <li class="nav-item"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <a class="nav-link" href="{{ route('logout') }}">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                            {{__('Выход')}}
                                        </a>
                                    </li>
                                </x-form>
                            </ul>
                        </li>
                    @else
                        @if(Route::has('register'))
                            <x-navbar.nav-item
                                href="{{ route('register') }}"
                                icon="fa-regular fa-user"
                            >
                                {{__('Регистрация')}}
                            </x-navbar.nav-item>
                        @endif
                            <x-navbar.nav-item
                                href="{{ route('login') }}"
                                icon="fa-regular fa-user"
                            >
                                {{__('Вход')}}
                            </x-navbar.nav-item>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

