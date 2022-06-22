<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InicioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientesController;

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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('/',
    [DashboardController::class,
    'index'])->name('dashboard.index');

Route::get('/clientes',
    [ClientesController::class, 'index'])
    ->name('clientes.index');

Route::get('/clientes/create',
    [ClientesController::class, 'create'])
    ->name('clientes.create');

Route::post('/clientes',
    [ClientesController::class, 'store'])
    ->name('clientes.store');

Route::get('/clientes/{id}/edit',
    [ClientesController::class, 'edit'])
    ->name('clientes.edit');

Route::put('/clientes/{id}',
    [ClientesController::class, 'update'])
    ->name('clientes.update');

Route::delete('/clientes/{id}',
    [ClientesController::class, 'destroy'])
    ->name('clientes.destroy');


