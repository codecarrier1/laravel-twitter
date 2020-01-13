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
Route::get('auth/callback/{provider}', 'SocialAuthController@callback');
Route::get('auth/redirect/{provider}', 'SocialAuthController@redirect');
//Route::get('auth/admin', 'SocialAuthController@admin');
Route::get('auth/admin', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});



Route::get('/home', 'HomeController@index');

//Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/profile/{action}', 'HomeController@profile')->name('profile');
Route::get('/profile/{action}', 'HomeController@profile')->name('profile');
Route::post('/create/{profile}', 'HomeController@cProfile')->name('profile');
Route::get('/detect', 'HomeController@DetectBot');
Route::post('/user/view', 'HomeController@view_user');
Route::post('/spammer/view', 'HomeController@view_spammer');
