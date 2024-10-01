@extends('layout.index')

@section('title', 'Your Shopping Cart')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<div class="flex justify-center items-center">

    <div class="container p-5">
        <h2 class="text-2xl font-bold mb-6 text-white">Your Shopping Cart</h2>
        <!-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif -->
        <div class="flex flex-col lg:flex-row">
            <!-- Cart Items -->
            <div class="lg:w-3/4 w-full h-full">
                @php
                $cart = session()->get('cart', []);
                $total = 0;
                @endphp
                @if($cart && count($cart) > 0)
                @foreach($cart as $item)
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6" style="height: 180px;">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <img src="{{$item['img']}}" alt="Product Image" class="w-16 h-16 rounded-lg">
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                                <p class="text-gray-600">Price: {{ $item['price'] }}</p>
                                <p class="text-gray-600">Color: {{ $item['color'] }}</p>
                                <p class="text-gray-600">Size: {{ $item['size'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-x-3 border-2">
                            <button class="px-2 text-xl border-2 inline bg-slate-300" onclick="decreaseQuantity({{ $item['id'] }})">-</button>
                            <span id="quantity-{{ $item['id'] }}" class="text-sm font-medium text-gray-700">{{ $item['quantity'] }}</span>
                            <button class="px-2 text-xl border-2 inline bg-slate-300" onclick="increaseQuantity({{ $item['id'] }})">+</button>
                        </div>
                        <span class="text-lg font-semibold">${{ ($item['price'] ?? 0) * ($item['quantity'] ?? 1) }}</span>
                        <button onclick="window.location.href='{{ route('Deletetocart', ['id' => $item['id'], 'color' => $item['color'] ?? 'default-color', 'size' => $item['size'] ?? 'default-size']) }}'" class="text-red-500 hover:text-red-600 ml-4">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                    <hr class="border-gray-200">
                    @php
                    $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
                    @endphp
                </div>
                @endforeach
                @else
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-gray-600">Your cart is empty.</h1>
                    </div>
                    <hr class="border-gray-200">

                </div>
                @endif
            </div>
            <!-- Cart Summary -->
            <div class="lg:w-1/4 w-full lg:ml-6">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Cart Summary</h3>
                    <div class="flex justify-between text-lg font-medium mb-4">
                        <span>Total:</span>
                        <span>${{ $total }}</span>
                    </div>
                    @csrf
                    <button onclick="window.location='{{ route('checkout') }}'" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg shadow hover:bg-indigo-700">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
    76-[]
</div>
<script>
    function decreaseQuantity(itemId) {
        var quantityElement = document.getElementById('quantity-' + itemId);
        var currentQuantity = parseInt(quantityElement.innerText);

        if (currentQuantity > 1) { // Không cho phép số lượng nhỏ hơn 1
            currentQuantity--;
            quantityElement.innerText = currentQuantity;
            updateCart(itemId, currentQuantity);
        }
    }

    function increaseQuantity(itemId) {
        var quantityElement = document.getElementById('quantity-' + itemId);
        var currentQuantity = parseInt(quantityElement.innerText);

        currentQuantity++;
        quantityElement.innerText = currentQuantity;
        updateCart(itemId, currentQuantity);
    }
</script>
@endsection