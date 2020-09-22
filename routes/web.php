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
Route::get('income/quotation/list','quotationController@index');
Route::get('income/quotation/create','quotationController@create');
Route::post('income/quotation/create','quotationController@preview');
Route::get('income/quotation/accept','quotationController@acceptlist');
Route::get('income/invoice/','invoiceController@index');
Route::get('income/invoice/create','invoiceController@create');
Route::get('income/receipt/','receiptController@index');
Route::get('income/receipt/create','receiptController@create');
Route::get('income/receipt/{idincome}','receiptController@createreceipt');
Route::get('income/receipt/show/pdf/{idreceipt}','receiptController@createpdf');
Route::get('income/invoice/{idincome}','invoiceController@createinvoice');
Route::get('income/receipt/show/{idreceipt}','receiptController@show');
Route::get('income/invoice/show/{idinvoice}','invoiceController@show');
Route::get('income/invoice/show/pdf/{idinvoice}','invoiceController@createpdf');
Route::get('income/quotation/{idincome}','quotationController@createQuotation');
Route::get('income/quotation/accept/{idincome}','quotationController@acceptprocess');
Route::get('income/quotation/show/{idquotation}','quotationController@show');
Route::get('income/quotation/show/pdf/{idquotation}','quotationController@createpdf');

//expenses
Route::get('expenses', 'expensesController@index');
Route::get('expenses/list', 'expensesController@list');
Route::get('expenses/insert', 'expensesController@insert');

//เพิ่มข้อมูลPartner
Route::post('income/partner','partnerController@store');
//เพิมข้อมูลProduct
Route::post('income/product','productController@store');






