<x-app-layout>
    @section('page.title','Оформление заказа')
    @section('custom_js')
        <script src="{{ asset("js/phoneInput.js") }}"></script>
    @endsection
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-6">
        <a href="{{ route('cart') }}" class="flex font-semibold text-indigo-600 hover:text-indigo-700 text-sm mt-5">
            <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
            </svg>
            {{ __('Вернуться к корзине') }}
        </a>

        <h2 class="text-4xl font-medium text-gray-900">
            {{ __('Оформление заказа') }}
        </h2>
        <x-form action="{{ route('orders.store') }}" method="POST">
            <div class="mx-auto justify-center px-6 md:flex md:space-x-6 xl:px-0">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg rounded-lg md:w-2/3">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Укажите данные получателя заказа') }}
                    </h2>
                    <div class="max-w-xl">
                        <div class="grid gap-6 mb-6 md:grid-cols-2 mt-6">
                            <div>
                                <x-input-label for="title" :value="__('Имя')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $address ? $address->title : null )" autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->createOrder->get('title')" />
                            </div>
                            <div>
                                <x-input-label for="telephone" :value="__('Телефон')" />
                                <x-text-input id="telephone" data-tel-input name="telephone" maxlength="18" type="tel" class="mt-1 block w-full" :value="old('telephone', $address ? $address->telephone : null)" autocomplete="telephone" />
                                <x-input-error class="mt-2" :messages="$errors->createOrder->get('telephone')" />
                            </div>
                            <div>
                                <x-input-label for="address" :value="__('Адрес')" />
                                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $address ? $address->address : null)" autocomplete="address" />
                                <x-input-error class="mt-2" :messages="$errors->createOrder->get('address')" />
                            </div>
                            <div>
                                <x-input-label for="date" :value="__('Дата доставки')" />
                                <x-text-input datepicker datepicker-orientation="bottom" datepicker-format="yyyy-mm-dd" placeholder="{{ __('Выберете дату доставки') }}" id="date" name="date" min="{{ now() }}" type="text" class="mt-1 block w-full" :value="old('date')" autocomplete="date"/>
                                <x-input-error class="mt-2" :messages="$errors->createOrder->get('date')" />
                            </div>
                            @hasanyrole('Customer|Admin')
                                <div>
                                    <x-input-label for="organization" :value="__('Организация')" />
                                    <x-text-input id="organization" name="organization" type="text" class="mt-1 block w-full" :value="old('organization', $organization ? $organization->title : null)"/>
                                    <x-input-error class="mt-2" :messages="$errors->createOrder->get('organization')" />
                                </div>
                            @endhasanyrole
                        </div>
                    </div>
                </div>
                <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                    <h1 class="mb-3 text-left text-2xl font-bold">{{ __('Корзина') }}</h1>
                    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-gray-900" data-inactive-classes="text-gray-500">
                        <h2 id="accordion-flush-heading-1">
                            <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200" data-accordion-target="#accordion-flush-body-1" aria-expanded="{{ $errors->updateAddress->isNotEmpty() || session('status') === 'address-updated' ? "true" : "false" }}" aria-controls="accordion-flush-body-1">
                                <span>{{ count($cartItemDtoList) == 1 ? count($cartItemDtoList).' позиция в заказе' : count($cartItemDtoList).' позиции в заказе' }}</span>
                                <svg data-accordion-icon class="w-6 h-6 rotate-360 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </h2>
                        <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                            @foreach($cartItemDtoList as $productItem)
                                <p class="mb-2 text-gray-500">{{ $productItem->getProduct('product')->title }}</p>
                                <p class="mb-2 text-gray-500 text-sm">{{ $productItem->getProduct('product')->price.' р - '.$productItem->getQuantity().' шт' }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex justify-between mt-5">
                        <p class="text-lg font-bold">{{ __('Итого') }}</p>
                        <div class="">
                            <p class="mb-1 text-lg font-bold" id="cart-cost">{{ $cartCost }} {{ __('р.') }}</p>
                        </div>
                    </div>
                    <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">{{ __('Оформить заказ') }}</button>
                </div>
            </div>
        </x-form>
    </div>
</x-app-layout>


