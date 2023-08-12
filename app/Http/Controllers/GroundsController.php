<?php

namespace App\Http\Controllers;

use App\Models\Terreno;
use Illuminate\Http\Request;

class GroundsController extends Controller
{
    public function index()
    {
        return Terreno::all();
    }
}
