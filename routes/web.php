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

Route::get('', function () {
    return redirect('components');
});

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::get('storages', "StoragesController@index")->middleware('auth');
Route::get('storages/create', "StoragesController@create")->middleware('auth');
Route::post('storages', "StoragesController@store")->middleware('auth');
Route::get('storages/{id}', "StoragesController@show")->middleware('auth');
Route::put('storages/{id}', "StoragesController@update")->middleware('auth');

Route::get('components/search', "ComponentsController@search")->middleware('auth');
Route::resource('components', 'ComponentsController')->middleware('auth');
