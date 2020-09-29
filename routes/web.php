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

// Auth
Route::group([], function () {
	Route::get('login', 'AuthController@LoginView');
	Route::post('login', 'AuthController@LoginProcess')->name('loginProcess');
	Route::get('logout', 'AuthController@Logout');
});

// Users
Route::group(['middleware' => ['auth.users'], 'prefix' => 'users'], function() {

	// Dashboard Users
	Route::get('/', 'UsersController@Home')->name('home');

	// Absensi
	Route::post('/absen', 'UsersController@ProcessAbsen')->name('ProcessAbsen');
	Route::post('/absen/keluar/{id_absen}', 'UsersController@AbsenKeluar')->name('ProcessAbsenKeluar');

	// Get File Fotooo
	Route::get('/file/{file}', 'UsersController@GetFile');
});
	
// Admin
Route::group(['middleware' => ['auth.users'], 'prefix' => 'admin'], function() {

	// Dashboard Admin
	Route::get('/', 'AdminController@Home')->name('home');

	// Management Users
	Route::post('/add', 'AdminController@Store')->name('createProcess');
	Route::get('/edit/{id}', 'AdminController@edit');
	Route::put('/edit/{id}', 'AdminController@Update')->name('UpdateProcess');
	Route::delete('/delete/{id}', 'AdminController@Delete')->name('DeleteProcess');
});
