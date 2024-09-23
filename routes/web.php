<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SearchController;

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
        Route::get('/', [ItemController::class, 'index']);               // 一覧画面
        Route::get('/add', [ItemController::class, 'add']);              // 登録画面
        Route::post('/add', [ItemController::class, 'add']);             // 登録
        Route::get('/{id}/edit', [ItemController::class, 'edit']);       // 編集画面
        Route::post('/{id}/edit', [ItemController::class, 'update']);    // 更新
        Route::get('/{id}/delete', [ItemController::class, 'delete']);   // 削除
        Route::get('/search', [ItemController::class, 'search']);        // 検索画面
        Route::get('/search/result', [ItemController::class, 'result']); // 検索結果
        Route::get('/export', [ItemController::class, 'export']);        // CSV出力
    });
});