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

Route::get('/admin/addTeacher', 'Auth\RegisterController@getAddTeacherForm')->name('addTeacherForm');
Route::post('/admin/addTeacher','Auth\RegisterController@registerTeacher')->name('addTeacher');


Route::get('/mail',function (){
    return new App\Mail\TeacherRegistered("adafa","asdfasdaf");
})->name('mail');