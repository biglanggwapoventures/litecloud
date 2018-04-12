<?php

Route::group(['middleware' => 'guest', 'namespace' => 'Auth', 'as' => 'login.'], function () {
    Route::get('/', 'CustomLoginController@show')->name('show');
    Route::post('/', 'CustomLoginController@post')->name('post');
});

Route::group(['prefix' => 'sign-up', 'middleware' => 'guest', 'namespace' => 'Auth', 'as' => 'register.'], function () {
    Route::group(['prefix' => 'personal', 'as' => 'personal.'], function () {
        Route::get('/', 'PersonalRegistration@show')->name('show');
        Route::post('/', 'PersonalRegistration@post')->name('post');
    });
    Route::group(['prefix' => 'corporate', 'as' => 'corporate.'], function () {
        Route::get('/', 'CompanyRegistration@show')->name('show');
        Route::post('/', 'CompanyRegistration@post')->name('post');
    });
});

Route::group(['prefix' => 'files', 'as' => 'directory.'], function () {
    Route::get('{directory?}', 'DirectoryController@viewContents')->name('browse');
    Route::post('{directory?}', 'DirectoryController@create')->name('create');
    Route::put('{directory?}', 'DirectoryController@put')->name('put');
});

// Route::get('files/{parameters?}', 'BrowserController')->where('parameters', '.*')->middleware('file-check')->name('browse.files');
// Route::post('files/{parameters?}', 'BrowserController@createNewFolder')->where('parameters', '.*')->name('browser.new.folder');
// Route::post('upload/{parameters?}', 'BrowserController@uploadFiles')->where('parameters', '.*')->name('browser.new.file');

// Route::get('mail', 'MailController');

// Route::group(['middleware' => 'check-folder'], function () {
//     Route::resource('folders', 'FolderController');
//     Route::group(['prefix' => 'my-files/{folder?}', 'as' => 'my-files.', 'middleware' => 'check-folder'], function () {
//         Route::get('/', 'DirectoryController')->name('browse');
//         Route::post('/', 'DirectoryController@uploadFiles')->name('upload');
//     });
// });
