<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-image {
            background-image: url('https://trello.com/1/cards/667ae62a59bd7a6529cb30c4/attachments/667e7aaa2ca65dc740141baf/previews/667e7aaa2ca65dc740141bba/download/logo_with_black_background.png');
            background-size: cover;
            /* Đảm bảo hình nền bao phủ toàn bộ phần tử */
            background-position: center;
            /* Căn chỉnh hình nền ở giữa phần tử */
        }

        .gradient-background {
            width: 100%;
            /* Hoặc bất kỳ kích thước nào bạn muốn */
            height: 100vh;
            /* Hoặc bất kỳ chiều cao nào bạn muốn */
            background: linear-gradient(to left, black, yellow);
        }
    </style>
</head>

<body class="gradient-background  flex items-center justify-center min-h-screen">
    <div class="flex items-center justify-center space-x-8 w-full max-w-4xl">
        <!-- Image Section -->
        <div class="md:block">
            <div class="w-[500px] h-[500px] bg-image" alt="My Image"></div>
        </div>

        <!-- Form Section -->
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h1>

            <!-- Error Message Display -->
            <!-- @if ($errors->has('error'))
            <div id="error-message" style="display:none;">
                {{ $errors->first('error') }}
            </div>
            @endif -->
            <!-- @if (session('message'))
            <div class="bg-blue-100 text-blue-700 p-3 rounded mb-4">
                {{ session('message') }}
            </div>
            @endif -->

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="text" class="block text-gray-700 font-medium mb-2">Account</label>
                    <input type="text" id="account" name="account" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            alert("Failled to login");
        }
    });
</script>