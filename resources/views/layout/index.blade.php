<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="font-inter bg-black flex flex-col min-h-screen">
    <!-- Header -->
    <div class="flex justify-between items-center p-5 bg-white fixed top-0 w-full" style="z-index: 99;">
        <div class="font-bold text-4xl tracking-[3px]">
            LUNGTUNGstudio
        </div>
        <ul class="flex mt-2" style=" column-gap: 1.5rem">
            <li class="text-md font-bold uppercase flex items-baseline"><a class="tracking-[3px]" href="{{route('pages.home')}}">Home</a></li>
            <li class="text-md font-bold uppercase"><a class="tracking-[3px]" href="{{route('all.search')}}">Shop</a></li>
            <!-- <li class="text-md font-bold uppercase "><a class="tracking-[3px]" href="{{route('pages.kid')}}">Collection</a></li>
            <li class="text-md font-bold uppercase flex items-stretch"><a class="tracking-[3px]" href="{{route('pages.contact')}}">Contact</a></li> -->
        </ul>
        <div class="flex gap-x-2 text-lg font-semibold">
            <div class="text-lg font-bold uppercase">
                <a href="{{route('pages.cart')}}"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <div class=" bg-red-500 left-[5px] top-[-22px] py-[1px] px-[15px] text-[12px] text-white">0</div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow mt-[80px] mb-[50px]">
        @yield('content')
    </div>

    <!-- Footer -->
    <!-- <div class="footer mt-[50px]">
        <div class="text-center p-2 bg-white w-full font-semibold">Copyright © 2024 LungTung. Powered by Kin</div>
    </div> -->
</body>

<script>
</script>

</html>