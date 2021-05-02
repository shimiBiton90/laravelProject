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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/categories/getCategories', 'CategoryController@getCategories');
Route::get('/countries/getCountries', 'CountriesController@getCountries');


Route::get('/products/getProducts/{id}', 'ProductsController@getProducts')->where(['id' => '[0-9]+']);


Route::resources([
    'categories'=> 'CategoryController',
    'products'=> 'ProductsController',
    'customers'=> 'CustomersController'
]);