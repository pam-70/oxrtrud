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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/run_test', ['as' => 'run_test', 'uses' => 'TestController@runtest']);
Route::match(['get', 'post'], '/run_test', ['as' => 'run_test', 'uses' => 'TestController@runtest']);
Route::match(['get', 'post'], '/edit_test', ['as' => 'edit_test', 'uses' => 'AdminController@edittest']);//addanswer
Route::match(['get', 'post'], '/add_answer', ['as' => 'add_answer', 'uses' => 'AdminController@addanswer']);//