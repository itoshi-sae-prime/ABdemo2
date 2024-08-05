@extends('layouts.dashboard')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')

<body class="bg-slate-300">
    <div class="mr-2 ml-3 mt-3 shadow-md">
        <div class="border-2 bg-white rounded-lg">
            <div class="text-[25px] py-2 font-semibold flex justify-center items-center">
                <div class="pr-1">Dữ liệu và thay đổi tới ngày</div>
                <div class="time-display">
                    <?php
                    // Tạo một đối tượng DateTime và thiết lập múi giờ
                    $dateTime = new DateTime('now', new DateTimeZone('UTC'));
                    // Định dạng thời gian để hiển thị
                    echo $dateTime->format('d-m-Y');
                    ?>
                </div>
            </div>
            <div class="bg-slate-100 text-center">
                <div class="">
                    <h2 class="text-center py-2 font-semibold text-[18px] uppercase">Những thông số trong việc thay đổi</h2>
                    <div class=" bg-white py-4 text-center font-semibold">
                        <h1 class="pb-2 text-[33px] font-[700]">21</h1>
                        <h3 class="font-bold text-zinc-400">Không thay đổi</h3>
                    </div>
                </div>
                <div class="">
                    <h2 class="text-center py-2 font-semibold text-[18px] uppercase">Những nhóm hết hàng</h2>
                    <div class=" bg-white py-4 flex justify-evenly items-center">
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-zinc-300">1</h1>
                            <h3 class="font-bold text-zinc-400">Không có cửa hàng</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-red-400">3</h1>
                            <h3 class="font-bold text-zinc-400">Hết hàng ở khắp mọi nơi</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-orange-400">6</h1>
                            <h3 class="font-bold text-zinc-400">Có sẵn cho ít hơn 50% các cửa hàng</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-yellow-400">3</h1>
                            <h3 class="font-bold text-zinc-400">Có mặt tại hơn 50% các cửa hàng</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-green-400">8</h1>
                            <h3 class="font-bold text-zinc-400">Có sẵn tại tất cả các cửa hàng</h3>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h2 class="text-center py-2 font-semibold text-[18px]">ĐẾM HÀNG BÁN PHÁ GIÁ VÀ HẾT HÀNG (TỔNG CỘNG)</h2>
                    <div class=" bg-white py-4 flex justify-evenly items-center">
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-red-400">75</h1>
                            <h3 class="font-bold text-zinc-400">Đếm số lượng bán phá giá (tổng cộng)</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-orange-400">20</h1>
                            <h3 class="font-bold text-zinc-400">Quầy hết hàng (tổng cộng)</h3>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h2 class="text-center py-2 font-semibold text-[18px]">BIẾN ĐỘNG</h2>
                    <div class=" bg-white py-4 flex justify-evenly items-center">
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-red-400">0</h1>
                            <h3 class="font-bold text-zinc-400">Chỉ số biến động giá</h3>
                            <h3 class="font-bold text-zinc-400">-0,85</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-pink-400">0</h1>
                            <h3 class="font-bold text-zinc-400">Chỉ số lực biến động giá</h3>
                            <h3 class="font-bold text-zinc-400">-0,85</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-green-400">0</h1>
                            <h3 class="font-bold text-zinc-400">Chỉ số biến động khả dụng</h3>
                            <h3 class="font-bold text-zinc-400">0</h3>
                        </div>
                    </div>
                </div>
                <div class="">
                    <h2 class="text-center py-2 font-semibold text-[18px]">GIÁ CẢ</h2>
                    <div class=" bg-white py-4 flex justify-evenly items-center">
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-red-500">321,47</h1>
                            <h3 class="font-bold text-zinc-400">Mức giá</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700]  text-yellow-500">270,07</h1>
                            <h3 class="font-bold text-zinc-400">Giá tối thiểu (trung bình)</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700]  text-green-500">288,67</h1>
                            <h3 class="font-bold text-zinc-400">Giá trung bình</h3>
                        </div>
                        <div class="">
                            <h1 class="pb-2 text-[33px] font-[700] text-pink-500">316,16</h1>
                            <h3 class="font-bold text-zinc-400">Giá tối đa (trung bình)</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center py-4 font-semibold uppercase bg-slate-100">AB-Project(Chưa có Cập Nhật Cụ Thể)</div>
        </div>
    </div>
</body>
@endsection

@section('scripts')
<script>

</script>
@endsection