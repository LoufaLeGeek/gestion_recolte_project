<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable = [
        "nom_produit",
        "description_produit",
    ];

    public function varietees()
    {
        return $this->hasMany(Varietee::class);
    }
}
