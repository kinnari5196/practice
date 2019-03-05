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


Route::get('/level', 'LevelContoller@index')->name('level');

Route::get('/level/add/', 'LevelContoller@add')->name('get_level_add');
Route::post('/level/create', 'LevelContoller@create')->name('post_level_add');

Route::get('/level/edit/{level_id}', 'LevelContoller@edit')->name('get_level_edit');
Route::post('/level/update', 'LevelContoller@update')->name('post_level_update');

Route::get('/level/delete/{level_id}', 'LevelContoller@delete')->name('get_level_delete');



Route::get('passwords/reset', 'Auth\ResetPasswordController@showResetForm')->name('reset');
Route::post('passwords/update', 'Auth\ResetPasswordController@reset')->name('password_update'); 


Route::get('/disease', 'DiseaseController@index')->name('disease');


Route::get('/disease/add/', 'DiseaseController@add')->name('get_disease_add');
Route::post('/disease/create', 'DiseaseController@create')->name('post_disease_add');

Route::get('/disease/edit/{disease_id}', 'DiseaseController@edit')->name('get_disease_edit');
Route::post('/disease/update', 'DiseaseController@update')->name('post_disease_update');

Route::get('/disease/delete/{disease_id}', 'DiseaseController@delete')->name('get_disease_delete');


Route::get('/steps', 'StepsController@index')->name('steps');

Route::get('/steps/add/', 'StepsController@add')->name('get_steps_add');
Route::post('/steps/create', 'StepsController@create')->name('post_steps_add');

Route::get('/steps/edit/{steps_id}', 'StepsController@edit')->name('get_steps_edit');
Route::post('/steps/update', 'StepsController@update')->name('post_steps_update');

Route::get('/steps/delete/{steps_id}', 'StepsController@delete')->name('get_steps_delete');


Route::get('/profile', 'RegisterController@index')->name('profile');

Route::get('/profile/edit', 'Auth\RegisterController@edit')->name('get_users_edit');
Route::post('/profile/update', 'Auth\RegisterController@update')->name('post_users_update');