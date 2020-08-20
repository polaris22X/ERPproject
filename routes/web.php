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

/*Route::get('/organization/add', function () {
    return view('organization/addorganization');
});*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('organization', 'organizationController@index');
Route::get('organization/add','organizationController@add');
Route::get('organization/main/{id}','organizationController@main');
Route::get('organization/menu/','organizationController@menu');
Route::get('organization/status','organizationController@status');
Route::post('organization','organizationController@store');

Route::get('income', 'incomeController@index');
Route::get('income/insert', 'incomeController@insert');
Route::post('income/insert', 'incomeController@store');

Route::post('income/partner','partnerController@store');
Route::post('income/product','productController@store');

