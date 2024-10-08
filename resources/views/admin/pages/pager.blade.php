@extends('admin.layouts.dashboard')

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
            <div class="flex justify-between items-center px-3 py-1 border-b-2">
                <span class="pr-2 text-[18px] uppercase font-bold">Pages</span>
                <div class="flex justify-center items-center gap-2">
                    <button class="py-2 px-4 rounded-md border bg-light font-medium uppercase flex justify-center items-center">
                        <i class="fa-solid fa-filter pr-1"></i>
                        <div class="px-1">FILTERS</div>
                    </button>
                    <!-- Search -->
                    <button class="py-1 px-2 rounded-md border bg-light text-xs font-medium">
                        <i class="fa-solid fa-arrows-rotate pr-1"></i>
                    </button>
                </div>
            </div>
            <div class="my-1 py-1 bg-right bg-white">
                <div class="p-4">
                    <form action="{{route('admin.changesLink_pages')}}" method="POST">
                        @csrf
                        <div class="font-bold mb-3">Slide Pages</div>
                        <input type="text" class="w-[100%] p-2 block bg-slate-300 my-1" name="slide-1" placeholder="Slide 1" value="{{ $arr[0]->path }}">
                        <input type="text" class="w-[100%] p-2 block bg-slate-300 my-1" name="slide-2" placeholder="Slide 2" value="{{ $arr[1]->path }}">
                        <input type="text" class="w-[100%] p-2 block bg-slate-300 my-1" name="slide-3" placeholder="Slide 3" value="{{ $arr[2]->path }}">
                        <div class="" style="display: flex; justify-content:right; gap: 10px; margin-top:10px">
                            <button type="submit" class="py-2 px-3 bg-black text-white rounded-md">Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="text-center py-4 font-semibold uppercase">AB-Project</div>
    </div>
    </div>
</body>
@endsection