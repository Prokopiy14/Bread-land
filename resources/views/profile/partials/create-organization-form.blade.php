<section>
    <x-danger-button class="mt-5"
                     x-data=""
                     x-on:click.prevent="$dispatch('open-modal', 'organization-create')"
    >{{ __('Добавить организацию') }}</x-danger-button>


    <x-modal name="organization-create" :show="$errors->createOrganization->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('organization.store') }}" class="p-6">
            @csrf

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Добавление организации') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Как только ваша организация будет сохранена, она будет автоматически использоваться при оформалении заказов. Пожалуйста, перед сохранением своей организации проверьте корректность введенных данных.') }}
            </p>

            <div class="mt-6">
                <div>
                    <x-input-label for="title" :value="__('Наименование')" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" autofocus autocomplete="title" />
                    <x-input-error class="mt-2" :messages="$errors->createOrganization->get('title')" />
                </div>
                <div>
                    <x-input-label for="inn" :value="__('ИНН')" />
                    <x-text-input id="inn" name="inn" maxlength="10" type="text" class="mt-1 block w-full" :value="old('inn')" autocomplete="inn" />
                    <x-input-error class="mt-2" :messages="$errors->createOrganization->get('inn')" />
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Отмена') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Добавить организацию') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>

