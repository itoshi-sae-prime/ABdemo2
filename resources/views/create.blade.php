<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-slate-200">
    <div class="flex justify-center items-center p-5">
        <div class="form w-[700px] h-auto my-[20px] bg-white shadow-lg p-5 rounded-lg">
            <div class="px-2 border-2 rounded-lg">
                <div class="uppercase py-2">
                    <div class="px-2 font-bold">New Product</div>
                </div>
                <div class="p-4">
                    <div class="">
                        <div class="font-semibold">Barcode</div>
                        <input class="border-2 w-full rounded-md py-1" type="text">
                    </div>
                    <div class="pt-3">
                        <div class="font-semibold">Product name</div>
                        <input class="border-2 w-full rounded-md py-1" type="text">
                    </div>
                    <div class="pt-3">
                        <div class="font-semibold">Brand</div>
                        <input class="border-2 w-full rounded-md py-1" type="text">
                    </div>
                    <div class="pt-3">
                        <div class="font-semibold">The price: AB</div>
                        <input class="border-2 w-full rounded-md py-1" type="text">
                    </div>
                    <div class="pt-3">
                        <div class="font-semibold">The price: Hasaki</div>
                        <input class="border-2 w-full rounded-md py-1" type="text">
                    </div>
                    <div class="pt-3">
                        <div class="font-semibold">The price: Guardian</div>
                        <input class="border-2 w-full rounded-md py-1" type="text">
                    </div>
                    <div class="pt-3">
                        <div class="font-semibold">The price: Thegioiskinfood</div>
                        <input class="border-2 w-full rounded-md py-1" type="text">
                    </div>
                    <div class="pt-2">
                        <div class="font-semibold">The price: LamThao</div>
                        <input class="border-2 w-full rounded-md py-1" type="text">
                    </div>
                </div>
                <div class="flex justify-end items-center px-2 py-3 gap-x-2 border-t-2">
                    <button class="py-2 px-4 border-2 rounded-md"><span>Cancel</span></button>
                    <button class="py-2 px-4 bg-blue-500 text-white  border-2 rounded-md hover:bg-blue-400"><span>Create</span></button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>