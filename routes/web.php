<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('estimates/{id}/sign', 'client\ClientEstimateController@sign');
Route::post('estimates/{id}/accept', 'client\ClientEstimateController@accept');
Route::get('/invoices/{id}/success', 'client\ClientInvoiceController@success');


Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth:web,clients,admins']], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/pdf', 'DashboardController@pdf');
    Route::get('/settings', 'DashboardController@settings');
    Route::post('/settings/{id}/store', 'DashboardController@store');
    Route::post('/settings/{id}/logo/store', 'DashboardController@storeLogo');
    Route::post('/settings/{id}/change/password', 'DashboardController@changePassword');


});

Route::group(['middleware' => ['auth:web' , 'verified'], 'prefix' => 'company'], function () {
    Route::get('/clients', 'ClientController@index');
    Route::post('/clients/create', 'ClientController@postCreate');
    Route::get('/clients/{id}', 'ClientController@show');
    Route::post('/clients/search', 'ClientController@search');
    Route::post('/clients/{id}/edit', 'ClientController@update');
    Route::delete('/clients/{id}/delete', 'ClientController@destroy');
    Route::post('/clients/{id}/unlink', 'ClientController@unlink');
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
    Route::post('/invoices/search', 'InvoiceController@search');
    Route::post('/invoices/{id}/link', 'InvoiceController@link');
    Route::post('/invoices/{id}/unlink', 'InvoiceController@unlink');
    Route::post('/invoices/create', 'InvoiceController@postCreate');
    Route::post('/invoices/{id}/edit', 'InvoiceController@update');
    Route::post('/invoices/{id}/accept', 'InvoiceController@accept');
    Route::post('/invoices/{id}/send', 'InvoiceController@send');
    Route::delete('/invoices/{id}/delete', 'InvoiceController@destroy');
});

Route::group(['middleware' => ['auth:admins'], 'prefix' => 'admin'], function () {
    Route::get('/companies', 'admin\AdminCompanyController@index');
    Route::post('/companies/create', 'admin\AdminCompanyController@postCreate');
    Route::get('/companies/{id}', 'admin\AdminCompanyController@show');
    Route::post('/companies/search', 'admin\AdminCompanyController@search');
    Route::post('/companies/{id}/edit', 'admin\AdminCompanyController@update');
    Route::delete('/companies/{id}/delete', 'admin\AdminCompanyController@destroy');
    Route::get('/clients', 'admin\AdminClientController@index');
    Route::post('/clients/create', 'admin\AdminClientController@postCreate');
    Route::get('/clients/{id}', 'admin\AdminClientController@show');
    Route::post('/clients/{id}/unlink', 'admin\AdminClientController@unlink');
    Route::post('/clients/{id}/link', 'admin\AdminClientController@link');
    Route::post('/clients/search', 'admin\AdminClientController@search');
    Route::post('/clients/{id}/edit', 'admin\AdminClientController@update');
    Route::delete('/clients/{id}/delete', 'admin\AdminClientController@destroy');
    Route::get('/estimates', 'admin\AdminEstimateController@index');
    Route::post('/estimates/search', 'admin\AdminEstimateController@search');
    Route::get('/estimates/{id}', 'admin\AdminEstimateController@show');
    Route::post('/estimates/{id}/link', 'admin\AdminEstimateController@link');
    Route::post('/estimates/{id}/unlink', 'admin\AdminEstimateController@unlink');
    Route::post('/estimates/{id}/link/company', 'admin\AdminEstimateController@linkCompany');
    Route::post('/estimates/{id}/unlink/company', 'admin\AdminEstimateController@unlinkCompany');
    Route::post('/estimates/create', 'admin\AdminEstimateController@postCreate');
    Route::post('/estimates/{id}/edit', 'admin\AdminEstimateController@update');
    Route::post('/estimates/{id}/accept', 'admin\AdminEstimateController@accept');
    Route::post('/estimates/{id}/send', 'admin\AdminEstimateController@send');
    Route::delete('/estimates/{id}/delete', 'EstimateController@destroy');
    Route::get('/invoices', 'admin\AdminInvoiceController@index');
    Route::get('/invoices/{id}', 'admin\AdminInvoiceController@show');
    Route::post('/invoices/search', 'admin\AdminInvoiceController@search');
    Route::post('/invoices/{id}/link', 'admin\AdminInvoiceController@link');
    Route::post('/invoices/{id}/unlink', 'admin\AdminInvoiceController@unlink');
    Route::post('/invoices/{id}/link/company', 'admin\AdminInvoiceController@linkCompany');
    Route::post('/invoices/{id}/unlink/company', 'admin\AdminInvoiceController@unlinkCompany');
    Route::post('/invoices/create', 'admin\AdminInvoiceController@postCreate');
    Route::post('/invoices/{id}/edit', 'admin\AdminInvoiceController@update');
    Route::post('/invoices/{id}/accept', 'admin\AdminInvoiceController@accept');
    Route::post('/invoices/{id}/send', 'admin\AdminInvoiceController@send');
    Route::delete('/invoices/{id}/delete', 'admin\AdminInvoiceController@destroy');
});

Route::group(['middleware' => ['auth:clients'], 'prefix' => 'client'], function () {
    Route::get('/estimates', 'client\ClientEstimateController@index');
    Route::get('/estimates/{id}', 'client\ClientEstimateController@show');
    Route::post('/estimates/search', 'client\ClientEstimateController@postSearch');
    Route::post('/estimates/{id}/{sign-id}\accept', 'client\ClientEstimateController@sign');
    Route::get('/invoices', 'client\ClientInvoiceController@index');
    Route::get('/invoices/{id}', 'client\ClientInvoiceController@show');
    Route::post('/invoices/search', 'client\ClientInvoiceController@postSearch');
    Route::get('/invoices{id}/success', 'client\ClientInvoiceController@succes');
    Route::name('webhooks.payment')->post('webhooks/payment', 'client\ClientController@webhook');
});
