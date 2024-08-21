@extends('manager.layouts.dashboard')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<!-- @if(isset($page))
@if($page=='accept')
<h1>Accept Requests</h1>
@elseif($page=='refuse')
<h1>Refuse Requests</h1>
@else
<h1>Approved Requests</h1>
@endif
@endif -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Barcode</th>
            <th>Giá trước KM</th>
            <th>Giá KM</th>
            <th>Bắt Đầu Từ</th>
            <th>Ngày kết thúc</th>
            <th>Kênh</th>
            <th>Tình Trạng</th>
            <th>Thời gian tạo</th>
            <th>Cập Nhật Lần Cuối</th>
            <th>Người Tạo</th>
            <th>Người Kiểm Duyệt</th>

            @if(!isset($request->is_approved) && !isset($page))
            <th>Actions</th>
            @endif

        </tr>
    </thead>
    <tbody>
        @foreach($approvedRequests as $request)
        <tr>
            <td>{{ $request->id }}</td>
            <td>{{ $request->barcode }}</td>
            <td>{{ $request->price }}</td>
            <td>{{ $request->discount }}</td>
            <td>{{ $request->start_date }}</td>
            <td>{{ $request->end_date }}</td>
            <td>{{ $request->platform }}</td>
            <td>@if ($request->is_approved == 0) Chưa Duyệt @elseif ($request->is_approved == 1) Đã Duyệt @elseif ($request->is_approved == 2) Đã từ chối @endif</td>
            <td>{{ $request->created_at }}</td>
            <td>{{ $request->updated_at }}</td>
            <td>{{ $request->name }}</td>
            <td>{{ $request->approved_by }}</td>

            @if(isset($request->is_approved) && !isset($page))
            <td>
                <form action="{{ route('createPromotion')}}" method="post">
                    @csrf
                    <input type="text" style="display:none" name="ap_id" value="{{$request->id}}">
                    <input type="text" style="display:none" name="barcode" value="{{$request->barcode}}">
                    <input type="text" style="display:none" name="name" value="{{$request->name }}">
                    <input type="text" style="display:none" name="b_value" value="{{$request->price}}">
                    <input type="text" style="display:none" name="value" value="{{$request->discount}}">
                    <input type="text" style="display:none" name="start_date" value="{{$request->start_date}}">
                    <input type="text" style="display:none" name="end_date" value="{{$request->end_date}}">
                    <input type="text" style="display:none" name="platform" value="{{$request->platform}}">
                    <input type="text" style="display:none" name="created_at" value="{{$request->created_at}}">
                    <button type="submit" class="btn btn-secondary">Approve</button>
                </form>
                <form action="{{ route('refusePromotion')}}" method="post">
                    @csrf
                    <input type="text" style="display:none" name="ap_id" value="{{$request->id}}">
                    <button type="submit" class="btn btn-secondary">Refuse</button>
                </form>
            </td>
            @endif


        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script>
    // Add any JavaScript or jQuery code here if needed
</script>
@endsection