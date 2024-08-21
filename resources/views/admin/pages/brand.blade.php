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
            <div class="flex justify-between items-center px-3 py-1 border-b-2">
                <span class="pr-2 text-[18px] uppercase font-bold">Brand</span>
                <div class="flex justify-center items-center gap-2">
                    <button class="py-2 px-4 rounded-md border bg-light font-medium uppercase flex justify-center items-center">
                        <i class="fa-solid fa-filter pr-1"></i>
                        <div class="px-1">FILTERS</div>
                    </button>
                    <!-- Search -->
                    <div class="border-2 rounded-md">
                        <!-- <form class="flex" action="{{ route('pages.product') }}" method="GET">
                            <input class="p-2 w-96 rounded-md input-search-ajax" type="text" name="query" placeholder="Search for products...">
                            <button class="py-2 px-4 bg-light font-medium uppercase flex justify-center items-center" style="outline:none" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form> -->
                        <form class="flex" action="{{ route('pages.product') }}" method="GET" id="searchForm">
                            <input class="p-2 w-72 rounded-md input-search-ajax" id="searchQuery" name="search" placeholder="Search for products...">
                            <button class="py-2 px-4 bg-light font-medium uppercase flex justify-center items-center" style="outline:none" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                    <button class="py-2 px-4 rounded-md border bg-light font-medium">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="py-2 px-4 rounded-md border bg-light font-medium">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    <button class="py-2 px-2 rounded-md border bg-light text-xs font-medium">
                        <i class="fa-solid fa-file-export pr-1"></i>Export
                    </button>
                    <button class="py-2 px-2 rounded-md border bg-light text-xs font-medium">
                        <i class="fa-solid fa-file-import pr-1"></i>Import
                    </button>
                    <a href="{{ route('create') }}">
                        <button class="py-2 px-2 rounded-md border text-xs font-medium bg-blue-500 text-white">
                            <i class="fa-solid fa-plus pr-1"></i>Create
                        </button>
                    </a>
                    <div>
                        <select name="values" class="py-1 px-2 rounded-md border bg-light text-xs font-medium">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                        </select>
                    </div>
                    <button class="py-1 px-2 rounded-md border bg-light text-xs font-medium">
                        <i class="fa-solid fa-arrows-rotate pr-1"></i>
                    </button>
                </div>
            </div>
            <div class="my-1 py-1 bg-right bg-white">
            </div>
            <table class="table-auto w-full">
                <thead class="py-5 border-b-2">
                    <tr class="my-5 bg-black">
                        <th class="text-yellow-500 text-[15px] w-[15%] p-4">Name</th>
                        <th class="text-yellow-500 text-[15px] text-center">Thumbnail</th>
                        <th class="text-yellow-500 text-[15px] text-center">Website URL</th>
                        <th class="text-yellow-500 text-[15px] text-center">Stock</th>
                        <th class="text-yellow-500 text-[15px] text-center">Description</th>
                        <th class="text-yellow-500 text-[15px] text-center">Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arr as $row)
                    <tr class="border-2">
                        <td class="font-bold w-[15%] p-4">{{$row -> name}}</td>
                        <td class="" style="max-width: 10px !important">
                            <img src="{{$row -> thumbnail}}" alt="" style="max-width: 100% !important">
                        </td>
                        <td class="font-semibold text-center">
                            <a class="text-blue-500 w-[15%]" href="{{$row -> url}}">{{$row -> url}}</a>
                        </td>
                        <td class="text-[15px] font-bold text-white bg-slate-400">
                            <div class="bg-grey-500 px-2 text-center">{{$row -> stock}}</div>
                        </td>
                        <td class="font-semibold px-2 text-center bg-slate-300 w-[10%]">{{$row -> description}}</td>
                        <td class="border-solid h-24">
                            <div class="flex justify-center">
                                <button>
                                    <a href="{{ route('pages.history', ['id' => $row->id]) }}" class="bg-blue-500 text-white font-medium py-2 px-4 text-center rounded-lg">Check</a>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center py-4 font-semibold uppercase">AB-Project</div>
        </div>
    </div>
</body>
@endsection