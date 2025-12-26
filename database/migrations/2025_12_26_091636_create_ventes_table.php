<?php

use App\Models\Varietee;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->timestamp("date_vente");
            $table->decimal("quantite_vendu", 10, 3);
            $table->decimal("prix_unitaire", 12, 2);
            $table->decimal("montant_totale", 12, 2);
            $table->foreignIdFor(Varietee::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
