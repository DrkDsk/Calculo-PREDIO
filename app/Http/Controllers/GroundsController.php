<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroundOwnerRequest;
use App\Models\Terreno;
use App\Models\Propietario;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class GroundsController extends Controller
{
    public function create(Propietario $propietario):Response
    {
        return Inertia::render('Grounds/Create', [
            'owner' => $propietario
        ]);
    }

    public function store(Propietario $propietario, CreateGroundOwnerRequest $request): RedirectResponse
    {
        Terreno::create([
            'owner_id'     => $propietario->id,
            'direction'    => $request->validated('direction'),
            'grant_number' => $request->validated('grant_number'),
            'square_meter' => $request->validated('square_meter')
        ]);

        return redirect()->route('owners.index');
    }
}
