<section>
    @foreach($orders as $order)
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mt-5">
            <div class="max-w-xl">
                <a href="{{ route('orders.show',$order->id) }}" class="text-2xl font-medium font-sans hover:underline">{{ __('Заказ №0000000').$order->id }}</a>
                <p class="text-sm text-blue-500 mt-1">{{ $order->created_at }}</p>
                <div class="flex flex-row items-center mt-1">
                    <span class="mr-1 font-medium">{{ __('Статус заказа:') }}</span>
                    <span class="text-green-500">{{ $order->status }}</span>
                </div>
            </div>
            <div class="flex justify-between text-md text-black font-semibold mt-5">
                <p>{{ 'Дата доставки: '.$order->delivered_at }}</p>
                <p>{{ 'Сумма: '.$order->total.' р' }}</p>
            </div>
        </div>
    @endforeach
</section>

