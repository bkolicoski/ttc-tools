@extends('layouts.app')

@section('title')
    Youtube Sight - Subscribers counter from YouTube Analytics API - Taste The Code Toolbox
@endsection

@section('content')
    <div class="text-center w-full md:w-3/4 mx-auto">
        <h1 class="text-youtube-red font-bold text-4xl md:text-6xl mt-4 md:mt-16 mb-8">Sight for YouTube</h1>
        <p class="mb-4">YouTube Sight is an application that connects with the YouTube Analytics API to provide you with a service that can extract detailed subscribers data for your channel.</p>

        <p class="mb-4">After the <a class="text-blue-400 hover:text-blue-600" href="https://support.google.com/youtube/thread/6543166?msgid=13119244" target="_blank">announcement</a> from YouTube that they will no longer provide real-time data for subscribers count and the
            <a class="text-blue-400 hover:text-blue-600" href="https://www.youtube.com/watch?v=sHNI-WgN-UQ" target="_blank">constatation</a> that all of the subscribers counters built will no longer work I’ve built this gateway that once you authorize it, it gives you an API endpoint that you can call from your project and retrieve the subscriber count. Check out the <a href="https://github.com/bkolicoski/youtube-sight-example" class="text-blue-400 hover:text-blue-600" target="_blank">examples repository</a> for examples on how you can use it.</p>

        <p class="mb-4">To start, click on the button below to login with YouTube and after successful authorization, you will be presented with stats for your channel and the URL at which you can connect with your device.</p>

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

        <a href="{{ route('youtube-sight.login') }}" class="bg-gray-100 hover:bg-blue-200 text-gray-800 font-bold px-4 rounded-lg inline-flex items-center mt-10 mb-4 shadow-lg focus:outline-none focus:shadow-outline">
            <i class="fab fa-youtube fill-current m-2 mr-4 text-youtube-red text-6xl"></i>
            <span class="text-lg pr-4">Connect with YouTube</span>
        </a>

        <p class="text-sm">* This tool does not collect or keep your data in any way. The data is retrieved and immediately relayed to you for your own use. <br> ** Because of the way the YouTube Analytics API works and
            <a class="text-blue-400 hover:text-blue-600" href="https://stackoverflow.com/questions/13018142/latency-with-youtube-analytics-api" target="_blank">aggregates data</a>, the stats displayed are usually delayed by at least one day and do not represent the real time situation from YouTube Creator Studio. </p>
    </div>
@stop
