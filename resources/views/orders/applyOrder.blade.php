<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-6">
        <div class="grid grid-cols gap-2 text-center">
            <span class="text-3xl text-cyan-600 font-bold">
                {{ __('Ваш заказ №'.request('orderId').' успешно сформирован!') }}
            </span>
            <div class="text-6xl text-green-500">
                <i class="fa-regular fa-circle-check"></i>
            </div>
            <div class="mt-5 mb-5">
                <a href="{{ route('orders.show',request('orderId')) }}" class="text-white bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">{{ __('Перейти к заказу') }}</a>
            </div>
        </div>
        <div class="translate-y-full text-center">
            <p>
                {{ ('Вы можете просматреть историю заказов в') }}
                <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:text-blue-800 underline">{{ __('Личном кабинете') }}</a>
                {{ __('открыв ') }}<a href="{{ route('profile.edit',['checkOrders' => true]) }}" class="text-blue-600 hover:text-blue-800 underline">{{ __('Историю заказов.') }}</a><br>
                {{ __('Если у ваc возникнут какие-либо вопросы, пожалуйста,') }} <a href="#" class="text-blue-600 hover:text-blue-800 underline">{{ __('свяжитесь с нами!') }}</a> <br>
                {{ __('Спасибо за покупку!') }}
            </p>
        </div>
    </div>
</x-app-layout>


