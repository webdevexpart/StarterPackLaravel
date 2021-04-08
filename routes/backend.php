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


Route::group(['namespace' => 'Backend'], function () {
    Route::get('dashboard', 'DashboardController')->name('dashboard');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');

    // Backups
    Route::resource('backups', 'BackupController')->only(['index', 'store', 'destroy']);
    Route::get('backups/{file_name}','BackupController@download')->name('backups.download');
    Route::delete('backups', 'BackupController@clean')->name('backups.clean');

    //Profile
    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::put('profile', 'ProfileController@updateProfile')->name('profile.update');

    // Profile Password Change
    Route::get('profile/security', 'ProfileController@changePassword')->name('profile.password.change');
    Route::put('profile/security', 'ProfileController@updatePassword')->name('profile.password.update');

});
