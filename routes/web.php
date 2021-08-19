<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;

Route::get('/', InicioController::class)->name('inicio');
Route::get('registrarse', function () { return view('registrarse'); })->name('registrarse');
Route::get('recontra', function () { return view('recontra'); })->name('recontra');

Route::post('login', [InicioController::class, 'login'])->name('login');
Route::post('registrarse', [InicioController::class, 'registrarsePost'])->name('registrarsePost');
Route::post('recontraPost', [InicioController::class, 'recontraPost'])->name('recontraPost');

Route::get('comprador', function () { return view('comprador.inicio'); })->name('vendedor');

Route::get('vendedor', function () { return view('vendedor.inicio'); })->name('comprador');