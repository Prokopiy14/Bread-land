<section>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-2">
        <div class="mt-6">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('#') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Заказчик') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Статус') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Дата создания') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Дата доставки') }}
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            @if(!$order->organization)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <a href="{{ route('orders.show',$order->id) }}" class="hover:underline">
                                            {{ $order->id }}
                                        </a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $order->customer }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $order->delivered_at }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
