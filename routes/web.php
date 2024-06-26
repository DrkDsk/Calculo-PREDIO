<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroundBalanceController;
use App\Http\Controllers\OwnersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OwnerGroundsController;
use App\Http\Controllers\GroundsController;
use App\Http\Controllers\BalancesController;
use App\Http\Controllers\SurchargeController;
use App\Http\Controllers\FileSystemController;

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

Route::resource('owners', OwnersController::class);
Route::resource('grounds', GroundsController::class)->only(['index','show','edit','update', 'destroy']);
Route::resource('owners.grounds', OwnerGroundsController::class)->only(['index','store','create']);
Route::resource('grounds.balances', GroundBalanceController::class)->only(['index', 'create', 'store']);
Route::resource('balances', BalancesController::class)->only(['index', 'show', 'update', 'destroy']);
Route::resource('surcharge', SurchargeController::class)->only(['index', 'create', 'store']);
Route::resource('files', FileSystemController::class)->only(['create', 'store']);
Route::get('reports', [ReportsController::class, 'index'])->name('reports.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
