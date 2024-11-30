@extends('components.app-layout')

@section('title','Images')

@section('content')
    <div class="sm:w-full md:w-3/4 lg:w-3/4 container mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Images</h1>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-5">
            @include('partials.alerts')

            @if($gifs->count() > 0)
                @foreach ($gifs as $gif)
                    <div class="relative inline-block w-1/3 m-2">
                        <img src="{{ asset('storage/images/'.$gif->image) }}" alt="Gif Image" class="w-full h-auto border-2 border-gray-200 rounded">
                        <div class="absolute top-0 right-0 p-2">
                            <a href="{{ asset('storage/images/'.$gif->image) }}" download class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">
                                Download
                            </a>
                        </div>
                        <div class="mt-2 text-sm text-gray-600">
                            Designer: {{ $gif->user_name }}
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500 text-center py-4">No GIF images available.</p>
            @endif
        </div>
    </div>
@endsection 