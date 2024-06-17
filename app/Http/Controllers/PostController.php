<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Méthode pour afficher les posts
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Méthode pour créer un nouveau post
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|max:180',
        ]);

        $post = new Post([
            'body' => $request->body,
        ]);
        $request->user()->posts()->save($post);

        return redirect()->route('posts.index');
    }

    // Méthode pour liker un post
    public function like(Post $post)
    {
        if (!$post->isLikedBy(Auth::user())) {
            $post->likes()->attach(Auth::id());
        }
        return back();
    }

    // Méthode pour unliker un post
    public function unlike(Post $post)
    {
        if ($post->isLikedBy(Auth::user())) {
            $post->likes()->detach(Auth::id());
        }
        return back();
    }
}
