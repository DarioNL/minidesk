<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

Route::group(['middleware' => ['auth:web,clients']], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index');
});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/clients', 'ClientController@index');
    Route::post('/clients/create', 'ClientController@postCreate');
    Route::get('/clients/{id}', 'ClientController@show');
    Route::post('/clients/{id}/edit', 'ClientController@update');
    Route::delete('/clients/{id}/delete', 'ClientController@destroy');
    Route::get('/estimates', 'EstimateController@index');
    Route::get('/estimates/{id}', 'EstimateController@show');
    Route::post('/estimates/create', 'EstimateController@postCreate');
    Route::post('/estimates/{id}/edit', 'EstimateController@update');
    Route::post('/estimates/{id}/accept', 'EstimateController@accept');
    Route::delete('/estimates/{id}/delete', 'EstimateController@destroy');
});

Route::group(['middleware' => ['auth:clients']], function () {
    Route::get('/estimates', 'client\ClientEstimateController@index');
    Route::get('/estimates/{id}', 'client\ClientEstimateController@show');
});
