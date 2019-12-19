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


Route::get('/','PagesController@home')->name('threads');

Auth::routes();

Route::get('/home', 'PagesController@home')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');


Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::delete('/', 'AdminController@deleteAdminQuestion')->name('delete_admin_question');
     // Password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

});

Route::prefix('question')->group(function() {
    Route::get('/thread', 'ForumController@getThread')->name('get_thread');
    Route::post('/thread', 'ForumController@postQuestion')->name('post_question');
    Route::get('/{id}/edit', 'ForumController@getEditThread')->name('get_edit_thread');
    Route::post('/edit', 'ForumController@saveEditThread')->name('edit_thread');
    Route::delete('/thread', 'ForumController@deleteQuestion')->name('delete_question');
    Route::get('/{slug}', 'ForumController@viewThread')->name('view_thread');
    Route::post('/post', 'ForumController@savePost')->name('save_post');
    Route::get('/{id}/edit/post', 'ForumController@getEditPost')->name('get_edit_post');
    Route::post('/edit/post', 'ForumController@saveEditPost')->name('edit_post');
    Route::delete('/post', 'ForumController@deletePost')->name('delete_post');
});


Route::get('social-login/{provider}', 'SocialDataController@redirectToProvider')->name('social-login1.redirect');
Route::get('social-login/{provider}/callback', 'SocialDataController@handleProviderCallback')->name('social-login1.callback');


