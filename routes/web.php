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

Route::get('/posts/{adminCatId}', 'PostsController@index');
Route::get('/fpost/show/{postId}', 'FourthbarelementsController@show');
Route::get('/posts/{adminCatId}/{postId}', 'PostsController@show');
Route::post('/posts/getSpecials/{categoryId}', 'PostsController@getSpecials');
Route::post('/posts/random/{categoryId}','PostsController@getRandomPosts');
Route::post('/post/latest/{categoryId}/{special}', 'PostsController@latest');
Route::get('/post/show/{postId}', 'PostsController@show');

Route::group(['middleware' => 'auth'], function(){

    Route::group(['middleware' => 'admin'], function(){

        Route::post('/post/update/{postId}/{adminCatId}', 'postsController@update');
        Route::post('/continents/get/{categoryId}', 'FourthbarelementsController@getSpecials');
        Route::post('/specials/get/{categoryId}', 'PostsController@getSpecials');
        Route::post('/post/new','PostsController@newPost');
        
        
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


