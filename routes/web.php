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
    return view('welcome');
});

Route::get('hello', function () {
    return "Hello World !";
});

// ? = parametre optionnel. Si homestead.app/page == page/Home (default)
Route::get('page/{page_name?}', function ($page_name = 'Home') {
    return "Page ".$page_name;
});

// Envoyer la variable $page_name dans la view 'mainpage'
Route::get('mainpage/{page_name?}', function ($page_name = 'Home') {
    return view('mainpage', ['page_name' => $page_name]);
});

//Taper dans dans WallController@read
Route::get('read/{search?}','WallController@read');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/write', 'HomeController@write');
