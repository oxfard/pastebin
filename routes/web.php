<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\DB;

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
Auth::routes(['verify' => true]);

Route::group(['middleware'=>'guest'], function() {
    Route::get('/vk/auth', [App\Http\Controllers\SocialController::class, 'index']);
    Route::get('/vk/auth/callback', [App\Http\Controllers\SocialController::class, 'callback']);
});

Route::get('/',  [App\Http\Controllers\PastebinController::class, 'index'])->name('index');
Route::post('/',  [App\Http\Controllers\PastebinController::class, 'store'])->name('store');
Route::get('/my', [App\Http\Controllers\PastebinController::class, 'my'])->middleware('auth')->name('my');

Route::get('/edit/{paste}', [App\Http\Controllers\PastebinController::class, 'edit'])->middleware('auth')->name('edit');
Route::put('/edit/{paste}', [App\Http\Controllers\PastebinController::class, 'update'])->middleware('auth')->name('update');

Route::get('/{paste}',  [App\Http\Controllers\PastebinController::class, 'show'])->name('show');



//DB::listen(function($query) {
//    var_dump($query->sql, $query->bindings);
//});
