<?php

use Illuminate\Support\Facades\Route;

Route::get('/auth/google', 'Social\Google\LoginController@redirectToGoogle')->name('redirectToGoogle');
Route::get('/auth/google/callback', 'Social\Google\LoginController@handleGoogleCallback')->name('handleGoogleCallback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/home', 'Meeting\MeetingController@index')->name('index');
    Route::get('/show-all-meetings', 'Meeting\MeetingController@index')->name('index');
    Route::get('/create-new-meeting', 'Meeting\MeetingController@create')->name('create');
    Route::post('/add-new-meeting', 'Meeting\MeetingController@store')->name('store');
    Route::get('/view-meeting/{id}', 'Meeting\MeetingController@show')->name('show');
    Route::get('/edit-meeting/{id}', 'Meeting\MeetingController@edit')->name('edit');
    Route::put('/update-meeting', 'Meeting\MeetingController@update')->name('update');
//Route::delete('/destroy-meeting', 'Meeting\MeetingController@destroy')->name('destroy'); //we can also do with this 
    Route::get('/destroy-meeting/{id}', 'Meeting\MeetingController@destroy')->name('destroy');
});


