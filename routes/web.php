<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculosController;
use App\Http\Controllers\OwnersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerGroundsController;
use App\Http\Controllers\GroundsController;
use App\Http\Controllers\BalancesController;
use App\Http\Controllers\SurchargeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('propietarios', OwnersController::class);
Route::resource('terrenos', GroundsController::class)->only(['index']);
Route::resource('propietarios.terrenos', OwnerGroundsController::class)->only(['index', 'store', 'create']);
Route::resource('terrenos.calculos', CalculosController::class)->only(['index', 'create', 'store']);
Route::resource('balances', BalancesController::class)->only(['index', 'show', 'update', 'destroy']);
Route::resource('surcharge', SurchargeController::class)->only(['index', 'create', 'store']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
