<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('notifications/{token}', 'UsersController@notifications');
Route::get('unreadNotifications/{token}', 'UsersController@unreadNotifications');
Route::post('/register', 'UsersController@register');
Route::post('/login', 'UsersController@login');

Route::post('/facebook', 'UsersController@facebook');
Route::post('/twitter', 'UsersController@twitter');

Route::get('/AuthUser/{token}', 'UsersController@AuthUser');

Route::post('/password/email', 'UsersController@getResetToken');
Route::post('/password/reset', 'UsersController@reset');

Route::post('/verify', 'UsersController@verifyMail');
Route::post('/verify/again', 'UsersController@again');

Route::post('/contacts', 'ContactsController@store');
Route::get('/categories', 'CategoryController@index');
Route::get('/subcategories', 'SubCategoriesController@index');
Route::get('/subcategories/{id}', 'SubCategoriesController@subCategories');

Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');
Route::get('/catProducts/{id}', 'ProductController@catProducts');
Route::get('/userProducts/{token}', 'ProductController@userProducts');
Route::post('/searchProducts', 'ProductController@searchProducts');
Route::post('/products', 'ProductController@store');
Route::post('/addImage', 'ProductController@addImage');
Route::delete('/products/{id}', 'ProductController@destroy');

Route::get('/isFav/{id}/{token}', 'FavouriteController@isFav');
Route::get('/getUserFavs/{token}', 'FavouriteController@getUserFavs');
Route::post('/favourites', 'FavouriteController@store');

Route::post('/messages', 'MessageController@store');
Route::get('/getMessages/{token}', 'MessageController@getMessages');
Route::get('/receivedMessages/{token}', 'MessageController@receivedMessages');
Route::get('/chats/{token}', 'MessageController@chats');
Route::get('/privateMsg/{id}/{token}', 'MessageController@privateMsg');
Route::get('/ban/{id}/{token}', 'MessageController@ban');

Route::get('/productRatings/{id}', 'RatingsController@productRatings');
Route::post('/ratings', 'RatingsController@store');
Route::post('/replyRating', 'RatingsController@replyRating');

Route::get('/rules', 'RulesController@index');

Route::get('/setting', 'SettingController@setting');
