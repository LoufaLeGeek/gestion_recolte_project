<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable = [
        "date_vente",
        "quantite_vendu",
        "prix_unitaire",
        "montant_totale",
        "varietee_id"
    ];

    protected $casts = [
        'date_vente' => 'datetime',
        'quantite_vendu' => 'decimal:3',
        'prix_unitaire' => 'decimal:2',
        'montant_totale' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function varietee()
    {
        return $this->belongsTo(Varietee::class);
    }

}
