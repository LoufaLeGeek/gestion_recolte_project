<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Perte extends Model
{
    protected $fillable = [
        "date_perte",
        "quantite_perdu",
        "montant_estime",
        "motif",
        "varietee_id",
    ];

    protected $casts = [
        'date_perte' => 'datetime',
        'quantite_perdu' => 'decimal:3',
        'montant_estime' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function get_quantite_perdue()
    {
        return number_format((float)$this->quantite_perdu, 3, ",", " ");
    }

    public function get_mantant_estimer()
    {
        return number_format((float)$this->montant_estime, 2, ",", " ");
    }

    public function get_date_perte()
    {
        return Carbon::parse($this->date_perte)->format('d / m / Y - H : i : s');
    }

    public function varietee()
    {
        return $this->belongsTo(Varietee::class);
    }
}
