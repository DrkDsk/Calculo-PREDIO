<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroundRequest;
use App\Models\Terreno;
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

    public function edit(Terreno $terreno): Response
    {
        return Inertia::render('Grounds/Edit', [
            'types' => Terreno::TypesAllowed,
            'ground' => $terreno,
            'owner' => $terreno->owner
        ]);
    }

    public function update(CreateGroundRequest $request, Terreno $terreno)
    {
        $terreno->update($request->validated());
        return redirect()->route('terrenos.index');
    }
}
