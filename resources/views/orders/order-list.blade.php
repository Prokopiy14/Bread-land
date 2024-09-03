<x-app-layout>
    @section('page.title','Список заказов')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Список заказов') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                data-tabs-toggle="#OrdersTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="organizations-tab"
                            data-tabs-target="#organizations" type="button" role="tab" aria-controls="organizations"
                            aria-selected="false">{{ __('Список заказов организаций') }}</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="users-tab"
                            data-tabs-target="#users" type="button" role="tab" aria-controls="users"
                            aria-selected="false">{{ __('Список заказов пользователей') }}</button>
                </li>
            </ul>
        </div>
    </div>

    <div class="space-y-6 pb-3" id="organizations" role="tabpanel" aria-labelledby="organizations-tab">
        @include('orders.partials.organizations')
    </div>
    <div class="space-y-6 pb-3" id="users" role="tabpanel" aria-labelledby="users-tab">
        @include('orders.partials.users')
    </div>
</x-app-layout>


