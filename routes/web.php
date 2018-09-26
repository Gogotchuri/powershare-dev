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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', function () {
    return redirect('/');
})->name('home');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

        Route::resource('campaigns', 'CampaignController');
        Route::get('campaigns/{id}/approve', 'CampaignController@approve')->name('campaigns.approve');
        Route::get('campaigns/{id}/unapprove', 'CampaignController@unapprove')->name('campaigns.unapprove');
        Route::get('campaigns/{id}/delete', 'CampaignController@delete')->name('campaigns.delete');

        Route::resource('comments', 'CommentController');
        Route::get('comments/{id}/delete', 'CommentController@delete')->name('comments.delete');
    });

    Route::namespace('User')->prefix('user')->name('user.')->group(function () {
        Route::resource('campaigns', 'CampaignController');
    });
});
