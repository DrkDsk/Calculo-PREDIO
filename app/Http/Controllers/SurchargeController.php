<?php

namespace App\Http\Controllers;

use App\Models\FederalSurcharge;
use Illuminate\Http\Request;
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
        return Inertia::render('TasaRecargos/Create');
    }

    public function store()
    {

    }
}
