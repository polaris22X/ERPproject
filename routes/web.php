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

//Income
Route::get('income', 'incomeController@index');
Route::get('income/list','incomeController@list');
Route::get('income/insert', 'incomeController@insert');
Route::post('income/insert', 'incomeController@store');
Route::get('income/update/{idincome}','incomeController@update');
Route::post('income/update', 'incomeController@updatedo');
Route::post('getpartner','incomeController@getpartner');

//Quotation
Route::get('income/quotation/list','quotationController@index');
Route::get('income/quotation/create','quotationController@create');
Route::post('income/quotation/create','quotationController@preview');
Route::get('income/quotation/accept','quotationController@acceptlist');
Route::get('income/quotation/{idincome}','quotationController@createQuotation');
Route::get('income/quotation/accept/{idincome}','quotationController@acceptprocess');
Route::get('income/quotation/show/{idquotation}','quotationController@show');
Route::get('income/quotation/show/pdf/{idquotation}','quotationController@createpdf');

//Salesman
Route::get('sale/','saleController@index');

//เพิ่มข้อมูลPartner
Route::post('income/partner','partnerController@store');
//เพิมข้อมูลProduct
Route::post('income/product','productController@store');






