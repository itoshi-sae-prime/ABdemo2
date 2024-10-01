@extends('layout.index')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')
<div class="text-white w-[100vw]">
    <!-- slider -->
    <div class="slide relative w-full" style="width: 100vw;height: 500px;">
        <div class="list flex w-[100vw]">
            @foreach($data as $product)
            <div class="item">
                <img class="w-[100vw] max-w-[100vw] h-[500px] object-cover" src="{{ $product->path }}" alt="Image">
            </div>
            @endforeach
            <!-- <div class="item">
                <img class="w-[100vw] max-w-[100vw] h-[500px] object-cover" src="https://i.imgur.com/PQw4isN.jpeg" alt="Image">
            </div>
            <div class="item">
                <img class="w-[100vw] max-w-[100vw] h-[500px] object-cover" src="https://scontent.fsgn5-15.fna.fbcdn.net/v/t39.30808-6/441939094_427750033534532_3452041193340819553_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=127cfc&_nc_ohc=XJ14WELkAIYQ7kNvgG-EHX9&_nc_ht=scontent.fsgn5-15.fna&_nc_gid=AcLU0_7IzvZ0k1IoeYHWtcT&oh=00_AYCwm3RI9j58hzRNOtdqhUyaRV-yuAGDDom4e-JTZU2Rgg&oe=66FA8F25" alt="Image">
            </div> -->
        </div>
    </div>
    <div class="button flex justify-between items-center absolute w-full" style="top:50%">
        <div id="prev" onclick="prev()" class="prev-button py-3 px-4 inline rounded-[25px]">
            <i class="fa-solid fa-angle-left"></i>
        </div>
        <div id="next" onclick="next()" class="next-button py-3 px-4 inline rounded-[25px]">
            <i class="fa-solid fa-angle-right"></i>
        </div>
    </div>
    <!-- post -->
    <div class="grid justify-center">
        <div class="my-[10px] text-center text-[20px] uppercase font-bold text-gray-500">"trendy" or "obsolete" in your life ... </div>
        <div class="mb-[10px] flex justify-center" style="padding: 0px 35px;">
            <p class="text-base leading-6 text-[15px] font-semibold text-center">Lightness in fashion often happens when we feel we cannot keep up with the constant changes of the times. Every season, every year, fashion changes with many new trends. Styles, colors and accessories are constantly being innovated, making many people feel pressured to always be "new" and "trendy". It is this change that makes us sometimes not know what to choose so as not to become "out of time" or "not in trend".</p>
        </div>
        <div class="flex justify-center items-center gap-4 my-[0px]">
            <div class="flex items-center border-b border-gray-400 py-2 focus-within:border-blue-500">
                <input
                    style="width:300px"
                    type="email"
                    placeholder="Enter your Gmail"
                    class="appearance-none bg-white bg-transparent border-none p-2 w-[50%] text-gray-700 placeholder-gray-400 leading-tight focus:outline-none focus:ring-0 focus:text-blue-600" />
            </div>
        </div>
    </div>
</div>
<script>
    let slide = document.querySelector('.slide .list');
    let items = document.querySelectorAll('.slide .list .item'); // Chọn tất cả các items
    let prev = document.getElementById('prev');
    let next = document.getElementById('next');
    let active = 0;
    let lengthItems = items.length; // Số lượng items
    let refreshSlider = setInterval(() => {
        next.click()
    }, 3000);
    next.onclick = function() {
        if (active + 1 >= lengthItems) {
            active = 0; // Quay về slide đầu tiên nếu vượt quá
        } else {
            active = active + 1;
        }
        reloadSlider();
        clearInterval(refreshSlider);
        refreshSlider = setInterval(() => {
            next.click()
        }, 3000);
    }

    prev.onclick = function() {
        if (active - 1 < 0) {
            active = lengthItems - 1; // Quay về slide cuối cùng nếu lùi quá
        } else {
            active = active - 1;
        }
        reloadSlider();
    }

    function reloadSlider() {
        let checkLeft = items[active].offsetLeft;
        slide.style.left = -checkLeft + 'px'; // Di chuyển danh sách sang vị trí của slide hiện tại
    }
</script>
@endsection