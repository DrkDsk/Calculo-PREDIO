<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBalanceRequest;
use App\Models\Balance;
use App\Models\Terreno;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class CalculosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Terreno $terreno)
    {
        return Inertia::render('Calculos/Create',[
            'ground' => $terreno
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveBalanceRequest $request)// : RedirectResponse
    {
        Balance::create($request->validated());
        return redirect()->route('propietarios.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveBalanceRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
