<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\InformesController;
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

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/productos', [ProductoController::class, 'index']);
Route::post('/delete', [ProductoController::class, 'destroy'])->name('producto.delete');
Route::post('/save', [ProductoController::class, 'store'])->name('producto.save');
Route::post('/edit', [ProductoController::class, 'edit'])->name('producto.edit');
Route::post('/update', [ProductoController::class, 'update'])->name('producto.update');
Route::get('/pedidos', [PedidoController::class, 'index']);
Route::post('/savePedido', [PedidoController::class, 'store'])->name('pedido.save');
Route::get('/informes', [InformesController::class, 'index'])->name('informes.generate');