<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth'])->name('home');

Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('/expenses', [App\Http\Controllers\ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create', [App\Http\Controllers\ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses', [App\Http\Controllers\ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}/edit', [App\Http\Controllers\ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}', [App\Http\Controllers\ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}', [App\Http\Controllers\ExpenseController::class, 'destroy'])->name('expenses.destroy');

    Route::get('/incomes', [App\Http\Controllers\IncomeController::class, 'index'])->middleware('admin_access')->name('incomes.index');

});