@extends('layouts.app')

@section('title')
    Youtube Sight - Subscribers counter from YouTube Analytics API - Taste The Code Toolbox
@endsection

@section('content')
    <div class="text-center">
        <h1 class="text-youtube-red font-bold text-6xl mt-16 mb-8">Sight for YouTube</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque diam est, varius ut metus eget, pellentesque ornare eros. Ut feugiat est non metus pulvinar, id sagittis ligula efficitur. Maecenas at finibus dolor. Ut sed libero arcu. Quisque facilisis felis cursus nibh sodales blandit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent eget tincidunt tortor, sed rhoncus augue. Pellentesque dui felis, congue in commodo ac, malesuada vitae arcu. Ut lacus sem, aliquam quis massa vel, laoreet maximus odio. Ut in lacinia nulla.</p>
        <p>Nulla facilisi. Sed sed purus sollicitudin, fringilla risus sit amet, semper mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sit amet orci quis odio ullamcorper vulputate. Nulla accumsan aliquam mauris. Fusce faucibus diam enim, ut bibendum lorem feugiat aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum ultricies eros a maximus accumsan. Aliquam hendrerit dui dolor, sit amet egestas ex aliquet sit amet. Nullam odio arcu, pellentesque at diam eu, feugiat sollicitudin nunc. Fusce suscipit urna vel faucibus luctus. Integer sit amet diam imperdiet, fringilla nulla id, gravida justo.</p>

        @if (session('error'))
            <div class="bg-red-200 my-6">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('youtube-sight.login') }}" class="bg-gray-100 hover:bg-blue-200 text-gray-800 font-bold px-4 rounded-lg inline-flex items-center mt-10 shadow-lg focus:outline-none focus:shadow-outline">
            <i class="fab fa-youtube fill-current m-2 mr-4 text-youtube-red text-6xl"></i>
            <span class="text-lg pr-4">Connect with YouTube</span>
        </a>
    </div>
@stop
