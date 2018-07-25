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

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'olx', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', 'DashboardController@dashboard');
    Route::post('/send-notification', 'ProductController@sendNotification');
    Route::resource('/users', 'UsersController');
    Route::resource('/admins', 'AdminController');
    Route::get('/waitingApprove', 'ProductController@waitingApprove');
    Route::resource('/products', 'ProductController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/subcategories', 'SubCategoriesController');
    Route::resource('/contacts', 'ContactsController');
    Route::resource('/messages', 'MessageController');
    Route::resource('/rules', 'RulesController');
    Route::resource('/settings', 'SettingController');
    Route::get('/MarkAllSeen', 'UsersController@MarkAllSeen');
    Route::get('/showMore', 'UsersController@allNotifications');
});