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
Route::get('/set_language/{lang}', 'Controller@setLanguaje')->name( 'set_language');

Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix'=>'courses'],function(){
    Route::get('/{course}','CourseController@show')->name('courses.detail');
});
Route::get('/images/{path}/{atachment}',function($path , $attachment){
    $file = sprintf('storage/%s/%s',$path , $attachment);
    if(File::exits($file)){
        return Image::make($file)->response();
    }
});

Route::group(["prefix" => "subscriptions"], function() {
    Route::get('/plans', 'SubscriptionsController@plans')
         ->name('subscriptions.plans');
    Route::get('/admin', 'SubscriptionsController@admin')
         ->name('subscriptions.admin');
    Route::post('/process_subscription', 'SubscriptionsController@processSubscription')
         ->name('subscriptions.process_subscription');
    Route::post('/resume', 'SubscriptionsController@resume')->name('subscriptions.resume');
    Route::post('/cancel', 'SubscriptionsController@cancel')->name('subscriptions.cancel');
});
