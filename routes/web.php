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

Route::get('/','Front\\HomeController@index')->name('front.home');
Route::get('files/{id}/preview','Front\\FileController@filePreview')->name('front.file.preview');
Route::get('files/{id}/download','Front\\FileController@fileDownload')->name('front.file.download');


Auth::routes();

// Group Panel
Route::prefix('system')->namespace('Src')->group(function()
{
    // single page
    Route::get('/', 'PanelController@display')->name('system');

    // GROUP MASTER
    Route::resource('advertise','Master\\AdvertiseController');
    Route::get('advertise/excel','Master\\AdvertiseController@excel');

    Route::resource('confirm-status','Master\\ConfirmStatusController');
    Route::get('/confirmstatus/export', 'Master\\ConfirmStatusController@export');
    Route::resource('gender','Master\\GenderController');
    Route::resource('member-card','Master\\MemberCardController');
    Route::resource('pasien','Master\\PasienController');
    Route::resource('pasien-member','Master\\PasienMemberController');
    Route::resource('pasien-status','Master\\PasienStatusController');

    // GROUP SALES
    Route::resource('interaksi','Sales\\InteraksiController');

    // GROUP SECURITY
    Route::resource('users','Security\\UserController');
    Route::resource('groups','Security\\GroupController');
    Route::resource('permissions','Security\\PermissionController');
    Route::resource('files','Security\\FileController');
    Route::resource('file-groups','Security\\FileGroupController');
});


