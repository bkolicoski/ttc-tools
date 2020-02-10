@extends('layouts.app')

@section('title')
    Link Extractor - Extract hyperlinks form text - Taste The Code Toolbox
@endsection

@section('content')
    <div class="w-full lg:w-11/12  mx-auto">
        <p class="mb-4 p-3">Link Extractor allows you to extract all of the URL links in any given text. It can work with plain text, HTML or any other text where there are links inside.
            I've build it to help me extract the links I use for my affiliates on the <a  class="text-blue-400 hover:text-blue-600" href="https://www.youtube.com/tastethecode">channel</a>, where on some, only the full HTML is allowed to be copied. </p>

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
    <link-extractor></link-extractor>
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
