<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBalanceRequest;
use App\Models\Balance;
use App\Models\Terreno;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CalculosController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Terreno $terreno): Response
    {
        return Inertia::render('Calculos/Create',[
            'ground' => $terreno
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveBalanceRequest $request): RedirectResponse
    {
        Balance::create($request->validated());
        return redirect()->route('balances.index');
    }
}
