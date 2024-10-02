@extends('layout.index')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')
<div class="gap-x-4 text-white w-full flex justify-center pt-4 pb-8">
    <!-- <div class="relative z-50 lg:block hidden ">
        <ul class="grid gap-2 bg-white p-2 rounded-lg shadow-lg" style="max-width: 230px;left:25px">
            <li class="grid justify-center pb-[20px] border-b-2">
                <div class="breadcrumbs flex justify-center py-3">
                    <div class="text-black font-semibold px-3"><a href="">Home</a></div>
                    <p class="text-black">/</p>
                    <div class="text-black font-semibold px-3"><a href="">Shop</a></div>
                </div>
                <form method="GET" action="{{ route('all.search') }}">
                    <div class="fillter flex rounded-lg">
                        <input type="text" name='search' placeholder="Search" class="text-black bg-slate-200 p-2">
                        <button type="submit" class="py-2 px-3 bg-black border-2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </li>
            <li class="pt-[20px]">
                <div class="category-button font-bold text-[12px] border-2 text-black hover:text-white py-2 px-6 rounded-lg hover:bg-gray-800 transition-all duration-300 ease-in-out" data-value="all">All</div>
            </li>
            <li>
                <div class="category-button font-bold text-[12px] border-2 text-black hover:text-white py-2 px-6 rounded-lg hover:bg-gray-800 transition-all duration-300 ease-in-out" data-value="T-Shirt">T-Shirts</div>
            </li>
            <li>
                <div class="category-button font-bold text-[12px] border-2 text-black hover:text-white py-2 px-6 rounded-lg hover:bg-gray-800 transition-all duration-300 ease-in-out" data-value="Shirt">Shirts</div>
            </li>
            <li>
                <div class="category-button font-bold text-[12px] border-2 text-black hover:text-white py-2 px-6 rounded-lg hover:bg-gray-800 transition-all duration-300 ease-in-out" data-value="Pants">Pants</div>
            </li>
            <li class="pb-[20px]">
                <div class="category-button font-bold text-[12px] border-2 text-black hover:text-white py-2 px-6 rounded-lg hover:bg-gray-800 transition-all duration-300 ease-in-out" data-value="Short">Short</div>
            </li>
            <form id="categoryForm" method="GET" action="{{ route('all.search') }}" style="display: none;">
                <input type="hidden" id="categoryInput" name="category" value="">
            </form>
        </ul>
    </div> -->
    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 justify-between items-start w-full" style="width:auto">
        @foreach($data as $data)
        <div class="card p-5 bg-white rounded-lg shadow-lg transform transition-all duration-300 hover:shadow-2xl hover:scale-105" style="width:280px;height: 100%;">
            @if($data['img']==null || $data['img']=="" )
            <img src="https://i.imgur.com/WnpOhI9.jpeg" name="img" alt="img" class="w-full h-48 object-cover rounded-lg">
            @else
            <img src="{{ $data['img'] }}" name="img" alt="img" class="w-full h-48 object-cover rounded-lg">
            @endif
            <div class="card-body text-center p-4 text-black">
                <h5 class="card-name text-xl font-semibold mb-2" name="name">{{$data['name']}}</h5>
                @if(is_numeric($data['price']))
                <p class="card-price text-lg text-gray-500 mb-4" name="price">${{number_format($data['price'], 2)}}</p>
                @else
                <p class="card-price text-lg text-gray-500 mb-4" name="price">Price not available</p>

                @endif
                @if($data['img'] == "" && isset($data['name']) && isset($data['price']))
                <div class="flex justify-center gap-x-2 pt-3">
                    <button class="px-5 py-2 bg-black text-gray-300 font-semibold rounded-md text-[15px] hover:bg-gray-800 transition-colors duration-300">
                        Order Now
                    </button>
                </div>
                @else
                <div class="flex justify-center gap-x-2 pt-3">
                    <button onclick="window.location='{{ route('pages.detail',  ['name' => $data['name']]) }}'" class="px-5 py-2 bg-black text-white font-semibold rounded-md text-[15px] hover:bg-gray-800 transition-colors duration-300">
                        Order Now
                    </button>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    // Bắt sự kiện click cho tất cả các nút category-button
    document.querySelectorAll('.category-button').forEach(function(button) {
        button.addEventListener('click', function() {
            // Lấy giá trị từ thuộc tính data-value
            var categoryValue = this.getAttribute('data-value');

            // Gán giá trị vào input ẩn
            document.getElementById('categoryInput').value = categoryValue;

            // Submit form
            document.getElementById('categoryForm').submit();
        });
    });
</script>
@endsection