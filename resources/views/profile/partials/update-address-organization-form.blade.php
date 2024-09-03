<section>
    <header class="mt-5">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Организация') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Укажите данные организации или обновите их.") }}
        </p>
    </header>

    <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-gray-900" data-inactive-classes="text-gray-500">
        <h2 id="accordion-flush-heading-2">
            <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200" data-accordion-target="#accordion-flush-body-2" aria-expanded="{{ $errors->updateOrganization->isNotEmpty() || session('status') === 'organization-updated' ? "true" : "false" }}" aria-controls="accordion-flush-body-2">
                <span>{{ $organization->title }}</span>
                <svg data-accordion-icon class="w-6 h-6 rotate-360 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </h2>
        <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
            <form action="{{ route('organization.update') }}" method="POST" class="mt-6 space-y-6">
                @csrf
                @method('patch')

                <div>
                    <x-input-label for="title" :value="__('Наименование')" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $organization->title)" autofocus autocomplete="title" />
                    <x-input-error class="mt-2" :messages="$errors->updateOrganization->get('title')" />
                </div>
                <div>
                    <x-input-label for="inn" :value="__('ИНН')" />
                    <x-text-input id="inn" name="inn" maxlength="10" type="text" class="mt-1 block w-full" :value="old('inn', $organization->inn )" autocomplete="inn" />
                    <x-input-error class="mt-2" :messages="$errors->updateOrganization->get('inn')" />
                </div>


                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

                    @if (session('status') === 'organization-updated')
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


