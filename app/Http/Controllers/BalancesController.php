<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Inertia\Inertia;
use Inertia\Response;

class BalancesController extends Controller
{
    public function index() : Response
    {
        return Inertia::render('Calculos/Index', [
            'balances' => Balance::with('ground')->paginate(10)
        ]);
    }

    public function show(Balance $balance)
    {
        return $balance;
    }
}
