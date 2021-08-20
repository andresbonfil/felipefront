<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;


Route::get('/', function () { return view('inicio'); })->name('inicio');

Route::get('registrarse', function () { return view('registrarse'); })->name('registrarse');
Route::get('recontra', function () { return view('recontra'); })->name('recontra');

RoutuRoute::post('loginPost', [InicioController::class, 'loginPost'])->name('loginPost');
Route::post('registrarsePost', [InicioController::class, 'registrarsePost'])->name('registrarsePost');
Route::post('recontraPost', [InicioController::class, 'recontraPost'])->name('recontraPost');
