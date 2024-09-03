<x-app-layout>
    @section('page.title','Добаление роли')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <header>
                        <div class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Добавление роли') }}
                            </h2>
                            <a href="{{ route('roles') }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ __('Назад') }}</a>
                        </div>

                    </header>
                    <x-form action="{{ route('roles.store') }}" method="POST" class="mt-6 space-y-3">
                        <x-input-label for="title" :value="__('Наименование')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        <x-input-error :messages="$errors->get('permissions.*')" class="mt-2" />
                        @foreach($permissions as $permission)
                            <div class="flex items-center mb-4">
                                <input
                                    id="CheckPermissions {{ $permission->id }}"
                                    type="checkbox" value="{{ $permission->id }}"
                                    value="{{ $permission->id }}"
                                    name="permissions[]"
                                    class="w-4 h-4 text-blue-600 rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"

                                >
                                <label
                                    for="CheckPermissions{{ $permission->id }}"
                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</label>
                            </div>
                        @endforeach

                        <x-primary-button class="my-2">{{ __('Добавить') }}</x-primary-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

