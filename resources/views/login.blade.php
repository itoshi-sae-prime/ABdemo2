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
        <div class="form w-[650px] h-auto my-[20px] bg-white shadow-lg p-5 rounded-lg">
            @if ($errors->has('error'))
            <div>{{ $errors->first('error') }}</div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>