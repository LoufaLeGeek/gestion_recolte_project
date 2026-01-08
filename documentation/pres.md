# 🌱 Gestion Agricole – Projet SQL & Laravel

## 📄 Description du Projet

Ce projet consiste à développer un système de gestion des récoltes, ventes et stocks pour une exploitation agricole.  
L'objectif est de suivre les produits cultivés, leurs variétés, les quantités récoltées, les ventes, ainsi que les pertes éventuelles, le tout automatisé grâce à des triggers Oracle et une interface Laravel pour la gestion.

Le projet est réalisé dans le cadre du cours **Bases de Données Avancées (Licence 3, Semestre 5)** à l'UFR Sciences et Technologies (SET), Sénégal, année académique 2025-2026:contentReference[oaicite:0]{index=0}.

---

## 📋 Sommaire

1. [Prérequis](#prérequis)  
2. [Triggers – Explications](#triggers---explications)  
3. [Script SQL Complet](#script-sql-complet)  
4. [Modèle Conceptuel et Relationnel](#modèle-conceptuel-et-relationnel)  
5. [Notes d’Utilisation](#notes-dutilisation)  

---

## ⚙️ Prérequis

Avant d'exécuter les requêtes SQL, assurez-vous de :

1. Avoir installé Oracle ou PostgreSQL comme SGBDR.
2. Avoir configuré Laravel et exécuté la migration initiale :

```bash
php artisan migrate:fresh
```
Vérifier la connexion à la base de données dans le fichier .env.

🔄 Triggers – Explications
Trois triggers Oracle automatisent la gestion des stocks après chaque action sur les tables recoltes, ventes et pertes.
1. after_recolte_insert
Déclenchement : Après chaque insertion dans recoltes.
Fonctionnement :
Si le stock existe, ajoute la quantité récoltée.
Sinon, crée une nouvelle ligne de stock.
Utilisation de NVL(quantite_actuelle, 0) pour gérer les valeurs NULL.
2. after_vente_insert
Déclenchement : Après chaque insertion dans ventes.
Fonctionnement :
Déduit automatiquement la quantité vendue du stock.
Responsabilité Laravel : Vérifier la disponibilité avant l’insertion.
3. after_perte_insert
Déclenchement : Après chaque insertion dans pertes.
Fonctionnement :
Déduit automatiquement la quantité perdue du stock.
Responsabilité Laravel : Vérifier la disponibilité avant l’insertion.

📝 Script SQL Complet
Le script complet, incluant triggers, insertions de produits, variétés, récoltes et prix, est fourni ci-dessous.
NB : Exécutez les requêtes dans l’ordre présenté pour éviter les erreurs de clé étrangère.
-- Voir le script complet fourni dans le projet (triggers, insertions produits, variétés, récoltes, prix)


🗂 Modèle Conceptuel et Relationnel
Le modèle est basé sur les entités suivantes :
Produit : id, nom, description
Varietee : id, nom, caractéristique, produit_id
Recolte : id, date_recolte, quantite_recoltee, varietee_id
PrixVarietee : id, date_debut, date_fin, prix, varietee_id
Stock : id, quantite_actuelle, varietee_id
Vente : id, date_vente, quantite_vendu_kg, prix_unitaire_kg, montant_total, varietee_id
Perte : id, date_perte, quantite_perdu_kg, motif, montant_estime, varietee_id
Relations principales :
Un produit peut avoir plusieurs variétés
Une variété peut avoir plusieurs récoltes, stocks, ventes, prix et pertes

📌 Notes d’Utilisation
Toutes les requêtes ont été testées et validées.
Les triggers mettent automatiquement à jour les stocks.
Laravel doit valider la disponibilité des quantités avant les insertions de ventes et pertes.
Le dashboard Laravel permet de visualiser :
les rendements journaliers, mensuels et annuels
les ventes et stocks invendus
des graphiques et KPI interactifs

🖥 Interface Laravel
L’application front-end fournit :
Distribution statistique des récoltes, ventes et pertes
Recherches paramétrées sur produits, variétés, périodes
Dashboard avec filtres, graphiques et indicateurs clés

📚 Références
Étude de cas : Gestion comptable de la production agricole d’un étudiant-entrepreneur
Modèle entité-association du projet
