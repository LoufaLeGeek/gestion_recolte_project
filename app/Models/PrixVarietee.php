<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrixVarietee extends Model
{
    protected $fillable = [
        "date_debut",
        "date_fin",
        "prix",
        "varietee_id",
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'prix' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function varietee()
    {
        return $this->belongsTo(Varietee::class);
    }
}
