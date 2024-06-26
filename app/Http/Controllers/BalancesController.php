<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBalanceRequest;
use App\Models\Balance;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class BalancesController extends Controller
{
    public function index() : Response
    {
        return Inertia::render('Calculos/Index', [
            'balances' => Balance::with('ground')
                ->orderBy('created_at', 'DESC')
                ->paginate(10)
        ]);
    }

    public function show(Balance $balance): Response
    {
        return Inertia::render('Calculos/Show',[
            'ground' => $balance->ground,
            'balance' => $balance
        ]);
    }

    public function update(Balance $balance, SaveBalanceRequest $request): RedirectResponse
    {
        $balance->update($request->validated());
        return redirect()->route('balances.index');
    }

    public function destroy(Balance $balance): bool
    {
        try {
            $balance->delete();

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
