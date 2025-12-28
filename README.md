📦 Projet Laravel – Plateforme de gestion (branche dev)
🧭 Présentation

Ce projet est une application web développée avec Laravel, destinée à fournir une plateforme moderne de gestion.
Il s’appuie sur Oracle Database (OCI8) côté backend et sur Tailwind CSS v4 + DaisyUI côté frontend.

⚠️ Important
La branche main est protégée et intouchable.
Tout le développement doit se faire exclusivement sur la branche dev.

🧩 Stack technique
Backend

Laravel

Oracle Database (OCI8)

PHP OCI8 Extension

Frontend

Tailwind CSS v4

DaisyUI (composants uniquement)

Livewire

🔒 Règles Git

❌ Aucun commit direct sur main

✅ Toute contribution se fait depuis dev

✅ Les merges vers main sont contrôlés et validés

🚀 Installation du projet
1. Cloner le dépôt
git clone <url-du-repository>
cd <nom-du-projet>

2. Se positionner sur la branche dev
git checkout dev


Vérifiez la branche active :

git branch

3. Installer les dépendances PHP
composer install

4. Installer les dépendances Frontend
npm install
npm run dev

⚙️ Configuration de l’environnement

Copiez le fichier d’exemple :

cp .env.example .env


Générez ensuite la clé de l’application :

php artisan key:generate

🗄️ Configuration Oracle (OCI8)

Le projet utilise Oracle Database via OCI8.

Configurez les variables suivantes dans le fichier .env :

# Configuration Oracle
DB_CONNECTION=oracle
DB_HOST=127.0.0.1
DB_PORT=1521
DB_DATABASE=XEPDB1
DB_USERNAME=laravel_user
DB_PASSWORD=VotreMotDePasse123
DB_SERVICE_NAME=XEPDB1

Prérequis Oracle

Oracle XE installé et démarré

Service XEPDB1 actif

Extension PHP OCI8 installée et activée

L’utilisateur Oracle doit disposer des droits nécessaires (connect, resource, quota)

🧬 Migrations

Une fois la base configurée :

php artisan migrate


⚠️ Assurez-vous que l’utilisateur Oracle a les privilèges requis avant d’exécuter les migrations.

▶️ Lancer le serveur
php artisan serve


Accès par défaut :

http://127.0.0.1:8000

🎨 Interface utilisateur (UI)
DaisyUI

DaisyUI est utilisé uniquement pour ses composants

Exemples de composants utilisés :

button

card

modal

alert

badge

input / select / textarea

👉 Aucun thème DaisyUI n’est utilisé (data-theme non appliqué).

Gestion des couleurs

Les couleurs ne dépendent pas des thèmes DaisyUI

Elles sont définies directement dans resources/css/app.css

Utilisation des variables CSS via @theme (Tailwind CSS v4)

Cela garantit :

une charte graphique personnalisée

une indépendance vis-à-vis des thèmes DaisyUI

une cohérence UI maîtrisée par le projet

🧠 Notes importantes

Tailwind est configuré en version 4

DaisyUI est utilisé comme bibliothèque de composants uniquement

Toute évolution doit partir de la branche dev

La branche main représente un état stable validé

📌 Contribution

Se baser sur la branche dev

Créer une branche de travail

Tester localement

Proposer une merge request vers dev
