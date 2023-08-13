<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{
    use HasFactory;
    protected $fillable = [
        'ground_id',
        'amount',
        'updated_charge',
        'surcharge',
        'amount_to_pay',
        'month_at_operation_date',
        'month_of_pay',
        'INCP_at_operation_date',
        'INCP_applied',
        'surcharge_rate'
    ];

    public function ground() : BelongsTo
    {
        return $this->belongsTo(Terreno::class, 'ground_id')->with('owner');
    }
}
