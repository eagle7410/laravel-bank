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
Route::get('/users', 'UsersController@index')->name('users');
Route::get('/roles', 'RolesController@index')->name('roles');
Route::post('/user', 'UserController@save')->name('user');
// Statuses
Route::get('/statuses', 'StatusesController@index')->name('statuses');
Route::get('/status' , 'StatusController@index')->name('status');
Route::post('/status', 'StatusController@save')->name('status-save');
Route::put('/status' , 'StatusController@update')->name('status-update');
// Actions
Route::get('/actions', 'ActionsController@index')->name('actions');
Route::get('/action' , 'ActionController@index')->name('action');
Route::post('/action', 'ActionController@save')->name('action-save');
Route::put('/action' , 'ActionController@update')->name('action-update');

Route::get('/clients' , 'ClientsController@index')->name('clients');

Route::post('/deposit', 'DepositController@save')->name('deposit-save');
Route::patch('/deposit', 'DepositController@changeStatus')->name('deposit-change-status');
Route::get('/deposits', 'DepositsController@index')->name('deposits');
Route::get('/deposit-history/{number}', 'DepositHistoryController@index')->name('deposit-history');
Route::get('/deposits-stats', 'DepositsStatsController@index')->name('deposit-stats');

Route::put('/profile' , 'ProfileController@index')->name('profile-update');

Route::patch('/notify' , 'NotifyController@isRead')->name('notify-is-read');
