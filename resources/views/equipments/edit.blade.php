<x-app-layout>
    @section('page.title','Редактирование прав доступа')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <header>
                        <div class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Редактирование роли ').$equipment->name }}
                            </h2>
                            <a href="{{ route('equipments') }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ __('Назад') }}</a>
                        </div>

                    </header>
                    <x-form action="{{ route('equipments.update',$equipment->id) }}" method="PUT" class="mt-6 space-y-3">
                        <x-input-label for="title" :value="__('Наименование')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$equipment->title" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        <x-input-label for="description" :value="__('Описание')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$equipment->description" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />

                        <x-primary-button class="my-2">{{ __('Сохранить') }}</x-primary-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

