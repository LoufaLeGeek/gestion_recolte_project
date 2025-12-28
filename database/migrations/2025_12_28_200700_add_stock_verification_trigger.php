<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pour SQLite uniquement
        if (config('database.default') === 'sqlite') {

            // Trigger 1: Validation à l'insertion
            DB::statement("
                CREATE TRIGGER IF NOT EXISTS validate_produit_insert
                BEFORE INSERT ON produits
                BEGIN
                    -- Vérifier nom non vide
                    SELECT CASE
                        WHEN TRIM(NEW.nom_produit) = ''
                        THEN RAISE(ABORT, 'Le nom du produit est obligatoire.')
                    END;

                    -- Vérifier description non vide
                    SELECT CASE
                        WHEN TRIM(NEW.description_produit) = ''
                        THEN RAISE(ABORT, 'La description du produit est obligatoire.')
                    END;

                    -- Vérifier longueur minimale description
                    SELECT CASE
                        WHEN LENGTH(TRIM(NEW.description_produit)) < 5
                        THEN RAISE(ABORT, 'La description doit contenir au moins 5 caractères.')
                    END;

                    -- Vérifier unicité du nom (insensible à la casse)
                    SELECT CASE
                        WHEN EXISTS (
                            SELECT 1 FROM produits
                            WHERE LOWER(TRIM(nom_produit)) = LOWER(TRIM(NEW.nom_produit))
                        )
                        THEN RAISE(ABORT, 'Un produit avec ce nom existe déjà. Choisissez un nom différent.')
                    END;
                END;
            ");

            // Trigger 2: Validation à la mise à jour
            // On sépare les vérifications en plusieurs triggers pour éviter la complexité
            DB::statement("
                CREATE TRIGGER IF NOT EXISTS validate_produit_update_not_empty
                BEFORE UPDATE ON produits
                FOR EACH ROW
                WHEN TRIM(NEW.nom_produit) = '' OR TRIM(NEW.description_produit) = ''
                BEGIN
                    SELECT RAISE(ABORT, 'Le nom et la description du produit sont obligatoires.');
                END;
            ");

            DB::statement("
                CREATE TRIGGER IF NOT EXISTS validate_produit_update_min_length
                BEFORE UPDATE ON produits
                FOR EACH ROW
                WHEN LENGTH(TRIM(NEW.description_produit)) < 5
                BEGIN
                    SELECT RAISE(ABORT, 'La description doit contenir au moins 5 caractères.');
                END;
            ");

            DB::statement("
                CREATE TRIGGER IF NOT EXISTS validate_produit_update_unique
                BEFORE UPDATE ON produits
                FOR EACH ROW
                WHEN (
                    OLD.nom_produit != NEW.nom_produit
                    AND EXISTS (
                        SELECT 1 FROM produits
                        WHERE LOWER(TRIM(nom_produit)) = LOWER(TRIM(NEW.nom_produit))
                        AND id != NEW.id
                    )
                )
                BEGIN
                    SELECT RAISE(ABORT, 'Un autre produit avec ce nom existe déjà. Choisissez un nom différent.');
                END;
            ");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (config('database.default') === 'sqlite') {
            DB::statement('DROP TRIGGER IF EXISTS validate_produit_insert;');
            DB::statement('DROP TRIGGER IF EXISTS validate_produit_update_not_empty;');
            DB::statement('DROP TRIGGER IF EXISTS validate_produit_update_min_length;');
            DB::statement('DROP TRIGGER IF EXISTS validate_produit_update_unique;');
        }
    }
};
