<x-app-layout>
    @section('page.title','Права доступа')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Настройка прав доступа') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-2">
        <p class="text-gray-500 text-end">
            <a href="{{ route('roles.create') }}" class="inline-flex items-center font-medium text-blue-600 hover:underline">
                {{ __('Доавить новую роль') }}
                <svg aria-hidden="true" class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
        </p>
        <div class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('#') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Наименование') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Дата создания') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Дата обновления') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Действие') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $role->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $role->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $role->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $role->updated_at }}
                            </td>
                            <td class="flex items-center px-6 py-4 space-x-3">
                                <a href="{{ route('roles.edit',$role->id) }}" class="font-medium text-blue-600 hover:underline">{{ __('Изменить') }}</a>
                                <a href="{{ route('roles.destroy',$role->id) }}" class="font-medium text-red-600 hover:underline"                                    onclick="event.preventDefault();
                                    this.closest('form').submit();"
                                   x-data=""
                                   x-on:click.prevent="$dispatch('open-modal',
                                       'confirm-role-deletion{{ $role->id }}')">{{ __('Удалить') }}</a>

                                <x-modal name="confirm-role-deletion{{ $role->id }}">
                                    <form method="post" action="{{ route('roles.destroy',$role->id) }}" class="p-6">
                                        @csrf
                                        @method('delete')

                                        <h2 class="text-lg font-medium text-gray-900">
                                            {{ __('Вы уверены, что хотите удалить роль под №') }}{{ $role->id }}?
                                        </h2>

                                        <div class="mt-6 flex justify-end">
                                            <x-secondary-button x-on:click="$dispatch('close')">
                                                {{ __('Отмена') }}
                                            </x-secondary-button>

                                            <x-danger-button class="ml-3">
                                                {{ __('Удалить роль') }}
                                            </x-danger-button>
                                        </div>
                                    </form>
                                </x-modal>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

