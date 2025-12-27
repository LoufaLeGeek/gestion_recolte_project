# Entites :

1. Produit(id, nom, description)
2. Variete(id, nom, prix, caracteristiques)
3. Recolte(id, date, quantite)
4. Vente(id, date, quantite, montant)
5. Perte(id, quantite, montant, motif)
6. Historique_Prix(date, prix)
7. Stock(id,quantite)


# Relations :

1. Produit (1.1) -> (1.n) Variete #one to many
2. Variete(1.1) -> (1.n)Recolte  #one to many
3. Variete(1.1) -> (0.n)Vente  #one to many
4. Variete(1.1) -> (1.1)Stock #one to one
5. Variete(1.1) -> (0.n)Perte #one to many
6. Variete(1.1) -> (1.n)Historique_Prix #one to many


# Regles de Gestion
1. une Variete appartient a un seul Produitd.
2. Un Produit peut avoir plusieurs Variete
3. Une Recolte concerne une seule Variete.
4. Une Variete peut etre recoltee plusieurs fois.
5. Une vente concerne une seule Variete.
6. Une Variete peut etre vendue plusieurs fois.
7. Une Perte concerne une seule Variete.



# Technologies

1. Backend : Laravel, Livewire,
2. Frontend : Laravel Blade + Tailwind CSS, daisy UI, Livewire Chart, Chart JS, Shadcn UI,
3. Base de donnee: Oracle XE 21C,Oracle Instant Client 21(Basic, SDK), DataGrip


# Fonctionnalite

1. CRUD pour Produit  -> Mohamed Ndiaye

2. CRUD pour Varietes + Ajouter une Variete  -> Yacine Sarr

3. Gestions des recoltes -> Fallou Thiam



# Perspectives

1.
2. Etude de l'evolution du prix

# Emploi du Temps


Lundi - Mercredi - Vendredi : A partir 21h30

#### Reglement Intereur :
- Toutes les Classes doivent etre nommees en **PascalCase**;
- Toute methode doit etre nommee en **camelCase**;
- Toute variable doit etre nommee en **snake_case**;
- Toute ligne doit etre **commentee**;
- Toute page doit etre bien **formatee**
- L'emploi du temps doit etre rigoureusement **respecte**.
