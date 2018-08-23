<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){

    Route::get('/', 'DashboardController@index')->name('admin-index');
    Route::resource('/users', 'UsersController');
    Route::resource('/dishes', 'DishesController');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/ingredients', 'IngredientsController');
    Route::resource('/roles', 'IngredientsController');
    Route::resource('/permitions', 'IngredientsController');
}); //->middleware('auth');

//Route::get('/admin', 'Admin\DashboardController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'IndexController@index')->name('/');

Route::get('/menu', 'MenuController@index')->name('menu.index');
Route::get('/menu/category/{id}', 'MenuController@show')->name('menu.category');

