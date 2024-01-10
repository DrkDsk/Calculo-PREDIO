<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSurchargeRequest;
use App\Models\FederalSurcharge;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class SurchargeController extends Controller
{
    public function index() : Response
    {
        $federalSurcharges = FederalSurcharge::all();

        return Inertia::render('TasaRecargos/Index', [
            'federalSurcharges' => $federalSurcharges
        ]);
    }

    public function create(): Response
    {
        $federalSurcharges = FederalSurcharge::all();

        return Inertia::render('TasaRecargos/Create', [
            'federalSurcharges' => $federalSurcharges
        ]);
    }

    public function store(CreateSurchargeRequest $request) : RedirectResponse
    {
        $matchedData = $request->validated();
        $year = $matchedData['year'];
        FederalSurcharge::firstOrCreate(['year' => $year ], $matchedData);
        return redirect()->back();
    }
}
