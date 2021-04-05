<?php

use App\Http\Controllers\Backend\RoleController;
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

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::group(['as' => 'app.', 'prefix' => 'app', 'namespace' => 'Backend', 'middleware' => ['auth']], function () {
    Route::get('dashboard', 'DashboardController')->name('dashboard');
    Route::resource('roles', 'RoleController');
});
