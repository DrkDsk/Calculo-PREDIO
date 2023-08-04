<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terreno extends Model
{
    use HasFactory;
    protected $table = 'grounds';
    protected $fillable = ['owner_id', 'direction', 'grant_number', 'square_meter'];
}
