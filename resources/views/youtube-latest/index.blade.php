@extends('layouts.app')

@section('title')
    YouTube Latest - Get permanent link to your latest video - Taste The Code Toolbox
@endsection

@section('content')
    <div class="w-full lg:w-11/12  mx-auto">
        <p class="mb-4 p-3">YouTube Latest is a tool that creates a permanent link to your latest YouTube video. All you need to do is paste your YouTube channel ID in the field below and enter your preferred URL.</p>

        @if (session('error'))
            <div class="bg-red-200 my-6">
                {{ session('error') }}
            </div>
        @endif
        @if (session('success'))
            <div class="bg-green-200 my-6">
                {{ session('success') }}
            </div>
        @endif

    </div>
    <youtube-latest recaptcha_key="{{ config('app.recaptcha_key') }}"></youtube-latest>


    <p class="mb-4 p-3">This tool is provided free of charge and its code can be found together with the rest of my tools on the <a  class="text-blue-400 hover:text-blue-600" href="https://github.com/bkolicoski/ttc-tools">GitHub repo</a>. However, hosting costs me money and for that, any donation is more than welcomed. </p>
    <p class="text-center">
        <button class="px-2 py-1 border-2 rounded-lg hover:bg-blue-100 active:bg-blue-200 outline-none active:outline-none focus:outline-none" onclick="window.location.href = 'https://www.patreon.com/taste_the_code'">
            <i class="fab fa-patreon"></i> Become a Patron
        </button>
        <button class="px-2 py-1 border-2 rounded-lg hover:bg-blue-100 active:bg-blue-200 outline-none active:outline-none focus:outline-none" onclick="window.location.href = 'https://www.paypal.com/paypalme2/bkolicoski'">
            <i class="fas fa-beer"></i> Buy me a beer
        </button>
        <button class="px-2 py-1 border-2 rounded-lg hover:bg-blue-100 active:bg-blue-200 outline-none active:outline-none focus:outline-none" onclick="window.location.href = 'https://www.dreamhost.com/r.cgi?2405711/promo/dreamsavings50/'">
            <i class="fas fa-server"></i> $50 off Hosting
        </button>
    </p>

@stop

@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('app.recaptcha_key') }}"></script>
@stop
