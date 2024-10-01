@extends('admin.layouts.dashboard')

@section('title', 'Product History')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<div class="bg-gray-200 min-h-screen">
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg">
            <div class="border-b border-gray-300 bg-gray-50 p-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-3xl font-semibold text-gray-800">Product History</h1>
                    <div class="text-sm text-gray-600">
                        {{ \Carbon\Carbon::now()->format('d-m-Y') }}
                    </div>
                </div>
            </div>
            <div class="p-6 space-y-6">
                <!-- Overview Section -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Overview</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 m-3">
                        @foreach([
                        ['count' => 21, 'color' => 'text-gray-700', 'text' => 'No Change'],
                        ['count' => 3, 'color' => 'text-red-600', 'text' => 'Out of Stock Everywhere'],
                        ['count' => 6, 'color' => 'text-orange-600', 'text' => 'Available in Less than 50% Stores'],
                        ['count' => 3, 'color' => 'text-yellow-600', 'text' => 'Available in More than 50% Stores'],
                        ['count' => 8, 'color' => 'text-green-600', 'text' => 'Available in All Stores']
                        ] as $item)
                        <div class="bg-white p-4 rounded-lg shadow-md text-center">
                            <h1 class="text-4xl font-bold {{ $item['color'] }}">{{ $item['count'] }}</h1>
                            <p class="text-gray-500">{{ $item['text'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Price Information -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Price Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach([
                        ['price' => '321,47', 'color' => 'text-red-600', 'label' => 'Current Price'],
                        ['price' => '270,07', 'color' => 'text-yellow-600', 'label' => 'Minimum Price (Average)'],
                        ['price' => '288,67', 'color' => 'text-green-600', 'label' => 'Average Price'],
                        ['price' => '316,16', 'color' => 'text-pink-600', 'label' => 'Maximum Price (Average)']
                        ] as $price)
                        <div class="bg-white p-4 rounded-lg shadow-md text-center">
                            <h1 class="text-4xl font-bold {{ $price['color'] }}">{{ $price['price'] }}</h1>
                            <p class="text-gray-500">{{ $price['label'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Stock Information -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Stock Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach([
                        ['count' => 75, 'color' => 'text-red-600', 'label' => 'Discounted Items (Total)'],
                        ['count' => 20, 'color' => 'text-orange-600', 'label' => 'Out of Stock Items (Total)']
                        ] as $stock)
                        <div class="bg-white p-4 rounded-lg shadow-md text-center">
                            <h1 class="text-4xl font-bold {{ $stock['color'] }}">{{ $stock['count'] }}</h1>
                            <p class="text-gray-500">{{ $stock['label'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Price Fluctuation -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Price Fluctuation</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach([
                        ['index' => '0', 'color' => 'text-red-600', 'label' => 'Price Fluctuation Index', 'value' => '-0.85'],
                        ['index' => '0', 'color' => 'text-pink-600', 'label' => 'Price Volatility Index', 'value' => '-0.85'],
                        ['index' => '0', 'color' => 'text-green-600', 'label' => 'Available Volatility Index', 'value' => '0']
                        ] as $fluctuation)
                        <div class="bg-white p-4 rounded-lg shadow-md text-center">
                            <h1 class="text-4xl font-bold {{ $fluctuation['color'] }}">{{ $fluctuation['index'] }}</h1>
                            <p class="text-gray-500">{{ $fluctuation['label'] }}</p>
                            <p class="text-gray-500">{{ $fluctuation['value'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="bg-gray-300 text-center py-4 font-semibold text-gray-800 uppercase">AB-Project (No Specific Updates)</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add any JavaScript or jQuery code here if needed
</script>
@endsection