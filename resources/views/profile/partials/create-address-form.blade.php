<section>
    <x-danger-button class="mt-5"
                     x-data=""
                     x-on:click.prevent="$dispatch('open-modal', 'delivery-address-create')"
    >{{ __('Добавить адрес доставки') }}</x-danger-button>


    <x-modal name="delivery-address-create" :show="$errors->createAddress->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('address.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Добвление адреса доставки') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Как только ваш адрес будет сохранен, он будет автоматически использоваться при оформалении заказов. Пожалуйста, перед сохранением своего адреса проверьте корректность введенных данных.') }}
            </p>

            <div class="mt-6">
                <div>
                    <x-input-label for="title" :value="__('Имя')" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" autofocus autocomplete="title" />
                    <x-input-error class="mt-2" :messages="$errors->createAddress->get('title')" />
                </div>
                <div>
                    <x-input-label for="telephone" :value="__('Номер телефона')" />
                    <x-text-input id="telephone" data-tel-input name="telephone" maxlength="18" type="tel" class="mt-1 block w-full" :value="old('telephone')" autocomplete="telephone" />
                    <x-input-error class="mt-2" :messages="$errors->createAddress->get('telephone')" />
                </div>
                <div>
                    <x-input-label for="address" :value="__('Адрес')" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" autocomplete="address" />
                    <x-input-error class="mt-2" :messages="$errors->createAddress->get('address')" />
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Отмена') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Добавить адрес') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

