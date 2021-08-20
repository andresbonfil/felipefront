<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;


<<<<<<< HEAD
Route::get('/', function () { return view('inicio'); })->name('inicio');

Route::get('registrarse', function () { return view('registrarse'); })->name('registrarse');
Route::get('recontra', function () { return view('recontra'); })->name('recontra');

RoutuRoute::post('loginPost', [InicioController::class, 'loginPost'])->name('loginPost');
Route::post('registrarsePost', [InicioController::class, 'registrarsePost'])->name('registrarsePost');
Route::post('recontraPost', [InicioController::class, 'recontraPost'])->name('recontraPost');
=======
Route::get('/', InicioController::class)->name('inicio');
Route::get('registrarse', function () { return view('registrarse'); })->name('registrarse');
Route::get('recontra', function () { return view('recontra'); })->name('recontra');

Route::post('/', [InicioController::class, 'inicioPost'])->name('inicioPost');
Route::post('registrarse', [InicioController::class, 'registrarsePost'])->name('registrarsePost');
Route::post('recontraPost', [InicioController::class, 'recontraPost'])->name('recontraPost');

Route::get('comprador', function () { return view('comprador.inicio'); })->name('vendedor');

Route::get('vendedor', function () { return view('vendedor.inicio'); })->name('comprador');

Route::get('logout', [InicioController::class, 'logout'])->name('logout');
>>>>>>> 49766a00134158ddca5fff8198d9f4e13d958564
