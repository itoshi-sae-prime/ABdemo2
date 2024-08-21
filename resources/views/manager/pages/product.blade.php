@extends('manager.layouts.dashboard')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')


<body class="bg-slate-300">
    <div class="mx-2 mt-3 shadow-md">
        <div class="border-2 bg-white rounded-lg">
            <div class="flex justify-between items-center px-3 py-1 border-b-2 bg-white shadow-lg" style="position: sticky; top: 0; z-index:1">
                <span class="pr-2 text-[18px] uppercase font-bold">Product</span>
                <div class="flex justify-center items-center gap-2">
                    <button class="py-2 px-4 rounded-md border bg-light font-medium uppercase flex justify-center items-center">
                        <i class="fa-solid fa-filter pr-1"></i>
                        <div class="px-1">FILTERS</div>
                    </button>
                    <!-- Search -->
                    <div class="border-2 rounded-md">
                        <form class="flex" action="{{ route('pages.product') }}" method="GET" id="searchForm">
                            <input class="p-2 w-72 rounded-md input-search-ajax" id="searchQuery" name="search" placeholder="Search for products...">
                            <button class="py-2 px-4 bg-light font-medium uppercase flex justify-center items-center" style="outline:none" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                    <!-- fix -->
                    <!-- <button class="py-2 px-4 rounded-md border bg-light font-medium">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button> -->
                    <!-- delete -->
                    <button id="delete-selected" class="py-2 px-4 rounded-md border bg-light font-medium">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    <!-- export -->
                    <button class="py-2 px-2 rounded-md border bg-light text-xs font-medium">
                        <a href="{{ route('export') }}">
                            <i class="fa-solid fa-file-export pr-1"></i>Export
                        </a>
                    </button>
                    <!-- import -->
                    <button id="openModalBtn" class="py-2 px-2 rounded-md border bg-light text-xs font-medium">
                        <i class="fa-solid fa-file-import pr-1"></i>Import
                    </button>
                    <a href="{{ route('product.create') }}">
                        <button class="py-2 px-2 rounded-md border text-xs font-medium bg-blue-500 text-white">
                            <i class="fa-solid fa-plus pr-1"></i>Create
                        </button>
                    </a>
                    <div>
                        <select name="values" class="py-2 px-2 rounded-md border bg-light text-xs font-medium">
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                        </select>
                    </div>
                    <button id="refresh" class="py-2 px-3 rounded-md border bg-light text-xs font-medium">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </button>
                </div>
            </div>
            <div id="ImportToggle" class="p-4 bg-slate-200" style="display:none">
                <div class="flex justify-center items-center">
                    <form id="import_excel_form" method="post" action="{{ route('import') }}" enctype="multipart/form-data" class="p-3 flex justify-center items-center bg-gray-100 rounded-lg shadow-lg" style="width:100%">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <button type="button" class="btn-import px-3 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                onclick="document.getElementById('fileInput').click();">
                                UploadFile
                            </button>
                            <input type="file" id="fileInput" name="import_excel" style="display: none;" onchange="displayFileName()">
                            <span id="fileName" class="text-gray-700 font-semibold" style="max-width: 1000px; width:350px;">No file chosen</span>
                        </div>
                        <button type="submit" name="save_excel_data" class="px-3 py-2 text-white font-semibold rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2" style="background-color:green">
                            Import
                        </button>
                    </form>
                </div>
            </div>
            @if (session('message'))
            <div class="alert alert-info text-center font-extrabold">
                {{ session('message') }}
            </div>
            @endif
            <table class="table-auto w-full">
                <thead class="py-5 border-b-2 w-100">
                    <tr class="my-5 bg-slate-300">
                        <th class="w-1/12 text-center">
                            <input class="Customcheck" type="checkbox" id="select-all">
                        </th>
                        <th class="text-yellow-500 text-[15px] py-4">Barcode</th>
                        <th class="text-yellow-500 text-[15px] pl-2">Product</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Brand</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">ABBeauty</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Average</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Option</th>
                        <th class="text-yellow-500 text-[15px] text-center">Display</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php
                    $term = 0;
                    $last_up_date = '';
                    ?>
                    @foreach ($arr as $row)
                    <form action="{{ route('product.delete.selected') }}" method="POST">
                        <tr id="toggleDisplay-{{ $row->id }}" class="font-semibold hover:bg-blue-100 border-b-2 m-1">
                            <td class="w-1/12 text-center">
                                <input type="checkbox" name="items" value="{{ $row->id }}">
                            </td>
                            <td class="mx-1">{{ $row->product_barcode }}</td>
                            <td class="p-2 w-[40%]">{{ $row->product_name }}</td>
                            <td class="p-2 text-center">{{ $row->brand }}</td>
                            @if(isset($new_p[$term]))
                            <td data-value="{{$new_p[$term]->p_ab}}" alt="" class="text-center bg-slate-300 border-y-2 font-bold">
                                <a class="link-price" href="{{$row->ab_beautyworld}}">
                                    @if(is_numeric($new_p[$term]->p_ab ))
                                    @if($new_p[$term]->p_ab > $new_p[$term]->p_hsk)
                                    <div class="text-red-500 font-semibold">{{ number_format($new_p[$term]->p_ab , 0, ',', '.') }}</div>
                                    @else
                                    <div class="text-green-500 font-semibold">{{ number_format($new_p[$term]->p_ab , 0, ',', '.') }}</div>
                                    @endif
                                    @endif
                                </a>
                            </td>
                            @endif
                            @if(isset($average_values[$row->id]))
                            <td alt="" class="text-center">
                                {{ number_format($average_values[$row->id], 0, ',', '.') }}
                            </td>
                            @endif
                            <td class="border-solid h-24">
                                <div class="flex justify-center">
                                    <button>
                                        <a href="{{ route('pages.history', ['id' => $row->id]) }}" class="bg-blue-500 text-white font-medium py-2 px-4 text-center rounded-lg">Detail</a>
                                    </button>
                                </div>
                            </td>
                            <!-- <td class="border-solid h-24 text-center px-4 flex justify-center items-center">
                                <div id="display" class="display-toggle">
                                    <div class="indicator" id="indicator-{{ $row->id }}" data-id="{{ $row->id }}"></div>
                                </div>
                            </td> -->
                        </tr>
                    </form>
                    <?php
                    $term++
                    ?>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center py-4 font-semibold uppercase">AB-Project</div>
        </div>
    </div>
