<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\CompradorController;

Route::get('/', function () { return view('inicio'); })->name('inicio');
Route::get('registrarse', function () { return view('registrarse'); })->name('registrarse');
Route::get('recontra', function () { return view('recontra'); })->name('recontra');
Route::post('inicioPost', [InicioController::class, 'inicioPost'])->name('inicioPost');
Route::post('registrarsePost', [InicioController::class, 'registrarsePost'])->name('registrarsePost');
Route::post('recontraPost', [InicioController::class, 'recontraPost'])->name('recontraPost');
Route::get('logout', [InicioController::class, 'logout'])->name('logout');
//-------------------------------------------------------------------------------------------
Route::post('addproducto',[VendedorController::class, 'addproducto'])->name('addproducto');
//-------------------------------------------------------------------------------------------
Route::get('vervender/{id}',[CompradorController::class, 'vervender'])->name('vervender');
Route::post('add2detalle',[CompradorController::class, 'add2detalle'])->name('add2detalle');

