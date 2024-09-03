<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-3 mt-12">
        @include('includes.carousel')

        <div class="mx-auto justify-center px-6 md:flex md:space-x-6 xl:px-0">
            <div class="mt-6 h-full rounded-lg p-6 md:mt-0 md:w-1/3">
                <h5 class="mb-6 text-5xl font-bold tracking-tight text-gray-900">{{ __('Каталог') }}</h5>
                <p class="mb-6 font-normal text-gray-700 dark:text-gray-400">
                    {{ __('Основная часть продукции вырабатывается на предприятии по традиционной классической технологии - опарным способом и на густых заквасках, в итоги получается вкусный и ароматный хлеб') }}
                </p>
                <a href="{{ route('products') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 uppercase">
                    {{ __('Подробнее') }}
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
            </div>
            <div class="rounded-lg md:w-2/3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <img class="h-auto max-w-sm rounded-lg" src="{{ asset('images/banner-1.jpg') }}" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-sm rounded-lg" src="{{ asset('images/banner-2.jpg') }}" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-sm rounded-lg" src="{{ asset('images/banner-3.jpg') }}" alt="">
                    </div>
                    <div>
                        <img class="h-auto max-w-sm rounded-lg" src="{{ asset('images/banner-4.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
