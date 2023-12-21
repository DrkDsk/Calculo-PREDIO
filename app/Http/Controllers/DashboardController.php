<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Propietario;
use App\Models\Terreno;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'owners'       => Propietario::paginate(10),
            'groundsCount' => Terreno::count(),
            'fullBalance'  => Balance::sum('amount_to_pay')
        ]);
    }
}
