@extends('components.app-layout')

@section('title', 'Free GIF Images')

@section('content')
    <div class="sm:w-full md:w-3/4 lg:w-3/4 container mx-auto px-4 py-8">        
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-5">
            <h1 class="text-3xl font-bold text-center mb-6">Find Your Perfect GIF</h1>
            
            <div class="max-w-2xl mx-auto text-gray-600 mb-8">
                <p class="mb-4">Welcome to our free GIF image platform! Here you can:</p>
                <ul class="list-disc list-inside space-y-2 mb-6">
                    <li>Search through millions of animated GIFs</li>
                    <li>Download GIFs without any watermarks</li>
                    <li>Use them for personal or commercial projects</li>
                    <li>Share directly to social media</li>
                </ul>
            </div>

            <!-- Search Bar -->
            {{-- <div class="max-w-xl mx-auto mb-8">
                <div class="relative">
                    <input type="text" 
                           placeholder="Search for GIFs..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <button class="absolute right-2 top-2 text-gray-500 hover:text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Categories -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <button class="bg-blue-100 hover:bg-blue-200 text-blue-800 py-2 px-4 rounded-lg">Trending</button>
                <button class="bg-purple-100 hover:bg-purple-200 text-purple-800 py-2 px-4 rounded-lg">Reactions</button>
                <button class="bg-green-100 hover:bg-green-200 text-green-800 py-2 px-4 rounded-lg">Stickers</button>
                <button class="bg-red-100 hover:bg-red-200 text-red-800 py-2 px-4 rounded-lg">Memes</button>
            </div>

            <!-- Placeholder for GIF Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div class="aspect-square bg-gray-100 rounded-lg animate-pulse"></div>
                <div class="aspect-square bg-gray-100 rounded-lg animate-pulse"></div>
                <div class="aspect-square bg-gray-100 rounded-lg animate-pulse"></div>
                <div class="aspect-square bg-gray-100 rounded-lg animate-pulse"></div>
            </div> --}}
        </div>
    </div>
@endsection