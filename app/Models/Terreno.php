<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Terreno extends Model
{
    use HasFactory;
    protected $table = 'grounds';
    protected $fillable = ['owner_id', 'direction', 'grant_number', 'square_meter'];

    public function owner() : BelongsTo
    {
        return $this->belongsTo(Propietario::class, 'owner_id');
    }
}
