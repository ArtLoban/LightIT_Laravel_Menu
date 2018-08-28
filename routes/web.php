<?php

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function(){

    Route::get('/', 'DashboardController@index')->name('admin-index');
    Route::resource('/users', 'UsersController');
    Route::resource('/dishes', 'DishesController');
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/ingredients', 'IngredientsController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/permitions', 'IngredientsController');
});

//Route::get('/admin', 'Admin\DashboardController@index');

Auth::routes();
Route::get('register', function () {
    return abort('404');
});


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'IndexController@index')->name('/');

Route::get('/menu', 'MenuController@index')->name('menu');
Route::get('/menu/category/{id}', 'MenuController@show')->name('menu.category');
Route::get('/menu/dish/{id}', 'MenuController@showDish')->name('menu.dish');

