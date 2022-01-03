<?php

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

use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::resource('services', 'ServiceController');
Route::resource('users', 'UserController');
Route::resource('seniorList', 'SeniorListController');
Route::resource('fav', 'FavController');
Route::get('fav/{fav}/favAdd', 'FavController@favAdd')->name('fav.favAdd');

Route::get('/services/signin', [App\Http\Controllers\ServiceController::class, 'index'])->name('signin.index');
Route::post('/services/signin', [App\Http\Controllers\ServiceController::class, 'postSignIn'])->name('services.postSignin');
Route::get('/services/signup', [App\Http\Controllers\ServiceController::class, 'signup'])->name('services.signup'); //ログイン
Route::post('/services/signup', [App\Http\Controllers\ServiceController::class, 'store'])->name('services.store');//アカウント登録
