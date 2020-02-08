@extends('layouts.app')

@section('title')
    Link Extractor - Extract hyperlinks form text - Taste The Code Toolbox
@endsection

@section('content')
    <div class="w-full md:w-3/4 mx-auto">
        <p class="mb-4">Link Extractor </p>

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
@stop
