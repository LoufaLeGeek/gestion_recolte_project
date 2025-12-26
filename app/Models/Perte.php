<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perte extends Model
{
    protected $fillable = [
        "date_perte",
        "quantite_perdu",
        "montant_estime",
        "motif"
    ];

    protected $casts = [
        'date_perte' => 'datetime',
        'quantite_perdu' => 'decimal:3',
        'montant_estime' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function varietee()
    {
        return $this->belongsTo(Varietee::class);
    }
}
