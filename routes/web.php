<?php

Route::group(['middleware' => 'guest', 'namespace' => 'Auth', 'as' => 'login.'], function () {
    Route::get('/', 'CustomLoginController@show')->name('show');
    Route::post('/', 'CustomLoginController@post')->name('post');
});

Route::group(['prefix' => 'sign-up', 'middleware' => 'guest', 'namespace' => 'Auth', 'as' => 'register.'], function () {
    Route::get('/', 'CustomRegistrationController@show')->name('show');
    Route::post('/', 'CustomRegistrationController@post')->name('post');
});

Route::get('files/{parameters?}', 'BrowserController')->where('parameters', '.*')->middleware('file-check')->name('browse.files');
Route::post('files/{parameters?}', 'BrowserController@createNewFolder')->where('parameters', '.*')->name('browser.new.folder');
Route::post('upload/{parameters?}', 'BrowserController@uploadFiles')->where('parameters', '.*')->name('browser.new.file');
