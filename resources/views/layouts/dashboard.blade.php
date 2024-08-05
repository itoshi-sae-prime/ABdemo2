<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title', 'Dashboard')</title>
    @yield('style-libraries')
</head>

<body class="font-inter"><!-- sidebar -->
    <div id='menu-dashboard' class="fixed left-0 top-0 w-56 h-[100vh] bg-black">
        <div class="rounded-lg">
            <div class="px-3">
                <img class="py-3 mr-2" itemprop="logo" src="//theme.hstatic.net/200000117693/1001219415/14/logo.png?v=1169" alt="AB BEAUTY WORLD" class="img-responsive logoimg ">
                <ul class="border-2 border-yellow-200 h-[100vh] mb-3 rounded-lg">
                    <li class="mb-1 mt-2">
                        <a href="{{ route('pages.home')}}" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class="fa-solid fa-gauge"></i><span class="pl-2">Home</span></a href=" #">
                    </li>
                    <li class="mb-1 mt-2">
                        <a href="{{ route('pages.dashboard')}}" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class=" fa-solid fa-gauge"></i><span class="pl-2">Dashboard</span></a href=" #">
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('pages.product')}}" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class=" fa-solid fa-bag-shopping"></i><span class="pl-2">Product</span></a href="#">
                    </li>
                    <li class="mb-1">
                        <!-- <a href="{{ route('pages.urls')}}" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class=" fa-solid fa-paperclip"></i><span class="pl-2">URLS</span></a href="#"> -->
                        <a href="#" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i><span class="pl-2">URLS</span></a href="#">
                    </li>
                    <li class="mb-1">
                        <a href="#" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i><span class="pl-2">Categories</span></a href="#">
                        <!-- <a href="{{ route('pages.categories')}}" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class="fa-solid fa-briefcase "></i><span class="pl-2">Categories</span></a href="#"> -->
                    </li>
                    <li class="mb-1">
                        <a href="#" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i></i><span class="pl-2">Brands</span></a href="#">
                    </li>
                    <li class="mb-1">
                        <a href="#" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i><span class="pl-2">Price Change</span></a href="#">
                    </li>
                    <li class="mb-1">
                        <a href="#" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i><span class="pl-2">Approval List</span></a href="#">
                    </li>
                    <li class="mb-1">
                        <a href="#" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i><span class="pl-2">Discount List</span></a href="#">
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('pages.setting')}}" class="text-slate-500 block px-4 py-2 font-semibold rounded-lg mr-1 hover:text-white hover:bg-slate-800"><i class="fa-solid fa-lock"></i><span class="pl-2">Setting</span></a href="#">
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <!-- <div id='header' class="top-0 w-[calc(100%-224px)] ml-[252px] h-12 bg-black p-2 " style="position: fixed;">
        <div class="text-white flex justify-between items-center h-full">
            <div class="flex justify-center items-center gap-x-2">
                <div class=" px-2 border-slate-500 rounded-md">
                    <button id='HideButton' onclick="">
                        <i class="fa-solid fa-arrow-left rounded-md"></i>
                    </button>

                </div>
                <div class="font-semibold">
                    Dashboard
                </div>
            </div>
            <div class="bg-slate-400 px-3 py-1 gap-x-3 rounded-md mx-6">
                <i class="fa-solid fa-user" style="color: black;"></i>
                <span class="text-black">User</span>
            </div>
        </div>
    </div> -->
    <div class="w-[calc(100%-246px)] h-[calc(100%-50px)] ml-[245px]" style="padding: 0px 0px 0px 0px">
        @yield('content')
    </div>
</body>
@yield('scripts')
<script>
    document.getElementById('Searchbutton').addEventListener('click', function() {
        const toggleSection = document.getElementById('toggleSection');
        if (toggleSection.style.display === 'none') {
            toggleSection.style.display = 'block';
        } else {
            toggleSection.style.display = 'none';
        }
    });
    document.getElementById('active').addEventListener('click', function() {
        const button = document.getElementById('active');
        if (button.classList.contains('off')) {
            button.classList.remove('off');
            button.classList.add('on');

        } else {
            button.classList.remove('on');
            button.classList.add('off');
        }
    });

    document.getElementById('HideButton').addEventListener('click', function() {
        const toggleSection = document.getElementById('menu-dashboard');
        const toggleSection2 = document.getElementById('header');
        if (toggleSection.style.display === 'none') {
            toggleSection.style.display = 'block';
        } else {
            toggleSection.style.display = 'none';
        }
    });
</script>

</html>