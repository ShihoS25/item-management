<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::prefix('items')->group(function () {
        Route::get('/', [ItemController::class, 'index']);
        Route::get('/add', [ItemController::class, 'add']);
        Route::post('/add', [ItemController::class, 'add']);
        Route::get('/{id}/edit', [ItemController::class, 'edit']);
        Route::post('/{id}/edit', [ItemController::class, 'update']);
    });
});
