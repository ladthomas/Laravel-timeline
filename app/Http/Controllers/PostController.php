<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Méthode pour afficher les posts
    public function index()
    {
        // Récupère les posts les plus récents avec les informations de l'utilisateur qui les a créés, paginés par 10
        $posts = Post::with('user')->latest()->paginate(10);
        // Retourne la vue 'posts.index' avec les posts
        return view('posts.index', compact('posts'));
    }

    // Méthode pour créer un nouveau post
    public function store(Request $request)
    {
        // Valide la requête pour s'assurer que le champ 'body' est requis et ne dépasse pas 180 caractères
        $request->validate([
            'body' => 'required|max:180',
        ]);

        // Crée un nouveau post avec le contenu du champ 'body'
        $post = new Post([
            'body' => $request->body,
        ]);

        // Associe et enregistre le post avec l'utilisateur authentifié
        $request->user()->posts()->save($post);

        // Redirige vers la route 'posts.index' après la création du post
        return redirect()->route('posts.index');
    }

    // Méthode pour liker un post
    public function like(Post $post)
    {
        // Vérifie si l'utilisateur authentifié n'a pas déjà liké le post
        if (!$post->isLikedBy(Auth::user())) {
            // Ajoute un like au post pour l'utilisateur authentifié
            $post->likes()->attach(Auth::id());
        }

        // Retourne à la page précédente
        return back();
    }

    // Méthode pour unliker un post
    public function unlike(Post $post)
{
    // Récupère l'utilisateur authentifié
    $userId = Auth::id();

    // Vérifie et retire le like si l'utilisateur a liké le post
    if ($post->likes()->where('user_id', $userId)->exists()) {
        $post->likes()->detach($userId);

        // Message de succès
        return redirect()->back()->with('status', 'Vous avez retiré votre like de ce post.');
    }

    // Message d'erreur si l'utilisateur n'a pas liké le post
    return redirect()->back()->withErrors('Vous n\'avez pas liké ce post.');
}

}
