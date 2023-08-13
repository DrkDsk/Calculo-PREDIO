<?php

namespace App\Http\Controllers;

use App\Models\Terreno;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GroundsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Grounds/Index', [
            'grounds' => Terreno::with('owner')->paginate(10)
        ]);
    }
}
