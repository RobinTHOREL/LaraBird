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

/*Route::get('hello', function () {
    return "Hello World !";
});*/

/*
// ? = parametre optionnel. Si homestead.app/page == page/Home (default)
Route::get('profil/{page_name?}', function ($page_name = 'Home') {
    return "Page ".$page_name;
});
*/

// Envoyer la variable $page_name dans la view 'mainpage'


//Taper dans dans WallController@read
Route::get('read/{search?}','WallController@read');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/write', 'HomeController@write');

Auth::routes();

Route::get('/home', 'HomeController@index');

//Page profil. Recherche URI
Route::get('profil/{id_user?}', 'UserController@profile');

// Recupérer l'update de l'avatar sur la page profil
Route::post('profil', 'UserController@update_avatar');

// Récupere un post sur la page profil
Route::post('post_from_profil', 'UserController@write');

//Permet de follow une personne
Route::post('add_follower', 'UserController@add_follower');

//Permet de unfollow une personne
Route::post('del_follower', 'UserController@del_follower');


Route::get('/delete-post/{post_id}', [
    'uses' => 'PostController@getDeletePost',
    'as' => 'post.delete',
    'middleware' => 'auth'
]);

Route::post('/like', [
    'uses' => 'HomeController@postLikePost',
    'as' => 'like'
]);

//Permet de follow depuis la home
Route::post('add_follower_from_home', 'HomeController@add_follower_from_home');

//Permet d'unfollow depuis la home
Route::post('del_follower_from_home', 'HomeController@del_follower_from_home');

//Supprimer un post
Route::get('delete/{id_post}', 'HomeController@delete_post');

//Update un post
Route::get('modify/{id_post}', 'HomeController@modify_post');

Route::get('/settings', 'UserController@settings');

Route::post('/settings/update', 'UserController@update_settings');
