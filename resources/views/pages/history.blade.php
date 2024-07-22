@extends('layouts.dashboard')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')

<body class="bg-slate-300">
    <div class="w-[95%] mx-auto ">
        <div class="product m-3 border-4 border-solid rounded-lg bg-white">
            <div class="m-[18px]">
                <button><a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a></button>
                <div class="font-semibold text-[20px] tracking-wide m-2 uppercase pb-2">Details Of Product Price Changes #{{{$arr->id}}}</div>
                <div class="m-2">
                    <div class="my-auto">
                        <table class="table-auto w-[100%] border-2 border-solid">
                            <thead class="border-2 border-solid ">
                                <tr>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2">Product Name</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2">Barcode </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-semibold">
                                    <td class="border-2 border-solid border-black text-center p-2 text-[18px]">{{$arr->product}}</td>
                                    <td class="border-2 border-solid border-black text-center p-2 text-[20px]">{{$arr->barcode}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="my-auto pt-[20px]">
                        <table class="table-auto w-[100%] border-2 border-solid">
                            <thead class="border-2 border-solid ">
                                <tr>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">AB</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">Hasaki</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">Guardian</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">Thegioiskinfood</th>
                                    <th class="border-2 border-solid border-black bg-black text-yellow-500 text-[20px] text-center p-2 w-[20%]">LamThao</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="font-semibold">
                                    <td class="border-2 border-solid border-black text-center p-2 text-[18px]">{{$arr->AB}}</td>
                                    <td class="border-2 border-solid border-black text-center p-2 text-[20px]">{{$arr->Hasaki}}</td>
                                    <td class="border-2 border-solid border-black text-center p-2 text-[20px]">{{$arr->Guardian}}</td>
                                    <td class="border-2 border-solid border-black text-center p-2 text-[20px]">{{$arr->Thegioiskinfood}}</td>
                                    <td class="border-2 border-solid border-black text-center p-2 text-[20px]">{{$arr->Lamthao}}</td>
                                </tr>
                            </tbody>
                        </table>
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
                                <tr class="font-semibold hover:bg-slate-400 hover:text-white">
                                    <td class="border-2 border-solid border-black text-center font-bold">1</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">12/7/2004 - 14:40:39 PM</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">14/7/2004 - 14:40:39 PM</td>
                                </tr>
                                <tr class="font-semibold hover:bg-slate-400 hover:text-white">
                                    <td class="border-2 border-solid border-black text-center font-bold">2</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">14/7/2004 - 14:40:39 PM</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">19/7/2004 - 14:40:39 PM</td>
                                </tr>
                                <tr class="font-semibold hover:bg-slate-400 hover:text-white">
                                    <td class="border-2 border-solid border-black text-center font-bold">3</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">14/7/2004 - 14:40:39 PM</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">19/7/2004 - 14:40:39 PM</td>
                                </tr>
                                <tr class="font-semibold hover:bg-slate-400 hover:text-white">
                                    <td class="border-2 border-solid border-black text-center font-bold">4</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">14/7/2004 - 14:40:39 PM</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">19/7/2004 - 14:40:39 PM</td>
                                </tr>
                                <tr class="font-semibold hover:bg-slate-400 hover:text-white">
                                    <td class="border-2 border-solid border-black text-center font-bold">5</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">14/7/2004 - 14:40:39 PM</td>
                                    <td class="border-2 border-solid border-black text-center text-[16px] p-3">19/7/2004 - 14:40:39 PM</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
</body>
<script>
    document.getElementById('Searchbutton').addEventListener('click', function() {
        const toggleSection = document.getElementById('toggleSection');
        if (toggleSection.style.display === 'none') {
            toggleSection.style.display = 'block';
        } else {
            toggleSection.style.display = 'none';
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