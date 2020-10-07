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

Route::get('/', 'websiteController@index')->name('home');
Route::get('product', 'websiteController@product')->name('product');
Route::get('product/{slug}', 'websiteController@productshow')->name('product.show');
Route::get('category/{slug}', 'websiteController@categoryshow')->name('category.show');
Route::get('author/{name}', 'websiteController@authorshow')->name('author.show');
Route::get('product/{slug}/{slugchapter}', 'websiteController@showcontent')->name('showimage');
Route::get('contact', 'websiteController@contact')->name('contact');
Route::get('about', 'websiteController@about')->name('about');
Route::get('post', 'websiteController@post')->name('post');
Route::get('order/{orderby}', 'productclient@orderby')->name('order');
Route::get('search', 'websiteController@search')->name('search');
Route::get('prev/{slug}/{slugchapter}', 'websiteController@prevchap')->name('prevchap');
Route::get('next/{slug}/{slugchapter}', 'websiteController@nextchap')->name('nextchap');
Route::get('post/{slug}', 'websiteController@showpost')->name('postshow');
Route::post('contact/submit', 'websiteController@submitcontact')->name('contact.submit');
Auth::routes();
Route::get('/home', 'websiteController@index');
Route::get('/admin', 'HomeController@index')->name('adminhome');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('products', 'ProductController');
    Route::resource('posts', 'PostController');
    Route::resource('notification', 'NotificationController');
    Route::resource('categories', 'CategoryController');
    Route::resource('products.chapters', 'ChapterController');
    Route::resource('galleries', 'GallerychapController');
});
