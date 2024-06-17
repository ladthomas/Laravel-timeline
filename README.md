# Timeline App

Timeline App est une application web de type réseau social construite avec Laravel. Les utilisateurs peuvent créer des comptes, écrire des posts, aimer/ne plus aimer des posts et afficher une timeline de tous les posts.

## Fonctionnalités

- Authentification avec Laravel Breeze
- Création, affichage et pagination des posts
- Aimer et ne plus aimer des posts
- Interface utilisateur construite avec Tailwind CSS

## Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants :

- PHP >= 8.0
- Composer
- Node.js avec npm
- MySQL ou un autre système de gestion de base de données

## Installation

1. Clonez le dépôt du projet :

    ```bash
    git clone <url-du-depot>
    cd timeline-app
    ```

2. Installez les dépendances PHP avec Composer :

    ```bash
    composer install
    ```

3. Installez les dépendances JavaScript avec npm :

    ```bash
    npm install
    ```

4. Copiez le fichier `.env.example` en `.env` :

    ```bash
    cp .env.example .env
    ```

5. Générez une clé d'application Laravel :

    ```bash
    php artisan key:generate
    ```

6. Configurez les paramètres de votre base de données dans le fichier `.env` :

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nom_de_votre_base_de_donnees
    DB_USERNAME=nom_utilisateur
    DB_PASSWORD=mot_de_passe
    ```

7. Lancer les migrations pour créer les tables :

    ```bash
    php artisan migrate
    ```

8. Compiler les assets avec Laravel Mix :

    ```bash
    npm run dev
    ```

## Utilisation

1. Démarrez le serveur de développement Laravel :

    ```bash
    php artisan serve
    ```

2. Accédez à l'application dans votre navigateur à l'adresse `http://127.0.0.1:8000`.

3. Créez un compte, connectez-vous et commencez à utiliser l'application.

## Routes

- `/` : Redirige vers `/posts` si l'utilisateur est connecté, sinon vers `/login`.
- `/posts` : Affiche la timeline des posts.
- `/profile` : Page de profil utilisateur.
- `/dashboard` : Tableau de bord utilisateur.

## Développement

### PostController

Le contrôleur `PostController` gère les opérations CRUD pour les posts ainsi que les actions de like et unlike. Voici un extrait du code du contrôleur :

```php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

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

    public function like(Post $post)
    {
        if (!$post->isLikedBy(Auth::user())) {
            $post->likes()->attach(Auth::id());
        }
        return back();
    }

    public function unlike(Post $post)
    {
        if ($post->isLikedBy(Auth::user())) {
            $post->likes()->detach(Auth::id());
        }
        return back();
    }
}
