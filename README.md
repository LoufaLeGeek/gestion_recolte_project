# 📦 Projet Laravel – Plateforme de gestion (branche `dev`)

## 🧭 Présentation
Ce projet est une application web développée avec **Laravel**, destinée à fournir une plateforme moderne de gestion.
Il s’appuie sur **Oracle Database (OCI8)** côté backend et sur **Tailwind CSS v4 + DaisyUI** côté frontend.

> ⚠️ **Important**
> La branche **`main` est protégée et intouchable**.
> Tout le développement doit se faire **exclusivement sur la branche `dev`**.

---

## 🧩 Stack technique

### Backend
- Laravel
- Oracle Database (OCI8)
- Extension PHP OCI8

### Frontend
- Tailwind CSS v4
- DaisyUI (**composants uniquement**)
- Livewire

---

## 🔒 Règles Git
- ❌ Aucun commit direct sur `main`
- ✅ Toute contribution se fait depuis `dev`
- ✅ Les merges vers `main` sont contrôlés et validés

---

## 🚀 Installation du projet

### 1. Cloner le dépôt
```bash
git clone <url-du-repository>
cd <nom-du-projet>
```

### 2. Se positionner sur la branche `dev`
```bash
git checkout dev
```

### 3. Installer les dépendances PHP
```bash
composer install
```

### 4. Installer les dépendances Frontend
```bash
npm install
npm run dev
```

---

## ⚙️ Configuration de l’environnement

```bash
cp .env.example .env
php artisan key:generate
```

---

## 🗄️ Configuration Oracle (OCI8)

```env
# Configuration Oracle
DB_CONNECTION=oracle
DB_HOST=127.0.0.1
DB_PORT=1521
DB_DATABASE=XEPDB1
DB_USERNAME=laravel_user
DB_PASSWORD=VotreMotDePasse123
DB_SERVICE_NAME=XEPDB1
```

### Prérequis Oracle
- Oracle XE installé et démarré
- Service `XEPDB1` actif
- Extension PHP OCI8 installée
- Utilisateur Oracle avec les droits nécessaires

---

## 🧬 Migrations
```bash
php artisan migrate
```

---

## ▶️ Lancer le serveur
```bash
php artisan serve
```

Accès :
http://127.0.0.1:8000

---

## 🎨 Interface utilisateur (UI)

### DaisyUI
- Utilisé uniquement pour les composants :
  - button
  - card
  - modal
  - alert
  - badge
  - input / select / textarea
- Aucun thème DaisyUI n’est utilisé

### Couleurs
- Les couleurs sont définies directement dans `resources/css/app.css`
- Indépendantes des thèmes DaisyUI
- Basées sur Tailwind CSS v4 (`@theme`)

---

## 📌 Contribution
1. Partir de la branche `dev`
2. Créer une branche de travail
3. Tester localement
4. Proposer une merge request vers `dev`
