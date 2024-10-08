@extends('layout.index')

@section('title', 'Your Shopping Cart')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<div class="flex justify-center items-center py-5 lg:py-10">
    <div class="container p-5">
        <h2 class="text-2xl font-bold mb-6">Your Shopping Cart</h2>

        <!-- Thông báo -->
        <!-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif -->

        <!-- Bố cục giỏ hàng -->
        <div class="flex flex-col lg:flex-row">
            <!-- Sản phẩm trong giỏ hàng -->
            <div class="lg:w-3/4 w-full">
                @php
                $cart = session()->get('cart', []);
                $total = 0;
                @endphp
                @if($cart && count($cart) > 0)
                @foreach($cart as $item)
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <!-- Ảnh và thông tin sản phẩm -->
                        <div class="flex items-center">
                            <img src="{{$item['img']}}" alt="Product Image" class="w-16 h-16 rounded-lg">
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold">{{ $item['name'] }}</h3>
                                <p class="text-gray-600">Price: {{ $item['price'] }}</p>
                                <p class="text-gray-600">Color: {{ $item['color'] }}</p>
                                <p class="text-gray-600">Size: {{ $item['size'] }}</p>
                            </div>
                        </div>

                        <!-- Điều chỉnh số lượng -->
                        <div class="flex items-center gap-x-3 border-2">
                            <button class="px-2 text-xl border-2 bg-slate-300" onclick="decreaseQuantity({{ $item['id'] }})">-</button>
                            <span id="quantity-{{ $item['id'] }}" class="text-sm font-medium text-gray-700">{{ $item['quantity'] }}</span>
                            <button class="px-2 text-xl border-2 bg-slate-300" onclick="increaseQuantity({{ $item['id'] }})">+</button>
                        </div>

                        <!-- Tổng giá tiền cho sản phẩm -->
                        <span class="text-lg font-semibold">${{ ($item['price'] ?? 0) * ($item['quantity'] ?? 1) }}</span>

                        <!-- Nút xóa sản phẩm -->
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
                    <h1 class="text-gray-600">Your cart is empty.</h1>
                </div>
                @endif
            </div>

            <!-- Tóm tắt giỏ hàng -->
            <div class="lg:w-1/4 w-full lg:ml-6 mt-6 lg:mt-0">
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
</div>

<script>
    function decreaseQuantity(itemId) {
        var quantityElement = document.getElementById('quantity-' + itemId);
        var currentQuantity = parseInt(quantityElement.innerText);

        if (currentQuantity > 1) {
            currentQuantity--;
            quantityElement.innerText = currentQuantity;

        }
        console.log(itemId, currentQuantity);
        updateCart(itemId, currentQuantity);
    }

    function increaseQuantity(itemId) {
        var quantityElement = document.getElementById('quantity-' + itemId);
        var currentQuantity = parseInt(quantityElement.innerText);

        currentQuantity++;
        quantityElement.innerText = currentQuantity;
        console.log(itemId, currentQuantity);
        console.log(updateCart(itemId, currentQuantity));
    }

    function updateCart(itemId, quantity) {
        // Kiểm tra nếu số lượng là hợp lệ
        if (quantity < 0) {
            alert("Quantity cannot be less than 0.");
            return;
        }
        // Gửi yêu cầu AJAX để cập nhật giỏ hàng
        fetch(`/update-cart`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF protection in Laravel
                },
                body: JSON.stringify({
                    id: itemId, // ID of the item being updated
                    quantity: quantity // New quantity
                })
            })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                if (data.success) {
                    console.log(data); // Log the returned data for debugging
                    // Update the UI with the new quantity
                    document.getElementById(`quantity-${itemId}`).innerText = quantity;
                    console.log(quantity);
                } else {
                    alert('Failed to update the cart.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
@endsection