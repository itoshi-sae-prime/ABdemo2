@extends('manager.layouts.dashboard')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')

<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="border-b border-gray-200 bg-gray-50 p-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-semibold">Product History</h1>
                    <div class="text-sm text-gray-500">
                        <?php
                        $dateTime = new DateTime('now', new DateTimeZone('UTC'));
                        echo $dateTime->format('d-m-Y');
                        ?>
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-6">
                <!-- Summary Section -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-semibold mb-4">Summary</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-gray-700">21</h1>
                            <p class="text-gray-500">No Change</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-red-500">3</h1>
                            <p class="text-gray-500">Out of Stock Everywhere</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-orange-500">6</h1>
                            <p class="text-gray-500">Available in Less than 50% Stores</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-yellow-500">3</h1>
                            <p class="text-gray-500">Available in More than 50% Stores</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-green-500">8</h1>
                            <p class="text-gray-500">Available in All Stores</p>
                        </div>
                    </div>
                </div>

                <!-- Price Section -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-semibold mb-4">Price Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-red-600">321,47</h1>
                            <p class="text-gray-500">Current Price</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-yellow-500">270,07</h1>
                            <p class="text-gray-500">Minimum Price (Average)</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-green-500">288,67</h1>
                            <p class="text-gray-500">Average Price</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-pink-500">316,16</h1>
                            <p class="text-gray-500">Maximum Price (Average)</p>
                        </div>
                    </div>
                </div>

                <!-- Stock Information -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-semibold mb-4">Stock Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-red-500">75</h1>
                            <p class="text-gray-500">Discounted Items (Total)</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-orange-500">20</h1>
                            <p class="text-gray-500">Out of Stock Items (Total)</p>
                        </div>
                    </div>
                </div>

                <!-- Price Fluctuation -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-semibold mb-4">Price Fluctuation</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-red-500">0</h1>
                            <p class="text-gray-500">Price Fluctuation Index</p>
                            <p class="text-gray-500">-0.85</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-pink-500">0</h1>
                            <p class="text-gray-500">Price Volatility Index</p>
                            <p class="text-gray-500">-0.85</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg shadow-sm text-center">
                            <h1 class="text-3xl font-bold text-green-500">0</h1>
                            <p class="text-gray-500">Available Volatility Index</p>
                            <p class="text-gray-500">0</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-200 text-center py-4 font-semibold uppercase">AB-Project (No Specific Updates)</div>
        </div>
    </div>
</body>
@endsection

@section('scripts')
<script>
    // Add any JavaScript or jQuery code here if needed
</script>
@endsection