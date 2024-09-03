<x-app-layout>
    @section('page.title','Добаление нормы продукции')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    <header>
                        <div class="flex justify-between">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Добаление нормы продукции') }}
                            </h2>
                            <a href="{{ route('product-norms') }}" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">{{ __('Назад') }}</a>
                        </div>

                    </header>
                    <x-form action="{{ route('product-norms.store') }}" method="POST" class="mt-6 space-y-3">
                        <label for="FormSelectProduct" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Продукция') }}</label>
                        <select id="FormSelectProduct" name="product_id" class="block w-full p-2.5 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">
                                    {{$product->title}}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('product_id')" class="mt-2" />

                        <label for="FormSelectEquipment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Оборудование') }}</label>
                        <select id="FormSelectEquipment" name="equipment_id" class="block w-full p-2.5 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @foreach($equipments as $equipment)
                                <option value="{{ $equipment->id }}">
                                    {{$equipment->title}}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('equipment_id')" class="mt-2" />

                        <x-input-label for="norm" :value="__('Норма')" />
                        <x-text-input id="norm" class="block mt-1 w-full" type="text" name="norm" :value="old('norm')" />
                        <x-input-error :messages="$errors->get('norm')" class="mt-2" />

                        <x-primary-button class="my-2">{{ __('Добавить') }}</x-primary-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
