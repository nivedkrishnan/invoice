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

Route::post('/save', 'HomeController@saveInvoice')->name('save.invoice');

// Route::get('/invoice','InvoiceController@invoiceDisplay')->name('invoice');
Route::get('/invoice-list','InvoiceController@invoiceDisplay')->name('invoice');
Route::get('print/{id}','InvoiceController@printPdf')->name('print.pdf');
