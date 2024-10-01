@extends('layout.index')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')
<div class="text-black">
    <div class="flex justify-center items-center bg-white  mx-[100px]">
        <!-- Product Image -->
        <div class="md:w-1/2 flex justify-center bg-white">
            <img src="{{ $data[0]['img'] }}" alt="{{ $data[0]['name'] }}" class="w-full max-w-md rounded-lg">
        </div>
        <!-- Product Information -->
        <div class="md:w-1/3 p-[1.5rem] inline relative bg-slate-200">
            <h1 class="text-2xl font-bold mb-3 uppercase">{{ $data[0]['name'] }}</h1>
            <p class="text-xl font-semibold mb-3"><strong>Price:</strong> {{ $data[0]['price'] }}<small>đ</small></p>
            <div class="w-[400px] mb-3 font-semibold">This premium leather travel bag is perfect for your next adventure. Crafted from high-quality leather, it's both durable and stylish. With multiple compartments and a spacious interior, it's designed to keep your belongings organized and secure.</div>
            <div class="flex justify-start items-center mb-5 space-x-3">
                <p class="text-xl font-semibold"><strong>Color:</strong></p>
                @foreach($data[0]['color'] as $color)
                <label class="w-8 h-8 rounded-full">
                    <input type="radio" name="color" value="{{ $color }}" class="hidden peer">
                    <div class="w-8 h-8 rounded-full bg-{{ $color }} border-2 border-black cursor-pointer peer-checked:border-white hover:shadow-lg transition-all duration-300 ease-in-out transform hover:scale-110"></div>
                </label>
                @endforeach
            </div>
            <div class="flex justify-start items-center mb-5 space-x-3">
                <p class="text-xl font-semibold"><strong>Size:</strong></p>
                @foreach($data[0]['size'] as $size)
                <label class="mx-2">
                    <input type="radio" name="size" value="{{ $size }}" class="hidden peer">
                    <div class="text-center px-5 py-1 font-bold rounded-md border-2 border-gray-300 bg-white cursor-pointer hover:bg-gray-800 hover:text-white transition-all duration-300 ease-in-out transform hover:scale-110 peer-checked:bg-gray-300 peer-checked:border-gray-500">
                        {{$size}}
                    </div>
                </label>
                @endforeach
            </div>
            <div class="flex items-center mb-5">
                <p class="text-xl font-semibold"><strong>Quantity:</strong> </p>
                <input type="number" name="quantity" value="{{ $data[0]['quantity'] }}" class="ml-2 w-12 border rounded text-center focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="flex mb-5">
                <p class="font-bold">Need help choosing a size?</p>
                <div class="px-2 text-blue-500 font-semibold">Size Guide</div>
            </div>
            <div class="flex justify-start gap-x-3 items-center mb-5">
                <form action="{{ route('Addtocart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="img" value="{{ $data[0]['img'] }}">
                    <input type="hidden" name="product_id" value="{{ $data[0]['id'] }}">
                    <input type="hidden" name="name" value="{{ $data[0]['name'] }}">
                    <input type="hidden" name="price" value="{{ $data[0]['price'] }}">
                    <input type="hidden" id="selectedColor" name="color" value="{{ $data[0]['color'][0] }}">
                    <input type="hidden" id="selectedSize" name="size" value="$data[0]['size'][0]">
                    <input type="hidden" name="quantity" value="{{ $data[0]['quantity'] }}">
                    <input type="hidden" name="action" value="buy">
                    <button type="submit" class="px-5 py-2 bg-black text-white font-semibold rounded-md text-[15px]">
                        Buy Now
                    </button>
                </form>
                <form action="{{ route('Addtocart') }}" method="POST">
                    @csrf
                    <input type="hidden" name="img" value="{{ $data[0]['img'] }}">
                    <input type="hidden" name="product_id" value="{{ $data[0]['id'] }}">
                    <input type="hidden" name="name" value="{{ $data[0]['name'] }}">
                    <input type="hidden" name="price" value="{{ $data[0]['price'] }}">
                    <input type="hidden" id="selectedColor" name="color" value="{{ $data[0]['color'][0] }}">
                    <input type="hidden" id="selectedSize" name="size" value="{{ $data[0]['size'][0] }}">
                    <input type="hidden" name="quantity" value="{{ $data[0]['quantity'] }}">
                    <input type="hidden" name="action" value="add">
                    <button type="submit" class="px-5 py-2 bg-gray-300 text-black font-semibold rounded-md text-[15px]">
                        Add to Cart
                    </button>
                </form>
            </div>
            <!-- <div class="absolute h-[100vh] bg-white w-[250px] right-0 top-0"></div> -->
        </div>
    </div>
    <div class="bg-white p-4 w-full my-2"></div>
    <div class="py-20 flex justify-center gap-x-4 p-10">
        @foreach($data[0]['gallary'] as $gallary)
        <img src="{{ $gallary }}" alt="{{ $data[0]['name'] }}" class="w-full max-w-md rounded-lg object-cover">
        @endforeach
    </div>
    <div class="">
        @yield('post')

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to check if a color is selected
        function isColorSelected() {
            return document.querySelector('input[name="color"]:checked') !== null;
        }

        // Function to check if at least one size is selected
        function isSizeSelected() {
            return document.querySelector('input[name="size"]:checked') !== null;
        }

        // Add event listeners to update hidden input values for color
        document.querySelectorAll('input[name="color"]').forEach(function(input) {
            input.addEventListener('change', function() {
                document.getElementById('selectedColor').value = this.value;
                console.log(this.value);
            });
        });

        // Add event listeners to update hidden input values for size
        document.querySelectorAll('input[name="size"]').forEach(function(input) {
            input.addEventListener('change', function() {
                document.getElementById('selectedSize').value = this.value;
                console.log(this.value); // Fixed here // Log the selected size
            });
        });

        // Add validation on form submission
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!isColorSelected()) {
                    alert('Please select a color.');
                    event.preventDefault();
                    return;
                }

                if (!isSizeSelected()) {
                    alert('Please select at least one size.');
                    event.preventDefault();
                    return;
                }
            });
        });
    });
</script>
@endsection