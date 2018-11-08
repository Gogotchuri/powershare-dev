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

Route::get('about', 'PageController@about')->name('about');
Route::get('faq', 'PageController@faq')->name('faq');

// Public

Route::namespace('Front')->name('public.')->group(function () {

    Route::get('/', 'HomeController@index');
    Route::get('campaigns', 'HomeController@campaigns');

    Route::prefix('campaigns')->group(function () {
        Route::get('{id}', 'CampaignController@show')->name('campaign.show');
        Route::post('{id}/add-comment', 'CampaignController@addComment')->name('campaign.add-comment');
    });

    Route::get('terms', 'HomeController@terms')->name('terms');
});

// Auth routes

Auth::routes(['verify' => true]);

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider')->name('to.provider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::get('auth/social/register', 'Auth\LoginController@showSocialConfirmation')->name('social.register-confirmation');
Route::post('auth/social/register', 'Auth\LoginController@socialRegister')->name('social.register');

// Authenticated people

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware(['admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

        Route::resource('campaigns', 'CampaignController');
        Route::get('campaigns/{id}/approve', 'CampaignController@approve')->name('campaigns.approve');
        Route::get('campaigns/{id}/unapprove', 'CampaignController@unapprove')->name('campaigns.unapprove');
        //TODO: Change this to DELETE METHOD
        Route::get('campaigns/{id}/delete', 'CampaignController@delete')->name('campaigns.delete');

        Route::post('campaigns/{id}/images/upload', 'CampaignController@handleFeaturedImages')->name('campaigns.images.upload');
        Route::get('campaigns/{id}/images/upload', 'CampaignController@featuredImageList')->name('existing');
        Route::get('campaigns/{id}/images/upload-main', 'CampaignController@getMainFeaturedImage')->name('campaigns.images.main');
        Route::post('campaigns/{id}/images/upload-main', 'CampaignController@handleMainFeaturedImage')->name('campaigns.images.upload-main');

        Route::resource('comments', 'CommentController');
        Route::get('comments/{id}/delete', 'CommentController@delete')->name('comments.delete');

        Route::get('settings', 'SettingsController@edit')->name('settings.edit');
        Route::post('settings/password', 'SettingsController@updatePassword')->name('settings.updatePassword');
        Route::post('settings/notifications', 'SettingsController@updateNotifications')
            ->name('settings.updateNotifications');

        //Campaign Categories
        Route::resource('categories', 'CampaignCategoryController');

        //Campaign TeamMembers
        Route::get('campaigns/{campaignId}/member', 'TeamMemberController@create')->name('members.create');
        Route::post('campaigns/{campaignId}/member', 'TeamMemberController@store')->name('members.store');
        Route::get('members/{id}/edit', 'TeamMemberController@edit')->name('members.edit');
        Route::put('members/{id}', 'TeamMemberController@update')->name('members.update');
        Route::delete('members/{id}', 'TeamMemberController@destroy')->name('members.destroy');
    });

    Route::namespace('User')->middleware('redirect.admin')->prefix('user')->name('user.')->group(function () {
        Route::resource('campaigns', 'CampaignController');
        Route::delete('campaigns/{id}/delete', 'CampaignController@delete')->name('campaigns.delete');

        Route::get('settings', 'SettingsController@edit')->name('settings.edit');
        Route::post('settings/password', 'SettingsController@updatePassword')->name('settings.updatePassword');
        Route::post('settings/notifications', 'SettingsController@updateNotifications')
            ->name('settings.updateNotifications');

        Route::post('campaigns/{id}/images/upload', 'CampaignController@handleFeaturedImages')
            ->name('campaigns.images.upload');

        Route::get('campaigns/{id}/images/upload', 'CampaignController@featuredImageList')->name('existing');

        Route::get('campaigns/{id}/images/upload-main', 'CampaignController@getMainFeaturedImage')
            ->name('campaigns.images.main');

        Route::post('campaigns/{id}/images/upload-main', 'CampaignController@handleMainFeaturedImage')
            ->name('campaigns.images.upload-main');

        //Campaign Categories
        //Route::resource('categories', 'CampaignCategoryController');

        //Campaign TeamMembers
        Route::get('campaigns/{campaignId}/member', 'TeamMemberController@create')->name('members.create');
        Route::post('campaigns/{campaignId}/member', 'TeamMemberController@store')->name('members.store');
        Route::get('members/{id}/edit', 'TeamMemberController@edit')->name('members.edit');
        Route::put('members/{id}', 'TeamMemberController@update')->name('members.update');
        Route::delete('members/{id}', 'TeamMemberController@destroy')->name('members.destroy');
    });

    Route::post('images/campaigns/{id}', 'ImageController@store')->name('images.campaigns');
    Route::get('images/campaigns/{id}', 'ImageController@getList')->name('images.campaigns.list');
    Route::delete('images/campaigns/{id}', 'ImageController@destroy')->name('images.campaigns.destroy');

    Route::prefix('image')->name('image.')->group(function () {
        Route::post('upload', 'ImageController@upload')->name('upload');

        //TODO: jQuery plugin we are using uses same url to get initial list of images, maybe we can configure otherwise
        Route::get('upload', 'ImageController@existing')->name('existing');
        Route::delete('delete', 'ImageController@delete')->name('delete');
    });
});
