@extends('layouts.app')

@section('title')
    Youtube Sight - Subscribers counter from YouTube Analytics API - Taste The Code Toolbox
@endsection

@section('content')
    <div class="text-left w-full md:w-3/4 mx-auto">
        <h2 class="text-xl py-6">YouTube Sight Privacy Policy</h2>

        <p class="mb-4"><strong>What we collect?</strong><br>
        In order to function properly, YouTube Sight collects your YouTube channel ID and your channel name on the first connection of the application. Once the application is connected none of the statistical data used to present the analytics dashboard is persisted or stored in any way.</p>

        <p class="mb-4">The application also stores an access token that we can then use to retrieve data from the YouTube APIs at times when you are not logged into the browser so the application can be used with IoT devices like subscriber counters.</p>

        <p class="mb-4"><strong>How data is used?</strong><br>
        The stored channel ID is used as an indicator for the retrieval of statistical data for your channel by accessing the API URL but no channel identification data is presented. This ID can be later used to provide statistical information about who uses the application, without explicitly identifying the channel ID and name.</p>

        <p class="mb-8"><strong>What data do we share?</strong><br>
        YouTube Sight will not share any of the stored data with anyone. The software is provided as a tool for channel owners to use it for their own channels to create devices that need to display their own data. The API URL is only visible to you and you can choose to share this information publicly if you want on your own responsibility.</p>

        <p class="mb-4">Additionally to this, the application is subject to the <a href="https://policies.google.com/privacy" class="text-blue-400 hover:text-blue-600" target="_blank">Google Privacy Policy</a>. To revoke access to the aplication, you can visit the <a href="https://myaccount.google.com/permissions" class="text-blue-400 hover:text-blue-600" target="_blank">Google security settings</a> page for your account.</p>

    </div>
@stop
