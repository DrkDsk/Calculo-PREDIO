<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBalanceRequest;
use App\Models\Balance;
use App\Models\Ground;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class GroundBalanceController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ground $ground): Response
    {
        $files = Storage::files('public/excel');
        $assetExcel = null;

        if (count($files)) {
            $assetExcel = asset(Storage::url($files[0]));
        }

        return Inertia::render('Calculos/Create', [
            'ground' => $ground,
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
