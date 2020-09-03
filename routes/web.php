<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::routes(['register' => false]);
Route::group(['middleware'=>'auth'],function(){
    Route::get('/', 'HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('company/data','CompaniesController@listData')->name('company.data');
    Route::resource('company', 'CompaniesController');
    
    Route::get('employee/data','EmployeesController@listData')->name('employee.data');
    Route::get('employee/select2company','EmployeesController@select2company')->name('employee.select2company');
    Route::resource('employee', 'EmployeesController');

    Route::get('lang/{language}', 'LocalizationController@switch')->name('localization.switch');
});
