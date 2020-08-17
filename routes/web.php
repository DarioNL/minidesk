<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('estimates/{id}/sign', 'client\ClientEstimateController@sign');
Route::post('estimates/{id}/accept', 'client\ClientEstimateController@accept');
Route::get('/invoices/{id}/success', 'client\ClientInvoiceController@success');


Auth::routes();

Route::group(['middleware' => ['auth:web,clients']], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/pdf', 'DashboardController@pdf');

});

Route::group(['middleware' => ['auth:web'], 'prefix' => 'company'], function () {
    Route::get('/clients', 'ClientController@index');
    Route::post('/clients/create', 'ClientController@postCreate');
    Route::get('/clients/{id}', 'ClientController@show');
    Route::post('/clients/{id}/edit', 'ClientController@update');
    Route::delete('/clients/{id}/delete', 'ClientController@destroy');
    Route::get('/estimates', 'EstimateController@index');
    Route::post('/estimates/search', 'EstimateController@search');
    Route::get('/estimates/{id}', 'EstimateController@show');
    Route::post('/estimates/{id}/link', 'EstimateController@link');
    Route::post('/estimates/{id}/unlink', 'EstimateController@unlink');
    Route::post('/estimates/create', 'EstimateController@postCreate');
    Route::post('/estimates/{id}/edit', 'EstimateController@update');
    Route::post('/estimates/{id}/accept', 'EstimateController@accept');
    Route::post('/estimates/{id}/send', 'EstimateController@send');
    Route::delete('/estimates/{id}/delete', 'EstimateController@destroy');
    Route::get('/invoices', 'InvoiceController@index');
    Route::get('/invoices/{id}', 'InvoiceController@show');
    Route::post('/invoices/{id}/link', 'InvoiceController@link');
    Route::post('/invoices/{id}/unlink', 'InvoiceController@unlink');
    Route::post('/invoices/create', 'InvoiceController@postCreate');
    Route::post('/invoices/{id}/edit', 'InvoiceController@update');
    Route::post('/invoices/{id}/accept', 'InvoiceController@accept');
    Route::post('/invoices/{id}/send', 'InvoiceController@send');
    Route::delete('/invoices/{id}/delete', 'InvoiceController@destroy');
});

Route::group(['middleware' => ['auth:clients'], 'prefix' => 'client'], function () {
    Route::get('/estimates', 'client\ClientEstimateController@index');
    Route::get('/estimates/{id}', 'client\ClientEstimateController@show');
    Route::post('/estimates/{id}/{sign-id}\accept', 'client\ClientEstimateController@sign');
    Route::get('/invoices', 'client\ClientInvoiceController@index');
    Route::get('/invoices/{id}', 'client\ClientInvoiceController@show');
    Route::get('/invoices{id}/success', 'client\ClientInvoiceController@succes');
    Route::name('webhooks.payment')->post('webhooks/payment', 'client\ClientController@webhook');
});
