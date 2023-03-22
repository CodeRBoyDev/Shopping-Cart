<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [
    'uses' => 'ProductController@getIndex',
    'as' => 'product.index'
    ]);
  
 Route::group(['prefix' => 'user'], function(){
     Route::group(['middleware' => 'guest'], function() {
         Route::get('signup', [
                 'uses' => 'userController@getSignup',
                 'as' => 'user.signup',
             ]);
           Route::post('signup', [
                 'uses' => 'userController@postSignup',
                 'as' => 'user.signup',
              ]);
           Route::get('signin', [
                 'uses' => 'userController@getSignin',
                 'as' => 'user.signin',
              ]);
           Route::post('signin', [
                 'uses' => 'LoginController@postSignin',
                 'as' => 'user.signin',
              ]);
           });
 
        Route::group(['middleware' => 'role:customer'], function() {
           Route::get('profile', [
                  'uses' => 'userController@getProfile',
                  'as' => 'user.profile',
              ]);
           
           });
    });

    Route::group(['middleware' => 'role:admin,encoder'], function() {
        Route::post('/import', 'ItemController@import')->name('item-import');
         Route::get('/export',[
            'uses'=>'ItemController@export',
            'as' => 'item.export'
        ]);
        Route::resource('item', 'ItemController');
    });


Route::get('logout', [
                  'uses' => 'userController@getLogout',
                  'as' => 'user.logout',
              ]);
 
 Route::get('add-to-cart/{id}',[
         'uses' => 'productController@getAddToCart',
         'as' => 'product.addToCart'
     ]);
 
 Route::get('shopping-cart', [
         'uses' => 'ProductController@getCart',
         'as' => 'product.shoppingCart'
     ]);
 
 Route::get('checkout',[
           'uses' => 'ProductController@postCheckout',
           'as' => 'checkout',
           'middleware' =>'role:customer'
     ]);
 
 
 Route::get('remove/{id}',[
         'uses'=>'productController@getRemoveItem',
         'as' => 'product.remove'
     ]);
     Route::get('reduce/{id}', [
     'uses' => 'ProductController@getReduceByOne',
     'as' => 'product.reduceByOne'
 ]);

 Route::get('dashboard',[
     'uses'=>'DashboardController@index',
     'as'=>'dashboard.index'])->middleware('role:admin');
     
 Route::resource('item','ItemController',[
     'middleware'=>'role:admin,encoder']);

Route::post('/search',['uses' => 'SearchController@search','as' => 'search'] );
     
Route::get('/customer/{id}', [
      'uses' => 'CustomerController@show',
       'as' => 'customer.show'
    ]);
    
Route::get('/get-item',[ 'uses'=>'ItemController@getItem','as' => 'item.getItem']);

