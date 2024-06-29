<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterReportRequest;
use App\Models\Balance;
use Inertia\Inertia;
use Inertia\Response;

class ReportsController extends Controller
{
    public function index(FilterReportRequest $request) : Response
    {
        $filters = $request->validated();
        $balances = null;

        if ($filters) {
            $duePaymentYear = $filters['due_payment_year'];
            $monthAtOperationDate = $filters['month_at_operation_date'];

            $balances = [
                [
                  'label' => 'Total de importe a pagar:',
                  'value' => round(
                      Balance::where('year_at_operation_date', $duePaymentYear)
                          ->where('month_at_operation_date', $monthAtOperationDate)
                          ->sum('amount_to_pay'),2),
                ],
                [
                    'label' => 'Total de recargos:',
                    'value' => round(
                        Balance::where('year_at_operation_date', $duePaymentYear)
                            ->where('month_at_operation_date', $monthAtOperationDate)
                            ->sum('surcharge'),2)
                ],
                [
                    'label' => 'Total de actualizaciones:',
                    'value' => round(
                        Balance::where('year_at_operation_date', $duePaymentYear)
                            ->where('month_at_operation_date', $monthAtOperationDate)
                            ->sum('updated_charge'),2)
                ]
            ];
        }

        return Inertia::render('Reports/Index', [
            'balances' => $balances,
            'request' => $request,
        ]);
    }
}
