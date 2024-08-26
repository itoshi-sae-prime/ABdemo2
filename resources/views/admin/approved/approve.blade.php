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
                <span class="pr-2 text-[18px] uppercase font-bold py-2">Approved</span>
                <div class="flex justify-center items-center gap-2">
                    <button onclick="window.location='{{ route('admin.approved.approve') }}' " class="py-2 px-4 rounded-md border bg-light font-medium uppercase flex justify-center items-center">
                        <div class="px-1">Approved Requests</div>
                    </button>
                    <button onclick="window.location='{{ route('pages.approve_accept') }}' " class=" py-2 px-4 rounded-md border bg-light font-medium uppercase flex justify-center items-center">
                        <div class="px-1">Accept Requests</div>
                    </button>
                    <button onclick="window.location='{{ route('pages.approve_refushed') }}' " class="py-2 px-4 rounded-md border bg-light font-medium uppercase flex justify-center items-center">
                        <div class="px-1">Refuse Requests</div>
                    </button>
                </div>
            </div>
            <table class="table-auto w-full">
                <thead class="py-5 border-b-2 w-100">
                    <tr class="my-5 bg-slate-300">
                        <th class="text-yellow-500 text-[15px] p-4 text-center">ID</th>
                        <th class="text-yellow-500 text-[15px] pl-2 text-center">Barcode</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Giá Trước </th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Giá Sau</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Bắt đầu</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Kết thúc</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Kênh</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Tình trạng</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Thời gian tạo</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Người Tạo</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Người Kiểm Duyệt</th>
                        <th class="text-yellow-500 text-[15px] px-3 text-center">Opion</th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php
                    $term = 1;
                    $user = session('user');
                    ?>
                    @foreach($approvedRequests as $request)
                    <tr class="font-semibold hover:bg-blue-100 border-b-2 m-1">
                        <td class="text-center">{{ $term }}</td>
                        <td class="text-center">{{ $request->barcode }}</td>
                        <td class="text-center">{{ $request->price }}</td>
                        <td class="text-center">{{ $request->discount }}</td>
                        <td class="text-center">{{ date('d-m-Y', strtotime($request->start_date))}}</td>
                        <td class="text-center">{{ date('d-m-Y', strtotime($request->end_date)) }}</td>
                        <td class="text-center uppercase font-bold">{{ $request->platform }}</td>
                        <td class="text-center">{{ date('d-m-Y', strtotime($request->created_at)) }}</td>
                        <td class="text-center">@if ($request->is_approved == 0) <div class="text-orange-500 font-bold">Chưa Duyệt</div> @elseif ($request->is_approved == 1) <div class="text-orange-500 font-bold">Đã Duyệt</div> @elseif ($request->is_approved == 2) <div class="text-red-500 font-bold">Không Duyệt</div> @endif</td>
                        <td class="text-center">{{ $request->name }}</td>
                        <td class="text-center uppercase font-bold">{{ $request->approved_by}}</td>
                        @if($user->name == 'Nguyễn Thành Danh')
                        <td class="p-2 text-center flex justify-center items-center gap-x-3">
                            <div class="">
                                <form action="{{ route('createPromotion')}}" method="POST">
                                    @csrf
                                    <input type="text" style="display:none" name="id" value="{{$request->id}}">
                                    <input type="text" style="display:none" name="barcode" value="{{$request->barcode}}">
                                    <input type="text" style="display:none" name="name" value="{{$request->name }}">
                                    <input type="text" style="display:none" name="price" value="{{$request->price}}">
                                    <input type="text" style="display:none" name="discount" value="{{$request->discount}}">
                                    <input type="text" style="display:none" name="start_date" value="{{$request->start_date}}">
                                    <input type="text" style="display:none" name="end_date" value="{{$request->end_date}}">
                                    <input type="text" style="display:none" name="platform" value="{{$request->platform}}">
                                    <input type="text" style="display:none" name="created_at" value="{{$request->created_at}}">
                                    <button type="submit" class="block my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Accept
                                    </button>
                                </form>
                                <form action="{{ route('refusePromotion')}}" method="POST">
                                    @csrf
                                    <input type="text" style="display:none" name="id" value="{{$request->id}}">
                                    <button type="submit" class="block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Refuse
                                    </button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    <?php
                    $term++;
                    ?>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center py-4 font-semibold uppercase border-t-2">AB-Project</div>
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