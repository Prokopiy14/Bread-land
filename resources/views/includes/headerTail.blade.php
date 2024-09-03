<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 mr-3" />
                        <a class="navbar-brand" href="{{route('home')}}">
                            {{ config('app.name') }}
                        </a>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Главная') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products')" :active="request()->routeIs('products')">
                        {{ __('Продукция') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')" >
                        {{ __('Контакты') }}
                    </x-nav-link>
                    <x-nav-link :href="route('enterprise')" :active="request()->routeIs('enterprise')">
                        {{ __('О предприятии') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <a href="{{ route('favorites') }}" class="text-sm font-semibold leading-6 text-gray-900">
                    <i class="fa-solid fa-heart text-red-600"></i>
                    {{__('Избранное')}}
                </a>
                <a href="{{ route('cart') }}" class="text-sm ml-4 font-semibold leading-6 text-gray-900">
                    <i class="fa-solid fa-basket-shopping text-gray-600"></i>
                    {{__('Корзина')}}
                </a>
                @if(Route::has('login'))
                    @role('Admin')
                    <x-dropdown-admin/>
                    @endrole
                    @auth
                    <x-dropdown-profile/>
                    @else
                        <a href="{{ route('login') }}" class="text-sm ml-4 font-semibold leading-6 text-gray-900">{{ __('Вход') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm ml-4 font-semibold leading-6 text-gray-900">{{ __('Регистрация') }}</a>
                        @endif
                    @endauth
                @endif


            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Главная') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products')" :active="request()->routeIs('products')">
                {{ __('Продукция') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-2 pb-1 border-t border-gray-200">
            <x-responsive-nav-link :href="route('favorites')">
                <i class="fa-solid fa-heart text-red-600"></i>
                {{ __('Избранное') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart')">
                <i class="fa-solid fa-basket-shopping text-gray-600"></i>
                {{ __('Корзина') }}
            </x-responsive-nav-link>

            @if(Route::has('login'))
                <div class="border-t border-gray-100"></div>
                @role('Admin')
                <x-dropdown-admin/>
                @endrole
                @auth
                    <x-responsive-nav-link :href="route('profile.edit')">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Выйти') }}
                        </x-responsive-nav-link>
                    </form>
                @else
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Вход') }}
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Регистрация') }}
                        </x-responsive-nav-link>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
