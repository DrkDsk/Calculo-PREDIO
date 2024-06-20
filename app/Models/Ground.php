<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ground extends Model
{
    use HasFactory;
    protected $fillable = ['owner_id', 'direction', 'grant_number', 'square_meter', 'type'];

    const TypesAllowed = ['Protección', 'Ornato', 'General', 'Sector Primario'];

    public function owner() : BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }
}
