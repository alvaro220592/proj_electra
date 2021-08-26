<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

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

/* Route::get('/', function () {
    return view('index');
}); */

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); */

Route::middleware(['auth:sanctum', 'verified'])->group( function(){
    
    Route::get('/', [ClientController::class, 'index'])->name('index');
    
    Route::get('/clients/cadastro-get', [ClientController::class, 'create'])->name('clients/cadastro-get');

    Route::get('/clients/cadastro-post', [ClientController::class, 'create'])->name('clients/cadastro-post');

    Route::post('clients/store', [ClientController::class, 'store'])->name('clients/store');
});
