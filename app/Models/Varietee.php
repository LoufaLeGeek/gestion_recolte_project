<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Varietee extends Model
{
    protected $fillable = [
        "nom_varietee",
        "caracteristique_varietee",
        "produit_id",
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function recoltes()
    {
        return $this->hasMany(Recolte::class);
    }

    public function prix_varietees()
    {
        return $this->hasMany(PrixVarietee::class);
    }

    public function prix_actuelle()
    {
        return $this->hasOne(PrixVarietee::class)->whereNull('date_fin');
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }

    public function pertes()
    {
        return $this->hasMany(Perte::class);
    }

        public function getPrixFormateAttribute()
    {
        if ($this->prix_actuelle) {
            return number_format($this->prix_actuelle->prix, 2, ',', ' ') . ' FCFA';
        }
        return 'Non défini';
    }
}
