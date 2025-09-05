<?php

use App\Http\Controllers\ProviderController;
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
// routes/web.php
Route::get('/', function () {
    return view('welcome');
});

// Provider Routes
Route::get('providers', [ProviderController::class, 'index'])->name('providers.index');
Route::get('providers/{provider:slug}', [ProviderController::class, 'show'])->name('providers.show');

