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

Auth::routes();
//Route::get('/profile', function () {
//   return view('profile');
//});
Route::get('profile','ProfileController@index');
Route::post('home/profile/{id}','ProfileController@store');
//Route::get('/home', 'HomeController@index')->name('home');
//Route::resource('/home','PostController');

Route::resource('/comment','CommentController');
Route::post('/like','PostController@postLikePost')->name('like');
Route::post('/likeComment','CommentController@postLikeComment')->name('likeComment');
Route::get('/home/profile/{user}', 'ProfileController@index')->middleware('auth');




////////////////test ajax////
Route::get('/test', 'PagesController@index');
Route::get('/getUsers', 'PagesController@getUsers');
Route::post('/addUser', 'PagesController@addUser');
Route::post('/updateUser', 'PagesController@updateUser');
Route::get('/deleteUser/{id}', 'PagesController@deleteUser');
////////////////test ajax////
Route::get('/home', 'HomeAjaxController@index');
Route::get('/getPosts', 'HomeAjaxController@getPosts');
Route::post('/addPost', 'HomeAjaxController@addPost');
Route::post('/updatePost', 'HomeAjaxController@updatePost');
Route::get('/deletePost/{id}', 'HomeAjaxController@deleteUser');