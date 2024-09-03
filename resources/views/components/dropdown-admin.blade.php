<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button class="inline-flex items-center pl-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
            {{ 'Администрирование' }}

            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>
    </x-slot>

    <x-slot name="content">
        <x-dropdown-link :href="route('products.list')">
            {{ __('Продукция') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('equipments')">
            {{ __('Оборудование') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('product-norms')">
            {{ __('Нормы продукции') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('organization')">
            {{ __('Организации') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('users')">
            {{ __('Пользователи') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('roles')">
            {{ __('Настройка прав доступа') }}
        </x-dropdown-link>
        <x-dropdown-link :href="route('orders-list')">
            {{ __('Список заказов') }}
        </x-dropdown-link>
    </x-slot>
</x-dropdown>
