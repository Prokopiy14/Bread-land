<x-app-layout>
    @section('page.title','Продукиция')
    @section('custom_css')
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    @endsection

    <script>
        $(document).ready(function(){
            $('.add-to-cart').click(function(event) {
                var button = $(this);
                var productId =  button.data('id');
                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: 'POST',
                    data: {
                        productId: productId,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        button.html('<i class="fas fa-shopping-cart"></i> В корзине'); // меняем название кнопки
                        button.addClass('go-to-cart');
                        button.data('url', "{{ route('cart') }}");
                        button.unbind('click');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });

            $(document).on('click', '.go-to-cart', function() {
                var url = $(this).data('url'); // получаем ссылку на страницу корзины
                window.location.href = url; // перенаправляем пользователя в корзину
            });
        });
    </script>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-6">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Продукция') }}
            </h2>
        </x-slot>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-thumb ">
                        <a href="{{ route('products.show',$product['id']) }}"><img src="{{ $product['img'] }}" alt=""></a>
                    </div>
                    <div class="product-details">
                        <h4><a href="{{ route('products.show',$product['id']) }}">{{ $product['title'] }}</a></h4>
                        <p>{{ $product['description'] }}</p>
                        <div class="product-bottom-details flex justify-between">
                            <div class="product-price">
                                {{ $product['price'] }} {{ __('руб.') }}
                            </div>
                            <div class="product-links">
                                <div class="flex justify-between">
                                    <div class="flex">
                                        @if(in_array($product['id'], $productIdInCartList))
                                            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5" onclick="location.href='{{ route('cart') }}'">
                                                <i class="fas fa-shopping-cart"></i>
                                                {{ __('В корзине') }}
                                            </button>
                                        @else
                                            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 add-to-cart" data-id="{{ $product['id'] }}">
                                                {{ __('В корзину') }}
                                            </button>
                                        @endif
                                    </div>
                                    <x-form action="{{ route('cart.add',$product) }}" method="POST">
                                        <a class="favorites" href="#"><i class="far fa-heart"></i></a>
                                    </x-form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
</x-app-layout>


