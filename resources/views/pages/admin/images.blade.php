@extends('components.app-layout')

@section('title','Images')

@section('content')
    <div class="sm:w-full md:w-3/4 lg:w-3/4 container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Images</h1>
            <button onclick="document.getElementById('uploadForm').classList.toggle('hidden')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add Image
            </button>
        </div>
        <div id="uploadForm" class="hidden bg-white shadow-md rounded-lg overflow-hidden p-5 mb-6">
            <form action="{{ route('admin.images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                        Upload GIF
                    </label>
                    <input type="file" name="image" id="image" accept="image/gif" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Upload
                </button>
            </form>
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
                                <a href="{{ route('gif.comments', $md->id) }}" class="text-gray-600 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
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
            <h1 class="font-bold mb-3">My GIFs</h1> 

            @if($gifs->count() > 0)
                <div class="flex flex-wrap -m-2">
                    @foreach ($gifs as $gif)
                        <div class="relative w-1/3 m-2 p-2 border-2 border-gray-300 rounded-lg">
                            <div class="h-[200px]">
                                <img src="{{ asset('storage/images/'.$gif->image) }}" alt="Gif Image" 
                                    class="w-full h-full object-cover rounded">
                            </div>
                            
                            <div class="absolute top-0 right-0 p-2 flex gap-2">
                                <a href="{{ route('gif.comments', $gif->id) }}" class="text-gray-600 hover:text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                    </svg>
                                </a>
                                <button onclick="showUpdateForm('{{ $gif->id }}', '{{ $gif->image }}')" 
                                    class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-sm">
                                    Edit
                                </button>
                                <form action="{{ route('admin.images.destroy', $gif->id) }}" method="POST" class="inline" 
                                    onsubmit="return confirm('Are you sure you want to delete this image?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Update Form Modal -->
                <div id="updateModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Update Image</h3>
                            <form id="updateForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="update_image">
                                        New GIF
                                    </label>
                                    <input type="file" name="image" id="update_image" accept="image/gif" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" onclick="closeUpdateModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Cancel
                                    </button>
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    function showUpdateForm(id, currentImage) {
                        const modal = document.getElementById('updateModal');
                        const form = document.getElementById('updateForm');
                        form.action = `/admin/images/${id}`;
                        modal.classList.remove('hidden');
                    }

                    function closeUpdateModal() {
                        document.getElementById('updateModal').classList.add('hidden');
                    }
                </script>
            @else
                <p class="text-gray-500 text-center py-4">No GIF images available.</p>
            @endif
        </div>
    </div>
@endsection 