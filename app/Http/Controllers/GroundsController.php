<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroundRequest;
use App\Models\Ground;
use Inertia\Inertia;
use Inertia\Response;

class GroundsController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Grounds/Index', [
            'grounds' => Ground::with('owner')->paginate(10)
        ]);
    }

    public function edit(Ground $ground): Response
    {
        return Inertia::render('Grounds/Edit', [
            'types' => Ground::TypesAllowed,
            'ground' => $ground,
            'owner' => $ground->owner
        ]);
    }

    public function update(CreateGroundRequest $request, Ground $ground)
    {
        $ground->update($request->validated());
        return redirect()->route('grounds.index');
    }
}
