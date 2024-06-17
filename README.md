# 📅 Timeline App

Timeline App est une application web de type réseau social construite avec Laravel. Les utilisateurs peuvent créer des comptes, écrire des posts, aimer/ne plus aimer des posts et afficher une timeline de tous les posts. 🚀

## ✨ Fonctionnalités

- 🔐 Authentification avec Laravel Breeze
- 📝 Création, affichage et pagination des posts
- ❤️ Aimer et ne plus aimer des posts
- 🎨 Interface utilisateur construite avec Tailwind CSS

## 🛠️ Prérequis

Avant de commencer, assurez-vous d'avoir installé les outils suivants :

- 🐘 PHP >= 8.0
- 🎼 Composer
- 🌐 Node.js avec npm
- 🗄️ MySQL ou un autre système de gestion de base de données

## ⚙️ Installation

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

## 🚀 Utilisation

1. Démarrez le serveur de développement Laravel :

    ```bash
    php artisan serve
    ```

2. Accédez à l'application dans votre navigateur à l'adresse `http://127.0.0.1:8000`.

3. Créez un compte, connectez-vous et commencez à utiliser l'application.

## 🌐 Routes

- `/` : Redirige vers `/posts` si l'utilisateur est connecté, sinon vers `/login`.
- `/posts` : Affiche la timeline des posts.
- `/profile` : Page de profil utilisateur.
- `/dashboard` : Tableau de bord utilisateur.

## 🔧 Développement

