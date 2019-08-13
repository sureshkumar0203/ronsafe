<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('training-notify-paypal', 'HomeController@updateTrainingTransactionDetails');
Route::post('order-notify-paypal', 'CartController@updateTransactionDetails');

/*********************MOBILE API ROUTES STARTS HERE************************************/
Route::post('user-sign-up', 'ApiController@userSignup');
Route::get('user-login', 'ApiController@userLogin');
Route::get('user-details', 'ApiController@userDetails');
Route::post('update-user-details', 'ApiController@updateUserDetails');
Route::get('user-forgot-password', 'ApiController@userForgotPassword');
Route::get('user-change-password', 'ApiController@userChangePassword');

Route::get('training-list', 'ApiController@trainingList');
Route::get('home-latest-training', 'ApiController@homeLatestTraining');


Route::get('categories', 'ApiController@categoryList');
Route::get('products', 'ApiController@productList');
Route::get('product-details', 'ApiController@productDetails');


Route::get('order-history', 'ApiController@orderHistory');
Route::get('order-details', 'ApiController@orderDetails');


Route::get('booking-history', 'ApiController@bookingHistory');
Route::get('booking-details', 'ApiController@bookingDetails');

Route::get('add-to-cart', 'ApiController@addProductsToCart');
Route::get('cart-items', 'ApiController@cartItems');
Route::get('decrement-cart-qty', 'ApiController@decrementCartQty');
Route::get('delete-item-from-cart', 'ApiController@deleteCartItem');


Route::post('place-user-order', 'ApiController@placeUserOrder');
Route::post('book-a-training','ApiController@bookTraining');

