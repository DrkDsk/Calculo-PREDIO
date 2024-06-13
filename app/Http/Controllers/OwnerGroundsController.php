<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroundRequest;
use App\Models\Terreno;
use App\Models\Propietario;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class OwnerGroundsController extends Controller
{

    public function index(Propietario $propietario): Response
    {
        return Inertia::render('Owners/Grounds/Index',[
            'grounds' => $propietario->grounds()->paginate(10),
            'owner'  => $propietario
        ]);
    }
    public function create(Propietario $propietario):Response
    {
        return Inertia::render('Owners/Grounds/Create', [
            'types' => Terreno::TypesAllowed,
            'owner' => $propietario
        ]);
    }

    public function store(Propietario $propietario, CreateGroundRequest $request): RedirectResponse
    {
        Terreno::create([
            'owner_id'     => $propietario->id,
            'direction'    => $request->validated('direction'),
            'grant_number' => $request->validated('grant_number'),
            'square_meter' => $request->validated('square_meter'),
            'type' => $request->validated('type')
        ]);

        return redirect()->route('propietarios.terrenos.index', $propietario->id);
    }
}
