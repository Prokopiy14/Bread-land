<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Пароль')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <x-checkbox :checked="!!old('remember')"/>
                <span class="ml-2 text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Забыли пароль?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Вход') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>







{{--@extends('layouts.auth')--}}
{{--@section('page.title','Авторизация')--}}
{{--@section('content')--}}
{{--    <x-container>--}}
{{--        <div class="row ">--}}
{{--            <div class="col-12">--}}
{{--                <x-auth.card>--}}
{{--                    <x-auth.card-title>--}}
{{--                        {{ __('Вход') }}--}}
{{--                    </x-auth.card-title>--}}
{{--                    @if(session('status'))--}}
{{--                        <div class="alert alert-success d-flex align-items-center" role="alert">--}}
{{--                            <i class="fa-solid fa-circle-check"></i>--}}
{{--                            <div class="ms-2">--}}
{{--                                {{ __('Пароль успешно изменён') }}--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    <x-form action="{{ route('login') }}" method="POST">--}}
{{--                        <label class="form-label required">{{ __('Email') }}</label>--}}
{{--                        <x-auth.input-group>--}}
{{--                            <span class="input-group-text bg-body ">--}}
{{--                                <i class="fa-regular fa-envelope"></i>--}}
{{--                            </span>--}}
{{--                            <input type="email" name="email" class="form-control" placeholder="{{ __('name@example.com') }}" value="{{ old('email') }}" autofocus>--}}
{{--                        </x-auth.input-group>--}}
{{--                        @error('email')--}}
{{--                        <x-auth.error>--}}
{{--                            {{ $message }}--}}
{{--                        </x-auth.error>--}}
{{--                        @enderror--}}
{{--                        <label class="form-label required">{{ __('Пароль') }}</label>--}}
{{--                        <x-auth.input-group>--}}
{{--                            <span class="input-group-text bg-body ">--}}
{{--                                <i class="fa-solid fa-lock"></i>--}}
{{--                            </span>--}}
{{--                            <input type="password" name="password" class="form-control" placeholder="{{ __('Пароль') }}">--}}
{{--                        </x-auth.input-group>--}}
{{--                        @error('password')--}}
{{--                        <x-auth.error>--}}
{{--                            {{ $message }}--}}
{{--                        </x-auth.error>--}}
{{--                        @enderror--}}
{{--                        <div class="form-check">--}}
{{--                            <x-checkbox name="remember" :checked="!!old('remember')">--}}
{{--                                {{ __('Запомнить меня') }}--}}
{{--                            </x-checkbox>--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn btn-primary col-12 col-md-8 offset-md-2 mt-2">{{ __('Войти') }}</button>--}}
{{--                        <hr>--}}
{{--                        <p>--}}
{{--                            {{ __('Нет учетной записи ?') }} <a href="{{ route('register') }}">{{ __('Зарегистрируйтесь') }}</a><br>--}}
{{--                            {{ __('Забыли пароль?') }} <a href="{{ route('password.request') }}">{{ __('Восстановить') }}</a><br>--}}
{{--                            {{ __('Нажмите') }} <a href="/">{{ __('назад') }}</a>{{ __(', чтобы вернуться на главную страницу') }}--}}
{{--                        </p>--}}
{{--                    </x-form>--}}
{{--                </x-auth.card>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </x-container>--}}
{{--@endsection--}}

