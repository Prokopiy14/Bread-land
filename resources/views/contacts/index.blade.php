<x-app-layout>
@section('page.title','Контакты')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mt-10">
            <div class="max-w-4xl">
                <span class="text-3xl font-semibold font-sans">{{ __('Контакты') }}</span>
                <div class="grid grid-cols-1 gap-4 mt-4">
                    <div class="flex flex-row items-center">
                        <i class="fa-solid fa-phone mr-1"></i>
                        <h1 class="mr-1">{{ __('Телефон:') }}</h1>
                        <span class="font-mono">{{ __('+7(919)-675-45-32') }}</span>
                    </div>
                    <div class="flex flex-row items-center">
                        <i class="fa-brands fa-telegram text-blue-600 mr-1"></i>
                        <h1 class="mr-1">{{ __('Telegram:') }}</h1>
                        <span class="font-mono">{{ __('+7(919)-476-77-77') }}</span>
                    </div>
                    <div class="flex flex-row items-center">
                        <i class="fa-solid fa-envelope mr-1"></i>
                        <h1 class="mr-1">{{ __('Email:') }}</h1>
                        <span class="font-mono">{{ __('breadland@bread.com') }}</span>
                    </div>
                    <div class="flex flex-row items-center">
                        <i class="fa-sharp fa-solid fa-location-dot mr-1"></i>
                        <h1 class="mr-1">{{ __('Адрес:') }}</h1>
                        <span class="font-mono">{{ __('428031, Россия, Чувашская Республика, г. Чебоксары, ул. 324 Стрелковой дивизии, д. 19А') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
