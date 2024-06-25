<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGroundRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Ground;
use App\Http\Resources\GroundResource;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class GroundsController extends Controller
{
    public function index(SearchRequest $request): Response
    {
        $search = $request->get('search', '');
        $results = Ground::query();

        if ($search) {
            $results->where('direction', 'like', '%' . $search . '%')
            ->orWhere('grant_number', 'like', '%' . $search . '%')
            ->orWhere('square_meter', 'like', '%' . $search . '%')
            ->orWhere('type', 'like', '%' . $search . '%');

            return Inertia::render('Grounds/Index', [
                'grounds' => GroundResource::collection(
                    $results->with('owner')
                        ->orderBy('created_at', 'DESC')
                        ->get()
                ),
                'search' => $search,
            ]);
        }

        return Inertia::render('Grounds/Index', [
            'grounds' => GroundResource::collection(
                $results->with('owner')
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10)
            ),
            'search' => $search
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

    public function update(CreateGroundRequest $request, Ground $ground): RedirectResponse
    {
        $ground->update($request->validated());
        return redirect()->route('grounds.index');
    }

    public function show(Ground $ground): Response
    {
        $balances = $ground->balances()->paginate(5);

        return Inertia::render('Grounds/Show', [
            'ground' => new GroundResource($ground),
            'balances' => $balances,
        ]);
    }
}
