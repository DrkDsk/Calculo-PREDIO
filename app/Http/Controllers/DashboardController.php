<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Owner;
use App\Models\Ground;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Dashboard', [
            'owners'       => Owner::paginate(10),
            'groundsCount' => Ground::count(),
            'fullBalance'  => Balance::sum('amount_to_pay')
        ]);
    }
}
