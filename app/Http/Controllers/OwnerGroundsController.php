<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroundRequest;
use App\Models\Ground;
use App\Models\Owner;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class OwnerGroundsController extends Controller
{

    public function index(Owner $owner): Response
    {
        return Inertia::render('Owners/Grounds/Index',[
            'grounds' => $owner->grounds()->paginate(10),
            'owner'  => $owner
        ]);
    }
    public function create(Owner $owner):Response
    {
        return Inertia::render('Owners/Grounds/Create', [
            'types' => Ground::TypesAllowed,
            'owner' => $owner
        ]);
    }

    public function store(Owner $owner, CreateGroundRequest $request): RedirectResponse
    {
        Ground::create([
            'owner_id'     => $owner->id,
            'direction'    => $request->validated('direction'),
            'grant_number' => $request->validated('grant_number'),
            'square_meter' => $request->validated('square_meter'),
            'type' => $request->validated('type')
        ]);

        return redirect()->route('owners.grounds.index', $owner->id);
    }
}