</body>
<script>
    document.querySelectorAll('.display-toggle').forEach(element => {
        element.addEventListener('click', function() {
            const id = element.querySelector('.indicator').getAttribute('data-id');
            const targetElement = document.getElementById('toggleDisplay-' + id);
            console.log(id);
            element.classList.toggle('active');
            if (targetElement) {
                targetElement.classList.toggle('nice');
            }
        });
    });

    document.getElementById('openModalBtn').addEventListener('click', function() {
        var importToggle = document.getElementById('ImportToggle');
        if (importToggle.style.display === "none" || importToggle.style.display === "") {
            importToggle.style.display = "block";
        } else {
            importToggle.style.display = "none";
        }
    });

    function displayFileName() {
        var input = document.getElementById('fileInput');
        var fileName = document.getElementById('fileName');
        fileName.textContent = input.files[0] ? input.files[0].name : "No file chosen";
    }
</script>
@endsection

@section('scripts')
<script>
    document.getElementById('refresh').addEventListener('click', function() {
        window.location.reload();
    })
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="items"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
    document.getElementById('delete-selected').addEventListener('click', function() {
        // Tạo mảng để chứa các ID đã chọn
        const selectedIds = Array.from(document.querySelectorAll('input[name="items"]:checked'))
            .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            alert('Vui lòng chọn ít nhất một mục để xóa.');
            return;
        }

        // Xác nhận xóa
        if (confirm('Bạn có chắc chắn muốn xóa các mục đã chọn?')) {
            // Tạo form để gửi yêu cầu xóa
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('product.delete.selected') }}"
            // Thêm CSRF token
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            // Thêm method DELETE
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            form.appendChild(methodField);

            // Thêm các ID vào form
            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });

            // Thêm form vào body và submit
            document.body.appendChild(form);
            form.submit();
        }
    });
</script>
@endsection