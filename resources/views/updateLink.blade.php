<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .styled-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            align-self: flex-end;
        }

        .styled-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <form action="{{ route('changesLink',  $products->id) }}" method="POST" class="styled-form">
            @csrf
            <div class="">
                <div class="font-semibold">Barcode</div>
                <input class="border-2 w-full rounded-md py-1 px-2" readonly type="text" name="product_barcode" value="{{ $products->product_barcode }}">
            </div>
            <div class="pt-3">
                <div class="font-semibold">Product name</div>
                <input class="border-2 w-full rounded-md py-1 px-2" readonly type="text" name="product_name" value="{{ $products->product_name }}">
            </div>
            <div class="pt-3">
                <div class="font-semibold">Brand</div>
                <input class="border-2 w-full rounded-md py-1 px-2" readonly type="text" name="brand" value="{{ $products->brand }}">
            </div>
            <div class="pt-3">
                <div class="font-semibold">The Link: AB</div>
                <input class="border-2 w-full rounded-md py-1 px-2" type="text" name="ab_beautyworld" value="{{ $products->ab_beautyworld }}">
            </div>
            <div class="pt-3">
                <div class="font-semibold">The Link: Hasaki</div>
                <input class="border-2 w-full rounded-md py-1 px-2" type="text" name="hasaki" value="{{ $products->hasaki }}">
            </div>
            <div class="pt-3">
                <div class="font-semibold">The Link: Guardian</div>
                <input class="border-2 w-full rounded-md py-1 px-2" type="text" name="guardian" value="{{ $products->guardian }}">
            </div>
            <div class="pt-3">
                <div class="font-semibold">The Link: Thegioiskinfood</div>
                <input class="border-2 w-full rounded-md py-1 px-2" type="text" name="thegioiskinfood" value="{{ $products->thegioiskinfood }}">
            </div>
            <div class="pt-2">
                <div class="font-semibold">The Link: LamThao</div>
                <input class="border-2 w-full rounded-md py-1 px-2" type="text" name="lamthao" value="{{ $products->lamthao }}">
            </div>
            <div class="" style="display: flex; justify-content:right; gap: 10px;">
                <button type="submit" class="styled-button" style="margin-top:15px">Changes</button>
                <button onclick="window.history.back()" class="styled-button">
                    Back
                </button>
            </div>
        </form>
    </div>
</body>

</html>