@extends('components.app-layout')

@section('title', 'GIF Comments')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden p-5">
        <div class="flex gap-8">
            <!-- Left Column - Image -->
            <div class="w-1/2">
                <div class="sticky top-8">
                    <img src="{{ asset('storage/images/'.$gif->image) }}" 
                        alt="Gif Image" 
                        class="w-full h-auto object-cover rounded">
                </div>
            </div>

            <!-- Right Column - Comments -->
            <div class="w-1/2">
                <h2 class="text-2xl font-bold mb-4">Comments</h2>
                
                <!-- Comment Form -->
                <div class="mb-6">
                    <form action="{{ route('comments.store', $gif->id) }}" method="POST">
                        @csrf
                        <textarea 
                            name="content" 
                            rows="3" 
                            class="w-full border border-gray-300 rounded p-2 mb-2" 
                            placeholder="Add a comment..."></textarea>
                        <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </button>
                    </form>
                </div>

                <!-- Comments List -->
                <div class="space-y-4 max-h-[600px] overflow-y-auto">
                    @forelse($comments as $comment)
                        <div class="flex justify-between items-start border-b border-gray-200 pb-4">
                            <div class="flex-1">
                                <p class="text-gray-800">{{ $comment->content }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    By {{ $comment->user->name }} 
                                    <span class="mx-1">•</span> 
                                    {{ $comment->created_at->format('M d, Y') }}
                                </p>
                            </div>
                            @if($comment->user_id === auth()->id())
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="text-red-500 hover:text-red-700 ml-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" 
                                            class="h-5 w-5" 
                                            fill="none" 
                                            viewBox="0 0 24 24" 
                                            stroke="currentColor">
                                            <path stroke-linecap="round" 
                                                stroke-linejoin="round" 
                                                stroke-width="2" 
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No comments yet. Be the first to comment!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 