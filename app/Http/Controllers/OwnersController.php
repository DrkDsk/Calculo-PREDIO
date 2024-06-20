<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOwnerRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\OwnerResource;
use App\Models\Owner;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class OwnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request): Response
    {
        $search = $request->get('search', '');

        $results = Owner::query();
        if ($search) {
            $results->where('name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('telephone', 'like', '%' . $search . '%')
                ->orWhere('RFC', 'like', '%' . $search . '%');

            return Inertia::render('Owners/Index', [
                'owners' => OwnerResource::collection(
                    $results->get()
                ),
                'search' => $search,
            ]);
        }

        return Inertia::render('Owners/Index', [
            'owners' => OwnerResource::collection(
                $results->paginate(10)
            ),
            'search' => $search,
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
        Owner::create($request->validated());
        return redirect()->route('owners.index');
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
    public function edit(Owner $owner): Response
    {
        return Inertia::render('Owners/Edit', [
            'owner' => $owner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateOwnerRequest $request, Owner $owner): RedirectResponse
    {
        $owner->update($request->validated());
        return redirect()->route('owners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner): bool
    {
        try {
            $owner->delete();
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
