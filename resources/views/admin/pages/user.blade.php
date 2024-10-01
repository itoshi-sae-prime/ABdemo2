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
                <span class="pr-2 text-[18px] uppercase font-bold py-2">User</span>
                <div class="flex justify-center items-center gap-2">
                    <a href="{{route('user.create')}}">
                        <button class="py-2 px-3 rounded-md border text-xs font-medium bg-blue-500 text-white">
                            Create
                        </button>
                    </a>
                    <button id="delete-selected" class="py-2 px-3 rounded-md border text-xs font-medium bg-blue-500 text-white">
                        Delete
                    </button>
                </div>
            </div>
            <form id="delete-form" action="{{ route('user.delete.selected') }}" method="post">
                @csrf
                <table class="table-auto w-full">
                    <thead class="py-5 border-b-2 w-100">
                        <tr class="my-5 bg-slate-300">
                            <th class="text-yellow-500 text-[15px] py-4 text-center">Id</th>
                            <th class="text-yellow-500 text-[15px] pl-2 text-center">Name</th>
                            <th class="text-yellow-500 text-[15px] px-3 text-center">Account</th>
                            <th class="text-yellow-500 text-[15px] px-3 text-center">Password</th>
                            <!-- <th class="text-yellow-500 text-[15px] px-3 text-center">Role</th> -->
                            <th class="w-1/12 text-center">
                                <input class="Customcheck" type="checkbox" id="select-all">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php $term = 0; ?>
                        @foreach ($members as $row)
                        <tr class="font-semibold hover:bg-blue-100 border-b-2 m-1">
                            <td class="p-2 text-center">{{ ++$term }}</td>
                            <td class="p-2 text-center">{{ $row->name }}</td>
                            <td class="p-2 text-center">{{ $row->user_name }}</td>
                            <td class="p-2 text-center">{{ $row->password }}</td>
                            <!-- <th class="text-[15px] px-3 text-center">
                                @if($row->name == 'Nguyễn Thành Danh')
                                <div class="uppercase font-bold">admin</div>
                                @elseif($row->name == 'Lê Minh Quốc')
                                <div class="uppercase font-bold">manager</div>
                                @else
                                <div class="uppercase font-bold">user</div>
                                @endif
                            </th> -->
                            <td class="w-1/12 text-center">
                                @if($row->name != 'Nguyễn Thành Danh')
                                <input type="checkbox" name="items[]" value="{{ $row->id }}">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
            <div class="text-center py-4 font-semibold uppercase">AB-Project</div>
        </div>
    </div>
</body>

<script>
    // Select/Deselect all checkboxes
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="items[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    // Delete selected users
    document.getElementById('delete-selected').addEventListener('click', function() {
        const form = document.getElementById('delete-form');
        const selectedIds = Array.from(form.querySelectorAll('input[name="items[]"]:checked'))
            .map(checkbox => checkbox.value);

        if (selectedIds.length === 0) {
            alert('Vui lòng chọn ít nhất một mục để xóa.');
            return;
        }

        if (confirm('Bạn có chắc chắn muốn xóa các mục đã chọn?')) {
            form.submit();
        }
    });
</script>
@endsection

@section('scripts')
<script>
    // Your additional script
</script>
@endsection