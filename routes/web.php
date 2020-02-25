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

Auth::routes();

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

Route::group(['middleware' => 'auth'], function () {
    // Route::get('/service-requests', 'ServiceRequestsController@index')->name('home');
    // Route::get('service-requests/{id}', 'ServiceRequestsController@edit')->name('edit');
    Route::resource('service-requests', 'ServiceRequestsController');
    Route::get('vehicle-model/by-make', 'ServiceRequestsController@get_model_by_make')->name('model-by-make');
});

Route::get('/', function () {
    return redirect()->route('service-requests.index');
});

// Route::get('/home', 'HomeController@index')->name('home');
