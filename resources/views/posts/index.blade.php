
@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <form action="{{ route('posts.store') }}" method="POST" class="bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    <div class="mb-4">
                        <label for="body" class="block text-gray-700 dark:text-gray-200 text-sm font-bold mb-2">Post</label>
                        <textarea name="body" id="body" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700  leading-tight focus:outline-none focus:shadow-outline" maxlength="180" required></textarea>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Post
                        </button>
                    </div>
                </form>
            </div>

            <div class="timeline">
                @foreach($posts as $post)
                    <div class="post bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <p class="text-gray-700 dark:text-gray-200">{{ $post->body }}</p>
                        <small class="text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</small>
                        <div class="mt-2">
                            @if($post->isLikedBy(auth()->user()))
                                <form action="{{ route('posts.unlike', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-500 dark:text-red-400">Unlike</button>
                                </form>
                            @else
                                <form action="{{ route('posts.like', $post) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-500 dark:text-blue-400">Like</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
