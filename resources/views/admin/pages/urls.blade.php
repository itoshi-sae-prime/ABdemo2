@extends('admin.layouts.dashboard')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
    .tgdisplaygray {
        width: 100%;
        height: auto;
        background-color: gray !important;
    }
</style>
@endsection
@section('content')

<body class="bg-slate-300">
    <div class="mr-2 ml-3 mt-3 shadow-md">
        <div class="border-2 bg-white rounded-lg">
            <div class="flex justify-between items-center px-3 py-1 border-b-2">
                <span class="pr-2 text-[18px] uppercase font-bold">URLS</span>
                <div class="flex justify-center items-center gap-2">
                    <button class="py-2 px-4 rounded-md border bg-light font-medium uppercase flex justify-center items-center">
                        <i class="fa-solid fa-filter pr-1"></i>
                        <div class="px-1">FILTERS</div>
                    </button>
                    <!-- Search -->
                    <div class="border-2 rounded-md">
                        <form class="flex" action="" method="" id="searchForm">
                            <input class="p-2 w-72 rounded-md input-search-ajax" id="searchQuery" name="searchurl" placeholder="Search for products...">
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
            <div class="m-1 p-1 bg-right bg-white">
            </div>
            <table class="table-auto w-full">
                <thead class="py-5 border-b-2 bg-black">
                    <tr class="my-5">
                        <td class="w-1/12 text-center">
                            <input type="checkbox">
                        </td>
                        <th class="text-yellow-500 text-[15px]  py-4 pl-2">Product</th>
                        <th class="text-yellow-500 text-[15px]  text-center">Link</th>
                        <th class="text-yellow-500 text-[15px]  text-center">Date</th>
                        <th class="text-yellow-500 text-[15px]  text-center">Price</th>
                        <!-- <th class="text-yellow-500 text-[15px]  text-center">Availability</th> -->
                        <th class="text-yellow-500 text-[15px]  text-center">Discount</th>
                        <th class="text-yellow-500 text-[15px]  text-center">Display</th>
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
                    <?php
                    $term = 0;
                    $last_up_date = '';
                    ?>
                    @foreach($products as $product)
                    <tr id="toggleDisplay-{{ $product->id }}" class="font-semibold hover:bg-blue-100 border-b-2 ml-2">
                        <td class="w-1/12 text-center">
                            <input type="checkbox">
                        </td>
                        <td class="p-2 w-[25%]">{{ $product->product_name }}</td>
                        <td class=" py-2 w-[15%]">
                            <a class="text-blue-500" href="{{$product->ab_beautyworld}}">
                                {{ \Illuminate\Support\Str::limit($product->ab_beautyworld, 50) }}
                            </a>
                        </td>
                        <td class="p-2 text-center">dd/mm/yyyy</td>
                        <td class="p-2 text-center border-y-2 font-bold text-red-500">
                            <a class="link-price ">
                                {{number_format($product->p_ab, 0, ',', '.') }}
                            </a>
                        </td>
                        <!-- <td class="border-solid text-center">
                            <div id="yes" class="text-green-500 font-semibold "><i class="fa-sharp-duotone fa-solid fa-check"></i></div>
                            <div id="no" class="text-red-500 font-semibold"><i class="fa-sharp-duotone fa-solid fa-xmark"></i></div>
                        </td> -->
                        <td class="border-solid h-24">
                            <div class="text-center text-blue-500 font-bold">
                                15%
                            </div>
                        </td>
                        <td class="border-solid h-24 text-center p-4 flex justify-center items-center">
                            <div id="display" class="display-toggle">
                                <div class="indicator" id="indicator-{{ $product->id }}" data-id="{{ $product->id }}">

                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <?php
                    $term++;
                    ?>
                </tbody>
            </table>
            <div class=" text-center py-4 font-semibold uppercase">AB-Project</div>
        </div>
    </div>
</body>
<script>
    document.querySelectorAll('.display-toggle').forEach(element => {
        element.addEventListener('click', function() {
            const id = element.querySelector('.indicator').getAttribute('data-id');
            const targetElement = document.getElementById('toggleDisplay-' + id);
            const yesElement = document.getElementById('yes');
            const noElement = document.getElementById('no');
            element.classList.toggle('active');
            if (targetElement) {
                targetElement.classList.toggle('nice');
                yesElement.style.display = 'block';
                noElement.style.display = 'none';
            } else {
                yesElement.style.display = 'none';
                noElement.style.display = 'block';
            }

        });
    });
</script>
@endsection

@section('scripts')
<script>

</script>
@endsection