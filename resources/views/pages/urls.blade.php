@extends('layouts.dashboard')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('content')

<body class="bg-slate-300">
    <div class="m-2 shadow-md">
        <div class="border-2 bg-white rounded-lg">
            <div class="flex justify-between items-center px-3 py-1 border-b-2">
                <span class="pr-2 text-[18px] uppercase font-bold">URLS</span>
                <div class="flex justify-center items-center gap-2">
                    <button id="Searchbutton" class="py-2 px-2 rounded-md border bg-light text-xs font-medium">
                        <i class="fa-solid fa-gear pr-1"></i>Chart Type
                    </button>
                    <button class="py-2 px-2 rounded-md border bg-light text-xs font-medium">
                        <i class="fa-solid fa-file-import pr-1"></i>Import
                    </button>
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
            <div id='toggleSection' style="display: none;">
                <div class="p-2 flex justify-start items-center gap-2">
                    <div class="flex">
                        <button class="py-2 px-4 rounded-md border bg-light font-medium uppercase flex justify-center items-center">
                            <i class="fa-solid fa-filter pr-1"></i>
                            <div class="px-1">FILTERS</div>
                        </button>
                        <div class="flex border-2 rounded-md">
                            <input class="py-2 w-96 rounded-md" type="text" placeholder="Search">
                            <button class="py-2 px-4 bg-light font-medium uppercase flex justify-center items-center" style="outline:none">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <button class="py-2 px-4 rounded-md border bg-light font-medium">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button class="py-2 px-4 rounded-md border bg-light font-medium">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="m-1 p-2 bg-right bg-slate-500">
            </div>
            <table class="table-auto w-full">
                <thead class="py-5 border-b-2">
                    <tr class="my-5">
                        <td class="w-1/12 text-center">
                            <input type="checkbox">
                        </td>
                        <th class="py-4 pl-2">Product</th>
                        <th class="text-center">Link</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Availability</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center">Display</th>
                    </tr>
                </thead>
                <!-- <thead class="py-5 border-b-2">
                    <tr class="my-5">
                        <th class="pl-2">Product</th>
                        <th class="text-center">Company/Region</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Availability</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center">Display</th>
                    </tr>
                </thead> -->
                <tbody>
                    @foreach ($arr as $row)
                    <tr class="font-semibold hover:bg-blue-100 border-b-2 ml-2">
                        <td class="w-1/12 text-center">
                            <input type="checkbox">
                        </td>
                        <td class="p-2 w-[25%]">{{ $row->product }}</td>
                        <td class="py-2  w-[20%]">
                            <a class="text-blue-500" href="https://abbeautyworld.com/">https://abbeautyworld.com/products/lp-tay-trang-micellar-sach-sau-400ml</a>
                        </td>
                        <td class="p-2 text-center">27/10/2001</td>
                        <td class="text-center">
                            @if($row->AB != "")
                            {{ $row->AB }}
                            @else
                            <div class="flex">
                                <div class="block h-full w-full text-red-500">0</div>
                            </div>
                            @endif
                        </td>
                        <td class="border-solid text-center">
                            @if($row->AB >= 100)
                            <div class="text-green-500 font-semibold"><i class="fa-sharp-duotone fa-solid fa-check"></i></div>
                            @else
                            <div class="text-red-500 font-semibold"><i class="fa-sharp-duotone fa-solid fa-xmark"></i></div>
                            @endif
                        </td>
                        <td class="border-solid h-24">
                            <div class="text-center text-yellow-500 font-bold">
                                15%
                            </div>
                        </td>

                        <td class="border-solid h-24 text-center p-4">
                            <button id="active-{{ $row->id }}" class="py-2 px-3 rounded-md off"></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center py-4 font-semibold uppercase">AB-Project</div>
        </div>
    </div>
</body>
<script>
    document.getElementById('Searchbutton').addEventListener('click', function() {
        const toggleSection = document.getElementById('toggleSection');
        toggleSection.style.display = toggleSection.style.display === 'none' ? 'block' : 'none';
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
</script>
@endsection

@section('scripts')
<script>
    document.getElementById('Searchbutton').addEventListener('click', function() {
        const toggleSection = document.getElementById('toggleSection');
        if (toggleSection.style.display === 'none') {
            toggleSection.style.display = 'block';
        } else {
            toggleSection.style.display = 'none';
        }
    });

    document.querySelectorAll('[id^="active-"]').forEach(button => {
        button.addEventListener('click', function() {
            if (button.classList.contains('off')) {
                button.classList.remove('off');
                button.classList.add('on');
            } else {
                button.classList.remove('on');
                button.classList.add('off');
            }
        });
    });
</script>
@endsection