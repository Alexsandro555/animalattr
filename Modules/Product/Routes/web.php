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

Route::prefix('product')->group(function() {
  Route::get('/', 'ProductController@index');
  Route::patch('/', 'ProductController@save');


  //===========================Attribute================================================
  //Route::get('/attribute', 'AttributeController@index');
  Route::get('/attributes/{id}', 'AttributeController@attributes');
  Route::post('/save-attributes',
    [
      'before' => 'csrf',
      'uses' => 'AttributeController@saveAttributes'
    ]);
});


Route::prefix('attribute')->group(function() {
  Route::get('/', 'AttributeController@index');
  Route::patch('/', 'AttributeController@store');
});


Route::prefix('category')->group(function() {
  Route::get('/{parentId?}', 'CategoryController@index');
  Route::post('/', 'CategoryController@create');
  Route::patch('/', 'CategoryController@store');
});