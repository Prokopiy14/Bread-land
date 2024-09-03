<x-app-layout>
@section('page.title','Просмотр заказа')
    <script>
        $(document).ready(function(){
            $('#confirmation-order').click(function(event) {
                event.preventDefault();
                var orderId = $(this).data('order-id');
                $.ajax({
                    url: "{{ route('change-status') }}",
                    type: 'POST',
                    data: {
                        orderId: orderId,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#confirmation-order').remove();
                            $('#order-status').html(response.status);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        });
    </script>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="text-2xl font-sans mt-8">{{ __('Заказ №').$order->id }}</div>
        <p class="text-sm text-blue-500 mt-1">{{ $order->created_at }}</p>
        @role('Admin')
            <div class="flex justify-end">
                <a href="{{ route('orders-list') }}" class="font-medium text-blue-600 underline hover:no-underline">{{ __('Назад') }}</a>
            </div>
        @endrole
        <div class="p-2 sm:p-4 bg-white shadow m-4 md:m-0 md:mt-4 sm:rounded-lg">
            <div class="max-w-xl">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="flex flex-row items-center mt-1">
                        <span class="mr-1 font-medium">{{ __('Заказчик:') }}</span>
                        <span>{{ $order->customer }}</span>
                    </div>
                    @if($organization || $order->organization_id)
                        <div class="flex flex-row items-center mt-1">
                            <span class="mr-1 font-medium">{{ __('Организация:') }}</span>
                            <span>{{ $order->organization }}</span>
                        </div>
                    @endif
                    <div class="flex flex-row items-center mt-1">
                        <span class="mr-1 font-medium">{{ __('Телефон:') }}</span>
                        <span>{{ $order->telephone }}</span>
                    </div>
                    <div class="flex flex-row items-center mt-1">
                        <span class="mr-1 font-medium">{{ __('Адрес:') }}</span>
                        <span>{{ $order->address }}</span>
                    </div>
                </div>
            </div>
            <div class="text-end font-bold text-red-700">{{ 'Итого: '.$order->total.' р' }}</div>
        </div>

        <div class="mx-auto justify-center px-6 md:flex md:space-x-6 xl:px-0">
            <div class="mt-6 md:w-1/4">
                <div class="text-md text-black font-semibold mt-5">
                    <div class="grid grid-cols-1 xl:grid-cols-2 flex">
                        <p>{{ 'Дата доставки: '}}</p>
                        <p>{{ $order->delivered_at }}</p>
                        <span class="mr-1 font-medium">{{ __('Статус заказа:') }}</span>
                        <span class="text-green-500" id="order-status">{{ $order->status }}</span>
                        @if($order->status != 'Доставлен')
                            <button type="button" class="px-3 py-2 mt-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300" id="confirmation-order" data-order-id="{{ $order->id }}">{{ __('Подтвердить') }}</button>
                        @endif
                    </div>
                </div>
            </div>


            <div class="rounded-lg md:w-3/4 mt-5">
                @foreach($orderCompositions as $productItem)
                    <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start" id="cart-item-{{ \App\Models\Product::whereId($productItem->product_id)->first()->id }}">
                        <img src="/{{ \App\Models\Product::whereId($productItem->product_id)->first()->img }}" alt="product-image" class="w-full rounded-lg sm:w-40" />
                        <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between md:max-w-sm">
                            <div class="mt-5 sm:mt-0">
                                <a href="{{ route('products.show',$productItem->product_id) }}" class="text-lg font-bold text-gray-900 hover:text-[#d60000]">
                                    <h2>{{ \App\Models\Product::whereId($productItem->product_id)->first()->title }}</h2>
                                </a>
                            </div>
                            <p class="text-sm">{{ \App\Models\Product::whereId($productItem->product_id)->first()->price }}{{__(' р.')}}</p>
                            <p class="text-sm">{{ $productItem->quantity.' шт.' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

