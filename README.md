# Gestion de récolte

## Description
Projet Laravel utilisant Livewire, Tailwind CSS, DaisyUI, Shadcn UI et Oracle (Yajra).

## Prérequis
- PHP 8.2+
- Composer
- Node.js / npm
- Oracle XE 21c
- Oracle Instant Client 21 (Basic et SDK)

## Workflow Git et branches

- `main` : branche stable (ne pas utiliser pour le développement)
- `dev` : branche de développement principale
- `feature/*` : branches pour chaque nouvelle fonctionnalité

⚠️ **Après le clonage du projet, basculer obligatoirement sur la branche `dev`** :

```bash
git clone <repo>
cd <repo>
git checkout dev
git pull origin dev

# Configuration de l'environnement
cp .env.example .env

# Installation des dépendances
composer install
npm install

# Génération de la clé Laravel
php artisan key:generate

# Compilation des assets
npm run dev

# Lancement du serveur local
npm run dev
php artisan serve
