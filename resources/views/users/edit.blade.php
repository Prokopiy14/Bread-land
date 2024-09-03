<x-app-layout>
    @section('page.title','Редактирование пользователя')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <header>
                        <div class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Редактирование пользователя ').$user->name }}
                            </h2>
                            <a href="{{ route('users') }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ __('Назад') }}</a>
                        </div>
                    </header>

                    <x-form action="{{ route('users.update',$user->id) }}" method="PUT" class="mt-6 space-y-3">
                        <x-input-label for="name" :value="__('Имя')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <label for="FormSelectRole" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Роль') }}</label>
                        <select id="FormSelectRole" name="role_id" class="block w-full p-2.5 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($roles as $role)
                                <option
                                    value="{{ $role->id }}"
                                    @if($user->hasRole($role->name))
                                        selected
                                    @endif>
                                    {{$role->name}}
                                </option>
                            @endforeach
                        </select>
                        <x-primary-button class="my-2">{{ __('Изменить') }}</x-primary-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


