<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Propietario extends Model
{
    use HasFactory;
    protected $table = 'owners';
    protected $fillable = ['name', 'last_name', 'telephone', 'RFC'];

    public function grounds(): HasMany
    {
        return $this->hasMany(Terreno::class, 'owner_id')->with('owner');
    }
}
