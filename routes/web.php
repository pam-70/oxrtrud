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



Auth::routes();
//Route::get('/', function () {
 //   return view('home');
//});
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/run_test', ['as' => 'run_test', 'uses' => 'TestController@runtest']);
Route::match(['get', 'post'], '/run_test', ['as' => 'run_test', 'uses' => 'TestController@runtest']);
Route::match(['get', 'post'], '/edit_test', ['as' => 'edit_test', 'uses' => 'AdminController@edittest']);//addanswer
Route::match(['get', 'post'], '/add_answer', ['as' => 'add_answer', 'uses' => 'AdminController@addanswer']);//addtxt
Route::match(['get', 'post'], '/add_txt', ['as' => 'add_txt', 'uses' => 'AdminController@addtxt']);//addtxt
Route::match(['get', 'post'], '/exp_txt', ['as' => 'exp_txt', 'uses' => 'AdminController@exptxt']);
Route::match(['get', 'post'], '/add_rezult', ['as' => 'add_rezult', 'uses' => 'TestController@addrezult']);//all_quest
Route::match(['get', 'post'], '/all_quest', ['as' => 'all_quest', 'uses' => 'TestController@allquest']);//view_compl
Route::match(['get', 'post'], '/view_compl', ['as' => 'view_compl', 'uses' => 'TestController@viewcompl']);//swon_result
Route::match(['get', 'post'], '/swon_result', ['as' => 'swon_result', 'uses' => 'TestController@swonresult']);//adm_updat
Route::match(['get', 'post'], '/adm_updat', ['as' => 'adm_updat', 'uses' => 'AdminController@admupdat']);//showlist
Route::match(['get', 'post'], '/show_list', ['as' => 'show_list', 'uses' => 'AdminController@showlist']);//showlist
Route::match(['get', 'post'], '/add_user', ['as' => 'add_user', 'uses' => 'AdminController@adduser']);//updatuser
Route::match(['get', 'post'], '/updat_user', ['as' => 'updat_user', 'uses' => 'AdminController@updatuser']);//updatuser  swon_user
Route::match(['get', 'post'], '/swon_user', ['as' => 'swon_user', 'uses' => 'AdminController@swonuser']);//swon_result
Route::match(['get', 'post'], '/admin_result', ['as' => 'admin_result', 'uses' => 'AdminController@adminresult']);//filter_surname
Route::match(['get', 'post'], '/filter_surname', ['as' => 'filter_surname', 'uses' => 'AdminController@filtersurname']);//print_result
Route::match(['get', 'post'], '/print_result', ['as' => 'print_result', 'uses' => 'AdminController@printresult']);//print_result
Route::match(['get', 'post'], '/print_user', ['as' => 'print_user', 'uses' => 'AdminController@printuser']);//print_result
Route::get('invoices/download', 'InvoiceController@download');