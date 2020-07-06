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

Route::get('/', function () {
    return view('welcome');
});
// Controllerを動かすためにルーティング機能
// Route::resource() : リソースコントローラにより処理されるアクションをルーティング
// todo に対して、httpメソッドやパスでアクセスできるようにルーティング
Route::resource('todo', 'TodoController');

// php artisan make:authで追加されたもの
// 認証機能に関するルーティングがまとめられている
// routes() : Illuminate\Support\Facades\Authに記述
Auth::routes();

// php artisan make:authで追加されたもの
// GETリクエストに対してのルーティングを定義
Route::get('/home', 'HomeController@index')->name('home');
