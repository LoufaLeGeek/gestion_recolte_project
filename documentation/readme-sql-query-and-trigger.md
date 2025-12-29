# Documentation - Script SQL de Gestion Agricole

## 📋 Sommaire

1. [Prérequis](#prérequis)
2. [Triggers - Explications](#triggers---explications)
3. [Script SQL Complet](#script-sql-complet)

---

## ⚙️ Prérequis

**IMPORTANT** : Avant d'exécuter les requêtes SQL, vous devez impérativement exécuter la commande suivante :

```bash
php artisan migrate:fresh
```

---

## 🔄 Triggers - Explications

Ce système utilise 3 triggers Oracle pour automatiser la gestion des stocks.

### 1. Trigger : `after_recolte_insert`

**Déclenchement** : Après chaque insertion dans la table `recoltes`

**Fonctionnement** :
- Vérifie d'abord si un stock existe déjà pour la variété récoltée
- **Si le stock existe** : ajoute la quantité récoltée au stock existant
- **Si le stock n'existe pas** : crée une nouvelle ligne de stock avec la quantité récoltée
- Utilise `NVL(quantite_actuelle, 0)` pour gérer les valeurs NULL

**Résultat** : Chaque récolte met automatiquement à jour ou crée le stock correspondant.

---

### 2. Trigger : `after_vente_insert`

**Déclenchement** : Après chaque insertion dans la table `ventes`

**Fonctionnement** :
- Déduit automatiquement la quantité vendue du stock de la variété concernée
- Utilise `NVL(quantite_actuelle, 0)` pour gérer les valeurs NULL

**⚠️ Responsabilité Laravel** : L'application Laravel doit vérifier que la quantité commandée est disponible en stock AVANT l'insertion de la vente.

---

### 3. Trigger : `after_perte_insert`

**Déclenchement** : Après chaque insertion dans la table `pertes`

**Fonctionnement** :
- Déduit automatiquement la quantité perdue du stock de la variété concernée
- Utilise `NVL(quantite_actuelle, 0)` pour gérer les valeurs NULL

**⚠️ Responsabilité Laravel** : L'application Laravel doit vérifier que la quantité perdue est disponible en stock AVANT l'insertion de la perte.

---

## 📝 Script SQL Complet

```sql
-- NB : Avant d'ajouter les requete faite un -> php artisan:migrate fresh

-- trigger apres instersion d'une recolte
CREATE OR REPLACE TRIGGER after_recolte_insert
AFTER INSERT ON recoltes
FOR EACH ROW
DECLARE
    v_count NUMBER;
BEGIN
    -- Vérifie si un stock existe pour cette variété
    SELECT COUNT(*) INTO v_count
    FROM stocks
    WHERE varietee_id = :NEW.varietee_id;

    IF v_count > 0 THEN
        -- Stock existant : mise à jour
        UPDATE stocks
        SET quantite_actuelle = NVL(quantite_actuelle, 0) + :NEW.quantite_recolte,
            updated_at = SYSDATE
        WHERE varietee_id = :NEW.varietee_id;
    ELSE
        -- Stock inexistant : création
        INSERT INTO stocks(varietee_id, quantite_actuelle, created_at, updated_at)
        VALUES (:NEW.varietee_id, :NEW.quantite_recolte, SYSDATE, SYSDATE);
    END IF;
END;
/

-- sur le laravel on se charger que verifier que la quantite commander est disponible avant une vente
-- trigger apres insertion d'une vente
CREATE TRIGGER after_vente_insert
AFTER INSERT ON ventes
FOR EACH ROW
BEGIN
    UPDATE stocks
    SET quantite_actuelle = NVL(quantite_actuelle, 0) - :NEW.quantite_vendu
    WHERE varietee_id = :NEW.varietee_id;
END;
/
-- sur le laravel on se charger que verifier que la quantite quantitee perdu  est disponible avant d'enregistrer une perte
-- trigger apres insertion d'une perte
CREATE TRIGGER after_perte_insert
AFTER INSERT ON pertes
FOR EACH ROW
BEGIN
    UPDATE stocks
    SET quantite_actuelle = NVL(quantite_actuelle, 0) - :NEW.quantite_perdu
    WHERE varietee_id = :NEW.varietee_id;
END;
/


-- insertion produit:
-- Insertion de 10 produits avec ID explicite
INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(1, 'Riz', 'Céréale largement cultivée et consommée localement', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(2, 'Maïs', 'Plante céréalière utilisée pour l''alimentation humaine et animale', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(3, 'Mil', 'Céréale résistante à la sécheresse, très cultivée au Sahel', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(4, 'Sorgho', 'Céréale utilisée pour la consommation et la transformation', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(5, 'Arachide', 'Légumineuse riche en huile et protéines', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(6, 'Tomate', 'Plante potagère utilisée fraîche ou transformée', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(7, 'Oignon', 'Légume bulbeux très utilisé dans la cuisine', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(8, 'Pomme de terre', 'Tubercule riche en amidon', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(9, 'Mangue', 'Fruit tropical très apprécié et exporté', SYSDATE, SYSDATE);

INSERT INTO produits (id, nom_produit, description_produit, created_at, updated_at) VALUES
(10, 'Banane', 'Fruit tropical cultivé pour la consommation locale et commerciale', SYSDATE, SYSDATE);





-- Insertion des variétés avec ID explicite et produit_id correspondant
-- Riz (produit_id = 1)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (1, 'Riz IR 841', 'Cycle court, bon rendement, résistant à la sécheresse', 1, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (2, 'Riz Sahel 108', 'Variété améliorée, adaptée aux zones irriguées', 1, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (3, 'Riz Nerica 4', 'Hybride africain et asiatique, haut rendement', 1, SYSDATE, SYSDATE);

-- Maïs (produit_id = 2)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (4, 'Maïs TZEE', 'Variété précoce, tolérante à la sécheresse', 2, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (5, 'Maïs Obatanpa', 'Riche en protéines, bon rendement', 2, SYSDATE, SYSDATE);

-- Mil (produit_id = 3)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (6, 'Mil Souna 3', 'Très résistant à la sécheresse', 3, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (7, 'Mil HKP', 'Cycle court, bonne productivité', 3, SYSDATE, SYSDATE);

-- Sorgho (produit_id = 4)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (8, 'Sorgho Grinkan', 'Bon rendement, tolérant aux maladies', 4, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (9, 'Sorgho CE 151', 'Variété améliorée, cycle moyen', 4, SYSDATE, SYSDATE);

-- Arachide (produit_id = 5)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (10, 'Arachide Fleur 11', 'Cycle court, forte teneur en huile', 5, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (11, 'Arachide 55-437', 'Bonne résistance aux maladies', 5, SYSDATE, SYSDATE);

-- Tomate (produit_id = 6)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (12, 'Tomate Roma', 'Bonne conservation, idéale pour sauce', 6, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (13, 'Tomate Rio Grande', 'Fruits fermes, bon rendement', 6, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (14, 'Tomate Cerise', 'Petits fruits, cycle court', 6, SYSDATE, SYSDATE);

-- Oignon (produit_id = 7)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (15, 'Oignon Violet de Galmi', 'Très apprécié sur le marché', 7, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (16, 'Oignon Blanc', 'Bonne conservation', 7, SYSDATE, SYSDATE);

-- Pomme de terre (produit_id = 8)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (17, 'Pomme de terre Spunta', 'Cycle moyen, bon rendement', 8, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (18, 'Pomme de terre Désirée', 'Chair ferme, bonne conservation', 8, SYSDATE, SYSDATE);

-- Mangue (produit_id = 9)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (19, 'Mangue Kent', 'Très sucrée, exportable', 9, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (20, 'Mangue Keitt', 'Fruits gros, maturation tardive', 9, SYSDATE, SYSDATE);

-- Banane (produit_id = 10)
INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (21, 'Banane Cavendish', 'Variété la plus cultivée', 10, SYSDATE, SYSDATE);

INSERT INTO varietees (id, nom_varietee, caracteristique_varietee, produit_id, created_at, updated_at)
VALUES (22, 'Banane Plantain', 'Utilisée pour cuisson', 10, SYSDATE, SYSDATE);




-- Insertion des récoltes avec ID explicite et varietee_id correspondant

-- Riz IR 841 (varietee_id = 1)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (1, TO_DATE('2024-07-10','YYYY-MM-DD'), 1200.5, 1, SYSDATE, SYSDATE);

INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (2, TO_DATE('2024-10-15','YYYY-MM-DD'), 980.75, 1, SYSDATE, SYSDATE);

-- Riz Sahel 108 (varietee_id = 2)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (3, TO_DATE('2024-07-12','YYYY-MM-DD'), 1500, 2, SYSDATE, SYSDATE);

-- Riz Nerica 4 (varietee_id = 3)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (4, TO_DATE('2024-07-14','YYYY-MM-DD'), 1100.3, 3, SYSDATE, SYSDATE);

-- Maïs TZEE (varietee_id = 4)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (5, TO_DATE('2024-06-20','YYYY-MM-DD'), 900.25, 4, SYSDATE, SYSDATE);

INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (6, TO_DATE('2024-09-18','YYYY-MM-DD'), 850.6, 4, SYSDATE, SYSDATE);

-- Maïs Obatanpa (varietee_id = 5)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (7, TO_DATE('2024-06-22','YYYY-MM-DD'), 1000, 5, SYSDATE, SYSDATE);

-- Mil Souna 3 (varietee_id = 6)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (8, TO_DATE('2024-08-05','YYYY-MM-DD'), 650.5, 6, SYSDATE, SYSDATE);

INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (9, TO_DATE('2024-08-07','YYYY-MM-DD'), 720, 6, SYSDATE, SYSDATE);

-- Mil HKP (varietee_id = 7)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (10, TO_DATE('2024-08-10','YYYY-MM-DD'), 600.3, 7, SYSDATE, SYSDATE);

-- Sorgho Grinkan (varietee_id = 8)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (11, TO_DATE('2024-07-28','YYYY-MM-DD'), 830.45, 8, SYSDATE, SYSDATE);

-- Sorgho CE 151 (varietee_id = 9)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (12, TO_DATE('2024-07-30','YYYY-MM-DD'), 900, 9, SYSDATE, SYSDATE);

-- Arachide Fleur 11 (varietee_id = 10)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (13, TO_DATE('2024-09-10','YYYY-MM-DD'), 540.75, 10, SYSDATE, SYSDATE);

INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (14, TO_DATE('2024-09-12','YYYY-MM-DD'), 620.5, 10, SYSDATE, SYSDATE);

-- Arachide 55-437 (varietee_id = 11)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (15, TO_DATE('2024-09-15','YYYY-MM-DD'), 500, 11, SYSDATE, SYSDATE);

-- Tomate Roma (varietee_id = 12)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (16, TO_DATE('2024-05-15','YYYY-MM-DD'), 300.25, 12, SYSDATE, SYSDATE);

INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (17, TO_DATE('2024-06-01','YYYY-MM-DD'), 280.4, 12, SYSDATE, SYSDATE);

-- Tomate Rio Grande (varietee_id = 13)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (18, TO_DATE('2024-05-18','YYYY-MM-DD'), 350, 13, SYSDATE, SYSDATE);

-- Tomate Cerise (varietee_id = 14)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (19, TO_DATE('2024-05-20','YYYY-MM-DD'), 400.6, 14, SYSDATE, SYSDATE);

-- Oignon Violet de Galmi (varietee_id = 15)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (20, TO_DATE('2024-06-10','YYYY-MM-DD'), 700, 15, SYSDATE, SYSDATE);

-- Oignon Blanc (varietee_id = 16)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (21, TO_DATE('2024-06-12','YYYY-MM-DD'), 680.3, 16, SYSDATE, SYSDATE);

-- Pomme de terre Spunta (varietee_id = 17)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (22, TO_DATE('2024-07-05','YYYY-MM-DD'), 950, 17, SYSDATE, SYSDATE);

-- Pomme de terre Désirée (varietee_id = 18)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (23, TO_DATE('2024-07-07','YYYY-MM-DD'), 1020.75, 18, SYSDATE, SYSDATE);

-- Mangue Kent (varietee_id = 19)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (24, TO_DATE('2024-04-20','YYYY-MM-DD'), 1200, 19, SYSDATE, SYSDATE);

-- Mangue Keitt (varietee_id = 20)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (25, TO_DATE('2024-04-25','YYYY-MM-DD'), 1350.6, 20, SYSDATE, SYSDATE);

-- Banane Cavendish (varietee_id = 21)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (26, TO_DATE('2024-03-15','YYYY-MM-DD'), 1400.5, 21, SYSDATE, SYSDATE);

-- Banane Plantain (varietee_id = 22)
INSERT INTO recoltes (id, date_recolte, quantite_recolte, varietee_id, created_at, updated_at)
VALUES (27, TO_DATE('2024-03-18','YYYY-MM-DD'), 1300, 22, SYSDATE, SYSDATE);
```

---

## 📌 Notes d'Utilisation

- Toutes les requêtes ont été testées et validées
- Exécuter les requêtes dans l'ordre présenté
- Les triggers gèrent automatiquement les stocks après chaque récolte, vente ou perte
- Laravel doit valider les quantités avant les insertions de ventes et pertes
