<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function get_date()
    {
        return Carbon::parse($this->date_vente)->format('d / m / Y - H : i : s');
    }

    public function get_montant()
    {
        return number_format((float)$this->montant_totale, 2, ",", " ");
    }

    public function get_prix()
    {
        return number_format((float)$this->prix_unitaire, 2, ",", " ");
    }

    public function get_quantite()
    {
        return number_format((float)$this->quantite_vendu, 3, ",", " ");
    }
}
