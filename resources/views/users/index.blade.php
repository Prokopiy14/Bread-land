<x-app-layout>
    @section('page.title','Пользователи')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Пользователи') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                            {{ __('Роль') }}
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
                    @foreach($users as $user)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $user->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4">
                                @foreach($user->roles as $role)
                                    {{ $role['name'] }}
                                @endforeach
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->updated_at }}
                            </td>
                            <td class="flex items-center px-6 py-4 space-x-3">
                                <a href="{{ route('users.edit',$user->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">{{ __('Изменить') }}</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if($users->hasPages())
                    <div class="px-3 my-3">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>


