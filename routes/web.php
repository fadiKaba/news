<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/forthbar/posts', 'FourthbarelementsController@index');
Route::get('/forthbar/posts/{postId}', 'FourthbarelementsController@show');

Route::get('/posts/{adminCatId}', 'PostsController@index');
Route::get('/posts/{adminCatId}/{postId}', 'PostsController@show');

Route::group(['middleware' => 'auth'], function(){

    Route::group(['middleware' => 'admin'], function(){

        Route::post('/post/update/world/{postId}/{adminCatId}', 'FourthbarelementsController@update');
        Route::post('/continents/get/{categoryId}', 'FourthbarelementsController@getSpecials');
        
        Route::group(['middleware' => 'mainadmin'], function(){

            Route::get('/users/get', 'UsersController@index');
            Route::get('/users/getusersjson', 'UsersController@getUsersJson');
            Route::get('/users/getusersclientjson', 'UsersController@getUsersClientJson');
            Route::post('/users/gategories', 'UsersController@getCategories');
            Route::post('/user/addcategory/{userId}/{catId}', 'UsersController@addCategory');
            Route::post('/user/save/{userId}', 'UsersController@update');
            Route::post('/user/destroy/{userId}','UsersController@destroy');
            Route::post('/user/add', 'UsersController@store');
            Route::post('/user/search/{val}', 'UsersController@search');
            
        });
        
   });

});


