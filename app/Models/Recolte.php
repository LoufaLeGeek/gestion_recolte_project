<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recolte extends Model
{
    protected $fillable = [
        "date_recolte",
        "quantite_recolte",
        "varietee_id",
    ];

    protected $casts = [
        'date_recolte' => 'datetime',
        'quantite_recolte' => 'decimal:3',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function varietee()
    {
        return $this->belongsTo(Varietee::class);
    }
}
