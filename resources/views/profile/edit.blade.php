<x-app-layout>
    @section('page.title','Профиль')
    @section('custom_js')
        <script src="{{ asset("js/phoneInput.js") }}"></script>
    @endsection

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-4">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab"
                data-tabs-toggle="#profileTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab"
                            data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">{{ __('Профиль') }}</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="deliveryAddressAndOrganization-tab"
                            data-tabs-target="#deliveryAddressAndOrganization" type="button" role="tab"
                            aria-controls="deliveryAddressAndOrganization"
                            aria-selected="{{ $errors->createAddress->isNotEmpty()
                            || $errors->updateAddress->isNotEmpty()
                            || session('status') === 'address-updated'
                            || session('status') === 'address-created'
                            || $errors->createOrganization->isNotEmpty()
                            || $errors->updateOrganization->isNotEmpty()
                            || session('status') === 'organization-updated'
                            || session('status') === 'organization-created' ? "true" : "false"}}">
                        {{ __('Адрес доставки') }}</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="orders-tab" data-tabs-target="#orders"
                            type="button" role="tab" aria-controls="orders"
                            aria-selected="{{ request('checkOrders') ? "true" : "false" }}">
                        {{ __('Исория заказов') }}</button>
                </li>
            </ul>
        </div>

        <div id="profileTabContent">
            <div class="space-y-6 py-6" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <div class="space-y-6 py-6" id="deliveryAddressAndOrganization" role="tabpanel"
                 aria-labelledby="deliveryAddressAndOrganization-tab">
                @if($address)
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-address-form')
                            @hasanyrole('Customer|Admin')
                            @if(!$organization)
                                @include('profile.partials.create-organization-form')
                            @else
                                @include('profile.partials.update-address-organization-form')
                            @endif
                            @endhasanyrole
                        </div>
                    </div>
                @else
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Данные получателя') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __("Добавте данные получателя или укажите организацию.") }}
                                </p>
                            </header>
                            @include('profile.partials.create-address-form')
                        </div>
                    </div>
                @endif
            </div>
            <div class="space-y-6 py-6" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                @if($orders)
                    <div class="max-w-xs">
                        <label for="FormSelectStatus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Статус заказа') }}</label>
                        <select id="FormSelectStatus" class="block w-full p-2.5 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="all">{{ __('Все') }}</option>
                            <option value="transit">{{ __('В пути') }}</option>
                            <option value="delivered">{{ __('Доставлен') }}</option>
                            <option value="canceled">{{ __('Отменен') }}</option>
                        </select>
                    </div>
                    @include('profile.partials.show-orders-form')
                @endif
            </div>
        </div>
    </div>
</x-app-layout>


