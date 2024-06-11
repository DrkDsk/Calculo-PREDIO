<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOwnerRequest;
use App\Models\Propietario;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $owners = Propietario::paginate(10);
        return Inertia::render('Owners/Index', [
            'owners' => $owners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Owners/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOwnerRequest $request): RedirectResponse
    {
        Propietario::create($request->validated());
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
    public function edit(Propietario $propietario): Response
    {
        return Inertia::render('Owners/Edit', [
            'owner' => $propietario
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateOwnerRequest $request, Propietario $propietario): RedirectResponse
    {
        $propietario->update($request->validated());
        return redirect()->route('propietarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Propietario $propietario): bool
    {
        try {
            $propietario->delete();

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
