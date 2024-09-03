<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Мой адрес') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Укажите данные получателя заказа или обновите их.") }}
        </p>
    </header>

    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-gray-900" data-inactive-classes="text-gray-500">
        <h2 id="accordion-flush-heading-1">
            <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200" data-accordion-target="#accordion-flush-body-1" aria-expanded="{{ $errors->updateAddress->isNotEmpty() || session('status') === 'address-updated' ? "true" : "false" }}" aria-controls="accordion-flush-body-1">
                <span>{{ $address->address }}</span>
                <svg data-accordion-icon class="w-6 h-6 rotate-360 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </h2>
        <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
            <form action="{{ route('address.update') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="title" :value="__('Имя')" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('first_name', $address->title)" autofocus autocomplete="title" />
                    <x-input-error class="mt-2" :messages="$errors->updateAddress->get('title')" />
                </div>
                <div>
                    <x-input-label for="telephone" :value="__('Номер телефона')" />
                    <x-text-input id="telephone" data-tel-input name="telephone" maxlength="18" type="tel" class="mt-1 block w-full" :value="old('telephone', $address->telephone )" autocomplete="telephone" />
                    <x-input-error class="mt-2" :messages="$errors->updateAddress->get('telephone')" />
                </div>
                <div>
                    <x-input-label for="address" :value="__('Адрес')" />
                    <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $address->address)" autocomplete="address" />
                    <x-input-error class="mt-2" :messages="$errors->updateAddress->get('address')" />
                </div>


                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

                    @if (session('status') === 'address-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600"
                        >{{ __('Сохранено.') }}</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

