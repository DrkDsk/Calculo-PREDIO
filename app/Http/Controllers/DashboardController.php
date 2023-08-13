<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use App\Models\Terreno;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $owners       = Propietario::paginate(10);
        $groundsCount = Terreno::count();
        $ownersCount  = Propietario::count();
        return Inertia::render('Dashboard', [
            'owners'       => $owners,
            'groundsCount' => $groundsCount,
            'ownersCount'  => $ownersCount
        ]);
    }
}
