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

Route::get('/', function () {return view('welcome');});

/** Routes that check user is logged in to access */
Route::group(['middleware' => 'auth.admin'], function (){
    /** Admin area restricted */
    Route::get('admin', 'Admin\AdminController@index')->name('admin');
    Route::post('admin/logout', 'Auth\Admin\LoginController@logout')->name('logout.admin');
    //records
    Route::get('admin/record', 'Admin\RecordController@index')->name('record');
    Route::post('admin/record', 'Admin\RecordController@newRecord')->name('record.save');
    //patients
    Route::get('admin/patient', 'Admin\PatientController@index')->name('patient');
    Route::post('admin/patient/add-treatment-ajax', 'Admin\PatientController@addTreatmentAjax')->name('patient.treatment.add.ajax');
    Route::get('admin/patient/search', 'Admin\PatientController@search')->name('patient.search');
    Route::get('admin/patient/searchAjax', 'Admin\PatientController@searchAjax')->name('patient.search.ajax');
});

//let this routers open to login.
Route::get('admin/login', function () {return view('admin.auth.login');})->name('login.admin');
Route::post('admin/login', 'Auth\Admin\LoginController@login')->name('login.admin');

//If someday we need normal login/register users uncomment this.
//Auth::routes();


