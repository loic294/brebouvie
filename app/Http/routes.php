<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Registration routes...
get('/', 'Auth\AuthController@getRegister');
post('/store', 'Auth2Controller@store');

// Authentication routes...
// get('login', 'Auth\AuthController@getLogin');
post('login', 'CustomAuthController@postLogin2');
get('logout', 'Auth\AuthController@getLogout');

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::group(['middleware' => 'auth'], function () {
  resource('nouvelles', 'NouvelleController');

  resource('messages', 'MessageController');
  get('messages/{thread_id}/delete/{user_id}', 'MessageController@destroy');

  resource('threads', 'ThreadController');

  Route::group(['middleware' => 'auth.admin'], function () {

    resource('gestion/roles', 'AdminRolesController');
    resource('gestion/annees', 'AdminAnneesController');
    resource('gestion/messages', 'AdminMessagesController');
    resource('gestion/users', 'AdminUsersController');
    resource('gestion', 'GestionController');

  });
});
