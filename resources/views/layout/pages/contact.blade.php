@extends('layout.index')

@section('title', 'Contact Us')

@section('style-libraries')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://kit.fontawesome.com/6ef99526a1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<div class="bg-slate-100 flex justify-center py-8">
    <div class="bg-slate-100 rounded-lg shadow-lg w-full max-w-6xl flex flex-wrap justify-center items-center">
        <!-- Left Side: Contact Form -->
        <div class="w-full md:w-1/2 p-8 ">
            <h2 class="text-3xl font-semibold text-center text-black mb-6">Contact Us</h2>
            <form action="" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold pb-2">Your Name</label>
                        <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Name" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 font-semibold pb-2">Your Email</label>
                        <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Email" required>
                    </div>
                    <div>
                        <label for="name" class="block text-gray-700 font-semibold pb-2">Your Phone</label>
                        <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Phone" required>
                    </div>
                    <div>
                        <label for="message" class="block text-gray-700 font-semibold pb-2">Your Message</label>
                        <textarea name="message" id="message" rows="5" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Write your message here..." required></textarea>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="px-6 py-2 bg-black text-white font-semibold rounded-md hover:bg-gray-800 transition-colors duration-300">
                        Send Message
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection