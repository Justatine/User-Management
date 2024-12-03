@extends('components.app-layout')

@section('title','Images')

@section('content')
    <div class="sm:w-full md:w-3/4 lg:w-3/4 container mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Images</h1>
        </div>

        @include('partials.alerts')
        <div class="bg-white shadow-md rounded-lg overflow-hidden p-5">
            <h1 class="font-bold mb-3">Top Downloaded Gifs</h1> 
            @if($mostDownloaded->count() > 0)
                <div class="flex flex-wrap -m-2">
                    @foreach ($mostDownloaded as $md)
                        <div class="relative w-1/3 m-2 p-2 border-2 border-gray-300 rounded-lg">
                            <div class="h-[200px]">
                                <img src="{{ asset('storage/images/'.$md->image) }}" alt="Gif Image" 
                                    class="w-full h-full object-cover rounded">
                            </div>
                            <div class="absolute top-0 right-0 p-2">
                                <a href="{{ route('gif.download', $md->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">
                                    Download
                                </a>
                            </div>
                            <div class="mt-2 text-sm text-gray-600 flex justify-between">
                                <span>Downloads: {{ $md->download_count }}</span>
                                <span>Designer: {{ $md->user_name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No GIF images available.</p>
            @endif
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden p-5">
            <h1 class="font-bold mb-3">Giphy Images</h1>
            @if($gifs->count() > 0)
                <div class="flex flex-wrap -m-2">
                    @foreach ($gifs as $gif)
                        <div class="relative w-1/3 m-2 p-2 border-2 border-gray-300 rounded-lg">
                            <div class="h-[200px]">
                                <img src="{{ asset('storage/images/'.$gif->image) }}" alt="Gif Image" 
                                    class="w-full h-full object-cover rounded">
                            </div>
                            <div class="absolute top-0 right-0 p-2 flex gap-2">
                                <button onclick="toggleFavorite({{ $gif->id }}, event)" 
                                    class="favorite-btn bg-white hover:bg-gray-100 text-red-500 border border-gray-300 p-1 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        id="heart-icon-{{ $gif->id }}" 
                                        class="h-5 w-5" 
                                        fill="{{ auth()->user()->favorites()->where('gif_id', $gif->id)->exists() ? 'currentColor' : 'none' }}" 
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                                <a href="{{ route('gif.comments', $gif->id) }}" 
                                    class="bg-white hover:bg-gray-100 text-gray-600 border border-gray-300 p-1 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        class="h-5 w-5" 
                                        fill="none" 
                                        viewBox="0 0 24 24" 
                                        stroke="currentColor">
                                        <path stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            stroke-width="2" 
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </a>
                                <a href="{{ route('gif.download', $gif->id) }}" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded text-sm">
                                    Download
                                </a>
                            </div>
                            <div class="mt-2 text-sm text-gray-600 flex justify-between">
                                <span>Downloads: {{ $gif->download_count }}</span>
                                <span>Designer: {{ $gif->user_name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">No GIF images available.</p>
            @endif
        </div>
    </div>
@endsection 

@push('scripts')
<script>
function toggleFavorite(gifId, event) {
    event.preventDefault();
    const heartIcon = document.querySelector(`#heart-icon-${gifId}`);
    
    fetch(`/favorites/${gifId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'added') {
            heartIcon.setAttribute('fill', 'currentColor');
        } else {
            heartIcon.setAttribute('fill', 'none');
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
@endpush 