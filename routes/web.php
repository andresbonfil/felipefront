<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\CompradorController;

Route::get('/', function () { return view('inicio'); })->name('inicio');
Route::post('inicioPost', [InicioController::class, 'inicioPost'])->name('inicioPost');
Route::get('registrarse', function () { return view('registrarse'); })->name('registrarse');
Route::post('registrarsePost', [InicioController::class, 'registrarsePost'])->name('registrarsePost');
Route::get('recontra', function () { return view('recontra'); })->name('recontra');
Route::post('recontraPost', [InicioController::class, 'recontraPost'])->name('recontraPost');
Route::get('logout', [InicioController::class, 'logout'])->name('logout');

//-------------------------------------------------------------------------------------------
Route::post('addproducto',[VendedorController::class, 'addproducto'])->middleware('esvendedor')->name('addproducto');
Route::get('pedidosvendor',[VendedorController::class, 'verpedidos'])->middleware('esvendedor')->name('pedidosvendor');
Route::get('detallesvendor/{id}',[VendedorController::class, 'verdetalles'])->middleware('esvendedor')->name('detallesvendor');
Route::get('delproducto',[VendedorController::class, 'delproducto'])->middleware('esvendedor')->name('delproducto');
Route::get('editproducto',[VendedorController::class, 'editproducto'])->middleware('esvendedor')->name('editproducto');
Route::post('updateproducto',[VendedorController::class, 'updateproducto'])->middleware('esvendedor')->name('updateproducto');
//-------------------------------------------------------------------------------------------
Route::get('vervender/{id}',[CompradorController::class, 'vervender'])->middleware('escomprador')->name('vervender');
Route::post('add2detalle',[CompradorController::class, 'add2detalle'])->middleware('escomprador')->name('add2detalle');
Route::get('enviarcotiz',[CompradorController::class, 'enviarcotiz'])->middleware('escomprador')->name('enviarcotiz');
Route::get('pedidos',[CompradorController::class, 'verpedidos'])->middleware('escomprador')->name('pedidos');
Route::get('detalles/{id}',[CompradorController::class, 'verdetalles'])->middleware('escomprador')->name('detalles');
Route::get('deldetalle',[CompradorController::class, 'deldetalle'])->middleware('escomprador')->name('deldetalle');
Route::get('delpedido',[CompradorController::class, 'delpedido'])->middleware('escomprador')->name('delpedido');

