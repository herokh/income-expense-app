<?php

use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettitngsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [ReportController::class, 'index'])->name('home');

    Route::prefix('income')->group(function () {
        Route::get('create', [IncomeController::class, 'create'])->name('create-income');
        Route::post('store', [IncomeController::class, 'store'])->name('store-income');
    });

    Route::prefix('expense')->group(function () {
        Route::get('create', [ExpenseController::class, 'create'])->name('create-expense');
        Route::post('store', [ExpenseController::class, 'store'])->name('store-expense');
    });

    Route::prefix('settings')->group(function () {
        Route::get('index', [SettitngsController::class, 'index'])->name('settings');
    });
});


Auth::routes();
