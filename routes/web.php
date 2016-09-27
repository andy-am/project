<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return view('home');
});
Route::get('/home','HomeController@index');

Route::get('user/{id}/projects','UserController@showProjects');

Route::get('user/profile', function () {
    //
})->name('profile');

Route::get('user/{id}/roles','UserController@showRoles');

Route::get('roles/create','RoleController@store');

Route::get('user/profile', 'UserController@showProfile')->name('profile');


