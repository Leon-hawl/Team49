<?php
 
use Illuminate\Support\Facades\Route;
 
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
 
 Route::get('/', function () {
     return view('welcome');
});
 
Route::get('/services/signin', [App\Http\Controllers\ServiceController::class, 'index'])->name('signin.index');
Route::post('/services/signin', [App\Http\Controllers\ServiceController::class, 'postSignin'])->name('services.postSignin');
Route::get('/services/signup', [App\Http\Controllers\ServiceController::class, 'signup'])->name('services.signup'); //ログイン
Route::post('/services/signup', [App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');//アカウント登録