<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Stock extends Model
{
    protected $fillable = [
        "quantite_actuelle",
        "varietee_id",
    ];

    protected $casts = [
        'quantite_actuelle' => 'decimal:3',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function varietee()
    {
        return $this->belongsTo(Varietee::class);
    }

    public function get_update_date()
    {
        return Carbon::parse($this->updated_at)->format('d / m / Y - H : i : s');
    }
}
