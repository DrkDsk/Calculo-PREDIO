<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBalanceRequest;
use App\Models\Balance;
use App\Models\Terreno;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CalculosController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Terreno $terreno): Response
    {
        $assetExcel = asset('storage/excel/CALCULO ZOFEMAT 2024.xlsx');

        return Inertia::render('Calculos/Create', [
            'ground' => $terreno,
            'excelUrl' => $assetExcel
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveBalanceRequest $request): RedirectResponse
    {
        $months = [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ];

        $matchedData = [
            'month_at_operation_date' => $months[$request->get('month_at_operation_date') -1],
            'month_of_pay' => $months[$request->get('month_of_pay') -1],
        ];

        $matchedData = array_merge($request->validated(), $matchedData);
        Balance::create($matchedData);

        return redirect()->route('balances.index');
    }
}
