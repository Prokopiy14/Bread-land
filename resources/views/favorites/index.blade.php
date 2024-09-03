<x-app-layout>
    @section('page.title','Избранное')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-3 mt-2">
        <div class="container-title">
            <h2 class="font-semibold text-3xl font-medium text-gray-900">
                {{ __('Избранное') }}
            </h2>
        </div>
        <div class="flex flex-row items-center">
            <a href="{{ route('products') }}" class="flex font-semibold text-indigo-600 hover:text-indigo-700 text-sm mr-4">
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
                </svg>
                {{ __('Продолжить покупки') }}
            </a>
            <button class="text-[#999] hover:text-red-600" id="clear-favorites-btn">
                <i class="fa-sharp fa-solid fa-xmark"></i>
                <span>{{ __('Очистить избранное') }}</span>
            </button>
        </div>
    </div>

</x-app-layout>
