<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="font-inter bg-white max-h-[90vh] h-auto">
    <!-- Header -->
    <div class="flex justify-between items-center p-5 bg-white" style="z-index: 99;">
        <!-- Phần Menu Mobile -->
        <div class="block md:hidden">
            <ul class="flex mt-2" style="column-gap: 1.5rem">
                <li class="text-md font-bold uppercase flex items-baseline">
                    <a class="tracking-[3px]" href="{{route('pages.home')}}">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Logo trung tâm -->
        <div class="font-bold text-4xl sm:text-2xl tracking-[3px]">
            <a class="tracking-[3px]" href="{{route('pages.home')}}">
                LUNGTUNGstudio
            </a>
        </div>

        <!-- Menu chính (ẩn trên mobile, hiện trên các màn hình lớn hơn) -->
        <div class="hidden md:flex lg:block">
            <ul class="flex mt-2" style="column-gap: 1.5rem">
                <li class="text-md font-bold uppercase flex items-baseline">
                    <a class="tracking-[3px]" href="{{route('pages.home')}}">Home</a>
                </li>
                <li class="text-md font-bold uppercase">
                    <a class="tracking-[3px]" href="{{route('all.search')}}">Shop</a>
                </li>
                <li class="text-md font-bold uppercase">
                    <a class="tracking-[3px]" href="{{route('pages.kid')}}">Collection</a>
                </li>
                <li class="text-md font-bold uppercase flex items-stretch">
                    <a class="tracking-[3px]" href="{{route('pages.contact')}}">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Giỏ hàng -->
        <div class="flex gap-x-1 text-lg font-semibold items-center">
            <div class="text-lg font-bold uppercase">
                <a href="{{route('pages.cart')}}">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
            <div class="bg-red-500 rounded-full py-[1px] px-2 text-[12px] text-white relative -top-[10px] left-[5px]">
                0
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-slate-100">
        @yield('content')
    </div>
    <!-- Footer -->
    <div class="footer bottom-0 bg-slate-300 block">
        <div class="flex justify-between px-10 py-10">
            <div class="">
                <div class="font-bold pb-2">Subscribe to our emails</div>
                <div class="flex justify-center items-center gap-4 my-[0px]">
                    <div class="flex items-center border-2 border-black py-1 focus-within:border-black focus:bg-black">
                        <input
                            style="width:300px"
                            type="email"
                            placeholder="Enter your Gmail"
                            class="appearance-none bg-black bg-transparent border-none p-2 w-[50%] text-black placeholder-black leading-tight focus:outline-none focus:ring-0 focus:text-black" />
                    </div>
                </div>
            </div>
            <div class="">
                <div class="flex">
                    <div class="p-5"><i class="fa-brands fa-square-facebook size-5"></i></div>
                    <div class="p-5"><i class="fa-brands fa-square-instagram"></i></div>
                </div>
            </div>
        </div>
        <div class="py-5 pl-10 font-semibold border-t-2 border-black">Copyright © 2024 LungTung. Powered by Kin</div>
    </div>
</body>

<script>
</script>

</html>