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
Route::get('login', 'Auth\LoginController@showLogin')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware'=>['auth','rbac']], function ($router) {
    $router->get('/',function(){
        return view('adminlte',compact([]));
    })->name('home');
    $router->resource('/menu','Auth\MenuController');
    $router->get('/user/profile','Auth\UserController@profile')->name('user.profile');
    $router->put('/user/profile','Auth\UserController@profileSave')->name('user.profile-save');
    $router->resource('/user','Auth\UserController');
    $router->resource('/role','Auth\RoleController');
    $router->resource('/permission','Auth\PermissionController');
});
