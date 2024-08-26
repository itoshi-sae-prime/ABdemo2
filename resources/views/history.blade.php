<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="px-5 py-3">
    <?php
    $term = 0;
    $user = session('user');
    $role = $user->name;
    $route = '';
    switch ($role) {
        case 'Nguyễn Thành Danh':
            $route = route('admin.pages.product'); // Admin route
            break;
        case 'Lê Minh Quốc':
            $route = route('manager.pages.product'); // Manager route
            break;
        default:
            $route = route('user.pages.product'); // User route
            break;
    }
    ?>
    <div class="w-[100%] mx-auto border-2">
        <div class="product m-3 border-2 border-solid rounded-lg ">
            <div class="m-[18px]">
                <div class="flex justify-between items-center">
                    <div class="font-semibold  tracking-wide m-2 uppercase pb-2 text-black" style="font-size: 30px;">Details Of Product Price Changes</div>
                    <div class="gap gap-x-4">
                        @if($user->name =='Nguyễn Thành Danh' || $user->name =='Lê Minh Quốc')
                        <button onclick="window.location='{{ route('changesform',[$product->product_barcode,$new_p[$term]->p_ab]) }}'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Changes Prices
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <a href="{{ route('changesLink', ['id' => $product ->id]) }}">Changes Link</a>
                        </button>
                        @endif
                        <button onclick="window.location='{{ $route }}';" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back
                        </button>
                    </div>
                </div>
                <div class="my-2">
                    <div class="my-auto">
                        <table class="table-auto w-[100%] border-2 border-solid">
                            <thead class="border-white-2 border-solid">
                                <tr>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2">Product Name</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2">Barcode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-semibold">
                                    <td class="border-2 border-solid border-black text-center p-2 text-[18px] text-black">{{$product -> product_name}}</td>
                                    <td class="border-2 border-solid border-black text-center p-2 text-[20px] text-black">{{$product -> product_barcode}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="my-auto pt-[20px]">
                        <div class="table-auto w-[100%] border-2 border-solid">

                        </div>
                    </div>
                    <div class="my-auto pt-[20px]">
                        <table class="table-auto w-[100%] border-2 border-solid">
                            <thead class="border-2 border-solid ">
                                <tr>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">AB</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">Hasaki</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">Guardian</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">Thegioiskinfood</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">Lamthao</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-semibold">
                                    <td id="p_ab" class="border-2 border-solid border-black text-center p-2 text-[18px] {{ number_format($detail[0]->p_ab) > number_format($detail[1]->p_ab) ? 'text-red-500' : 'text-green-500'}}">
                                        <div class="">
                                            {{number_format($detail[0]->p_ab), 0, ',', '.'}}
                                        </div>
                                    </td>
                                    <td id="p_hsk" class="border-2 border-solid border-black text-center p-2 text-[20px] {{ number_format($detail[0]->p_hsk) > number_format($detail[1]->p_hsk) ? 'text-red-500' : 'text-green-500'}}">
                                        <div class="">
                                            {{number_format($detail[0]->p_hsk), 0, ',', '.'}}
                                        </div>
                                    </td>
                                    <td id="p_gu" class="border-2 border-solid border-black text-center p-2 text-[20px] {{ number_format($detail[0]->p_gu) > number_format($detail[1]->p_gu) ? 'text-red-500' : 'text-green-500'}}">
                                        <div class="">
                                            {{number_format($detail[0]->p_gu), 0, ',', '.'}}
                                        </div>
                                    </td>
                                    <td id="p_tgs" class="border-2 border-solid border-black text-center p-2 text-[20px] {{ number_format($detail[0]->p_tgs) > number_format($detail[1]->p_tgs) ? 'text-red-500' : 'text-green-500'}}">
                                        <div class="">
                                            {{number_format($detail[0]->p_tgs), 0, ',', '.'}}
                                        </div>
                                    </td>
                                    <td id="p_lt" class="border-2 border-solid border-black text-center p-2 text-[20px] {{ number_format($detail[0]->p_lt) > number_format($detail[1]->p_lt) ? 'text-red-500' : 'text-green-500'}}">
                                        <div class="">
                                            {{number_format($detail[0]->p_lt), 0, ',', '.'}}
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="my-auto pt-[20px]">
                        <div class="table-auto w-[100%] border-2 border-solid">

                        </div>
                    </div>
                    <div class="pt-[20px]">
                        <table class="table-auto w-[100%] border-2 border-solid ">
                            <thead class="border-2 border-solid">
                                <tr>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 p-2 text-center">STT</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 p-2 text-center">First time</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 p-2 text-center">Last time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $term = 1
                                ?>
                                @foreach($detail as $detail)
                                <tr class="font-semibold hover:bg-slate-400 hover:text-black" onclick="updatePrice({{ $detail->p_ab }}, {{ $detail->p_hsk }}, {{ $detail->p_gu }}, {{ $detail->p_tgs }}, {{ $detail->p_lt }})" style="cursor: pointer">
                                    <td class="border-2 border-solid border-black text-center font-bold text-black">{{$term++}}</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3 text-black">{{$detail->created_at}}</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3 text-black">{{$detail->updated_at}}</td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center py-4 font-semibold uppercase bottom-0 bg-slate-400">AB-Project</div>
    </div>
    <?php
    $term++;
    ?>
</body>
<script>
    function updatePrice(p_ab, p_hsk, p_gu, p_tgs, p_lt) {
        document.getElementById('p_ab').innerText = new Intl.NumberFormat().format(p_ab);
        document.getElementById('p_hsk').innerText = new Intl.NumberFormat().format(p_hsk);
        document.getElementById('p_gu').innerText = new Intl.NumberFormat().format(p_gu);
        document.getElementById('p_tgs').innerText = new Intl.NumberFormat().format(p_tgs);
        document.getElementById('p_lt').innerText = new Intl.NumberFormat().format(p_lt);
    }
</script>

</html>