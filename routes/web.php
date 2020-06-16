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


Route::get('/test', 'testController@index')->name('test');
Route::get('/test/1', 'testController@test')->name('test1');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('dashboard');
Route::get('/admin/users/roles', 'Admin\UserController@roles')->name('roles');
Route::post('/admin/users/role/create', 'Admin\UserController@role_create')->name('role.create');
Route::post('/admin/user/create', 'Admin\UserController@store')->name('user.create');
Route::get('/admin/user/edit/{user}', 'Admin\UserController@edit')->name('user.edit');
Route::post('/admin/user/edit/{user}', 'Admin\UserController@update')->name('user.update');
Route::get('/admin/user/destroy/{user}', 'Admin\UserController@destroy')->name('user.destroy');
Route::get('/admin/users/role/destroy/{user}', 'Admin\UserController@roleDestroy')->name('role.destroy');
Route::get('/admin/user/{user}/settings', 'Admin\SettingsController@userSettings')->name('user.settings');
Route::group(['middleware' => ['can:manage.users']],function(){
   Route::get('/admin/users', 'Admin\UserController@index')->name('users');
});



