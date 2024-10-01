@extends('layout.pages.detail_pd')
@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection <!-- Kế thừa từ Blade cha -->
@section('post')
<div class="text-center" style="color: white;">another products</div>
<div class="flex justify-center">
    <div class="grid grid-cols-4 gap-4 justify-between items-start w-full" style="width:auto">
        @foreach( $data as $product)
        <div class="card p-5 bg-white rounded-lg shadow-lg transform transition-all duration-300 hover:shadow-2xl hover:scale-105" style="width:280px;height: 410px;">
            @if( $product['img']==null || $product['img']=="" )
            <img src="https://i.imgur.com/WnpOhI9.jpeg" name="img" alt="img" class="w-full h-48 object-cover rounded-lg">
            @else
            <img src="{{  $product['img'] }}" name="img" alt="img" class="w-full h-48 object-cover rounded-lg">
            @endif
            <div class="card-body text-center p-4 text-black">
                <h5 class="card-name text-xl font-semibold mb-2" name="name">{{ $product['name']}}</h5>
                @if(is_numeric( $product['price']))
                <p class="card-price text-lg text-gray-500 mb-4" name="price">${{number_format( $product['price'], 2)}}</p>
                @else
                <p class="card-price text-lg text-gray-500 mb-4" name="price">Price not available</p>

                @endif
                @if( $product['img'] == "" && isset( $product['name']) && isset( $product['price']))
                <div class="flex justify-center gap-x-2 pt-3">
                    <button class="px-5 py-2 bg-black text-gray-300 font-semibold rounded-md text-[15px] hover:bg-gray-800 transition-colors duration-300">
                        Order Now
                    </button>
                </div>
                @else
                <div class="flex justify-center gap-x-2 pt-3">
                    <button onclick="window.location='{{ route('pages.detail',  ['name' =>  $product['name']]) }}'" class="px-5 py-2 bg-black text-white font-semibold rounded-md text-[15px] hover:bg-gray-800 transition-colors duration-300">
                        Order Now
                    </button>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection