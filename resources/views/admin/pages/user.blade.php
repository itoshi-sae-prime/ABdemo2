@extends('admin.layouts.dashboard')

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
                <span class="pr-2 text-[18px] uppercase font-bold">User</span>
                <div class="flex justify-center items-center gap-2">
                    <!-- Search -->
                    <!-- fix -->
                    <!-- <button class="py-2 px-4 rounded-md border bg-light font-medium">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button> -->
                    <!-- delete -->
                    <!-- <button id="delete-selected" class="py-2 px-4 rounded-md border bg-light font-medium">
                        <i class="fa-solid fa-trash"></i>
                    </button> -->
                    <a href="{{ route('product.create') }}">
                        <button class="py-3 px-3 rounded-md border text-xs font-medium bg-blue-500 text-white">
                            <i class="fa-solid fa-plus pr-1"></i>Create
                        </button>
                    </a>

                </div>
            </div>
            <table class="table-auto w-full">
                <thead class="py-5 border-b-2 w-100">
                    <tr class="my-5 bg-slate-300">
                        <th class="text-yellow-500 text-[15px] py-4 text-center">Id</th>
                        <th class="text-yellow-500 text-[15px] pl-2 text-center">Name</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Phone</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Email</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Password</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Role</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Option</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php
                    $term = 0;
                    $last_up_date = '';
                    ?>
                    @foreach ($members as $row)
                    <form action="{{ route('product.delete.selected') }}" method="POST">
                        <tr id="" class="font-semibold hover:bg-blue-100 border-b-2 m-1">
                            <td class="w-1/12 text-center">
                                <!-- <input type="checkbox" name="items" value="{{ $row->Id }}"> -->
                                <!-- <span class="ml-2">{{ $term++ }}</span> -->
                                <span class="ml-2">{{ $row->Id }}</span>
                            </td>
                            <td class="p-2 text-center">{{ $row->Name }}</td>
                            <td class="p-2 text-center ">{{ $row->Phone }}</td>
                            <td class="p-2 text-center ">{{ $row->Email }}</td>
                            <td class="p-2 text-center ">{{ $row->Password }}</td>
                            <td class="p-2 text-center uppercase">{{ $row->Role }}</td>
                            <td class="p-2 text-center flex justify-center items-center gap-x-3">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <a href="{{route('changesform')}}">Delete</a>
                                </button>
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    <a href="{{route('changesform')}}">Fix</a>
                                </button>
                            </td>
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