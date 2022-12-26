@extends('layouts.app')

@section('title')
    YouTube Playlist First - Get permanent link to your first video in a playlist - Taste The Code Toolbox
@endsection

@section('content')
    <div class="w-full lg:w-11/12  mx-auto">
        <p class="mb-4 p-3">YouTube Playlist First is a tool that creates a permanent link to the first (top) video inside a YouTube playlist. All you need to do is paste your YouTube playlist ID in the field below and enter your preferred URL.</p>
        <p class="mb-4 p-3">Because of how YouTube works and how this tools works, this tool is best used when newly added videos in the playlist are listed on the top of the playlist.</p>

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
    <youtube-playlist-latest recaptcha_key="{{ config('app.recaptcha_key') }}"></youtube-playlist-latest>


    <p class="mb-4 p-3">This tool is provided free of charge and its code can be found together with the rest of my tools on the <a  class="text-blue-400 hover:text-blue-600" href="https://github.com/bkolicoski/ttc-tools">GitHub repo</a>. However, hosting costs me money and for that, any donation is more than welcomed. </p>
    <p class="text-center">
        <button class="px-2 py-1 border-2 rounded-lg hover:bg-blue-100 active:bg-blue-200 outline-none active:outline-none focus:outline-none" onclick="window.location.href = 'https://www.patreon.com/taste_the_code'">
            <i class="fab fa-patreon"></i> Become a Patron
        </button>
        <button class="px-2 py-1 border-2 rounded-lg hover:bg-blue-100 active:bg-blue-200 outline-none active:outline-none focus:outline-none" onclick="window.location.href = 'https://www.paypal.com/paypalme2/bkolicoski'">
            <i class="fas fa-beer"></i> Donate
        </button>
        <button class="px-2 py-1 border-2 rounded-lg hover:bg-blue-100 active:bg-blue-200 outline-none active:outline-none focus:outline-none" onclick="window.location.href = 'https://www.dreamhost.com/r.cgi?2405711/promo/dreamsavings50/'">
            <i class="fas fa-server"></i> $50 off Hosting
        </button>
    </p>

@stop

@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('app.recaptcha_key') }}"></script>
@stop
