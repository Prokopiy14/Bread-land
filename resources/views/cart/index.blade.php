<x-app-layout>
    @section('page.title','Корзина')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-3 mt-2">
            @if(empty($cartItemDtoList))
                <span class="font-semibold title-cart text-[36px]">{{ __('Ваша корзина пока пуста') }}</span>
                <p>
                    <span>{{ __('Выберите нужную Вам продукцию') }}</span>
                    <a class="hover:text-red-600 underline" href="{{ route('products') }}">{{ __('на странице продукции') }}</a>
                    <span>{{ __('и добавьте её в корзину.') }}</span>
                </p>
            @else
                <style>
                    @layer utilities {
                        input[type="number"]::-webkit-inner-spin-button,
                        input[type="number"]::-webkit-outer-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                    }
                </style>

                <script>
                    $(document).ready(function(){
                        $('.increase-quantity').click(function(event) {
                            event.preventDefault();
                            var cartId = $(this).data('cart-id');
                            $.ajax({
                                url: "{{ route('cart.increase') }}",
                                type: 'POST',
                                data: {
                                    cartId: cartId,
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    if (response.success) {
                                        // Увеличить значение на странице
                                        $('.cart-item[data-cart-id=' + cartId + ']').find('#quantity-input').val(response.quantity);
                                        $('#cart-cost').html(response.cartCost + ' р.');
                                        $('#total-quantity').html(response.totalQuantity + ' шт.');
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }
                            });
                        });

                        $('.decrease-quantity').click(function(event) {
                            event.preventDefault();
                            var cartId = $(this).data('cart-id');
                            $.ajax({
                                url: "{{ route('cart.decrease') }}",
                                type: 'POST',
                                data: {
                                    cartId: cartId,
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    if (response.success) {
                                        // Уменьшение значение на странице
                                        $('.cart-item[data-cart-id=' + cartId + ']').find('#quantity-input').val(response.quantity);
                                        $('#cart-cost').html(response.cartCost + ' р.');
                                        $('#total-quantity').html(response.totalQuantity + ' шт.');
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }
                            });
                        });

                        $('.remove-from-cart-btn').click(function() {
                            var productId = $(this).data('product-id');
                            $.ajax({
                                url: '/cart/destroy/'+productId,
                                type: 'POST',
                                data: {
                                    product_id: productId,
                                    _token: "{{ csrf_token() }}",
                                    _method: 'DELETE',
                                },
                                success: function(response) {
                                    if (response.success) {
                                        // Удаляем товар из корзины на странице
                                        $('#cart-item-' + productId).remove();
                                        // Обновляем количество товаров и сумму заказа в корзине на странице
                                        $('#cart-cost').html(response.cartCost + ' р.');
                                        $('#total-quantity').html(response.totalQuantity + ' шт.');
                                    }
                                }
                            });
                        });

                        $('#clear-cart-btn').click(function() {
                            $.ajax({
                                url: "{{ route('cart.clear') }}",
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(response) {
                                    if (response.success) {
                                        // Перезагружаем страницу
                                        location.reload();
                                    }
                                }
                            });
                        });

                        $('input[name="quantity"]').change(function(event) {
                            event.preventDefault();
                            var productId = $(this).data('product-id');
                            var quantity = $(this).val();
                            $.ajax({
                                url: "{{ route('cart.update') }}",
                                type: 'POST',
                                data: {
                                    product_id: productId,
                                    quantity: quantity,
                                    _token: "{{ csrf_token() }}",
                                    _method: 'PATCH',
                                },
                                success: function(response) {
                                    console.log(response.success);
                                    if (response.success) {
                                        // Обновляем количество товаров и сумму заказа в корзине на странице
                                        $('#cart-cost').html(response.cartCost + ' р.');
                                        $('#total-quantity').html(response.totalQuantity + ' шт.');
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log(textStatus, errorThrown);
                                }
                            });
                        });
                    });
                </script>

                <div class="container-title">
                    <h2 class="font-semibold text-3xl font-medium text-gray-900">
                        {{ __('Корзина') }}
                    </h2>
                </div>

                <div class="flex flex-row items-center">
                    <a href="{{ route('products') }}" class="flex font-semibold text-indigo-600 hover:text-indigo-700 text-sm mr-4">
                        <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                            <path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/>
                        </svg>
                        {{ __('Продолжить покупки') }}
                    </a>
                    <button class="text-[#999] hover:text-red-600" id="clear-cart-btn">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                        <span>{{ __('Очистить корзину') }}</span>
                    </button>
                </div>
                <div class="mx-auto justify-center px-6 md:flex md:space-x-6 xl:px-0">
                    <div class="rounded-lg md:w-2/3">
                        @foreach($cartItemDtoList as $productItem)
                            <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start" id="cart-item-{{ $productItem->getProduct('product')->id }}">
                                <img src="{{ $productItem->getProduct('product')->img }}" alt="product-image" class="w-full rounded-lg sm:w-40" />
                                <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                                    <div class="mt-5 sm:mt-0">
                                        <a href="{{ route('products.show',$productItem->getProduct('product')->id) }}" class="text-lg font-bold text-gray-900 hover:text-[#d60000]">
                                            <h2>{{ $productItem->getProduct('product')->title }}</h2>
                                        </a>
                                        <p class="mt-1 text-xs text-gray-700">{{ $productItem->getProduct('product')->description }}</p>
                                    </div>
                                    <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                        <div class="flex items-center border-gray-100 cart-item" data-cart-id="{{ $productItem->getProduct('product')->id }}">
                                            <button class="rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50 decrease-quantity" data-cart-id="{{ $productItem->getProduct('product')->id }}"> - </button>
                                            <input class="h-8 w-[3rem] border bg-white text-center text-xs outline-none appearance-none" name="quantity" id="quantity-input" data-product-id="{{ $productItem->getProduct('product')->id }}" type="number" value="{{ $productItem->getQuantity() }}" maxlength="1000"/>
                                            <button class="rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50 increase-quantity" data-cart-id="{{ $productItem->getProduct('product')->id }}"> + </button>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <p class="text-sm">{{ $productItem->getProduct('product')->price }}{{__(' р.')}}</p>
                                            <button class="remove-from-cart-btn" data-product-id="{{ $productItem->getProduct('product')->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Sub total -->
                    <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                        <h1 class="mb-5 text-center text-2xl font-bold">{{ __('Ваш заказ') }}</h1>
                        <div class="mb-2 flex justify-between">
                            <p class="text-gray-700">{{ __('Выбрано товаров') }}</p>
                            <p class="text-gray-700" id="total-quantity">{{ $totalQuantity }}{{ __(' шт.') }}</p>
                        </div>
                        <hr class="my-4" />
                        <div class="flex justify-between">
                            <p class="text-lg font-bold">{{ __('Общая стоимость:') }}</p>
                            <div class="">
                                <p class="mb-1 text-lg font-bold" id="cart-cost">{{ $cartCost }} {{ __('р.') }}</p>
                            </div>
                        </div>
                        <a href="{{ route('checkout') }}" class="mt-6 rounded-md bg-blue-500 py-1.5 flex text-center font-medium text-blue-50 hover:bg-blue-600">
                            <span class="w-full"> {{ __('Оформить заказ') }}</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
</x-app-layout>

