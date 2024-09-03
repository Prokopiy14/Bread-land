<x-app-layout>
    @section('page.title','Список организаций')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список организаций') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-2">
        <div class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('#') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Адрес доставки') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Наименование') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('ИНН') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Дата создания') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Дата изменения') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($organizations as $organization)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $organization->id }}
                            </th>
                            <td class="px-6 py-4">
                                <a href="#" class="hover:underline">
                                    {{ \App\Models\Address::whereId($organization->address_id)->first()->address  }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                {{ $organization->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $organization->inn }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $organization->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $organization->updated_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
