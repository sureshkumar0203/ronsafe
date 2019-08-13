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

/*Route::get('/', function () {
    return view('welcome');
});*/



Route::get('/', 'HomeController@showHome');
Route::get('about-us', 'HomeController@aboutUs');
Route::get('services', 'HomeController@viewServices');

Route::get('training', 'HomeController@viewTraining');
Route::get('book-a-training/{training_id}-{slug}', 'HomeController@viewBookTraining');
Route::post('confirm-training', 'HomeController@saveTrainingDetails');
Route::get('training-paypal', 'HomeController@viewTrainingPaypal');
Route::get('training-thank-you', 'HomeController@viewTrainingThankYou');
Route::get('payment-failed', 'HomeController@viewTrainingPaymentFail');

Route::get('privacy-policy', 'HomeController@viewPrivacyPolicy');
Route::get('terms-and-conditions', 'HomeController@viewTermsAndConditions');


Route::get('contact-us', 'HomeController@viewContact');
Route::post('contact-us', 'HomeController@sendContactEmail');

Route::get('products', 'ProductControllerFrontend@viewProducts');
Route::get('product-details/{prd_id}-{slug}', 'ProductControllerFrontend@viewProductDetails');

Route::post('add-to-cart', 'CartController@addToCart');
Route::get('cart', 'CartController@viewCart');
Route::get('checkout', 'CartController@viewCheckout');

Route::post('/place-order-process', 'CartController@placeOrder');

Route::get('user-registration', 'UserLoginController@viewUserRegistration');
Route::post('user-registration', 'UserLoginController@saveUserData');

Route::post('/qty-inc', 'CartController@qntyInc');
Route::post('/qty-dec', 'CartController@qntyDec');
Route::post('/delete-item', 'CartController@deleteItem');
//Route::post('save-nl-data', 'homeController@saveNewsletterData');

Route::get('videos', 'HomeController@viewVideos');

Route::get('404', function(){
    return view('404');
});



/*Route::group(['middleware' => ['checkuserlogin']], function() {
	Route::get('user-dashboard', 'userController@viewUserDashboard');
	Route::get('user-logout', array('uses' => 'userController@userLogout'));
});*/



/*******************************USER ROUTES STARTS HERE*************************************/
Route::get('user-login', 'UserLoginController@viewUserLogin');
Route::post('user-login', 'UserLoginController@checkUserLogin');

Route::get('user-forgot-psw','UserLoginController@viewUserForgotPassword');
Route::post('user-forgot-psw', 'UserLoginController@userForgotPassword')->name('user.forgot.submit');

Route::get('user-login-popup', 'UserLoginController@viewUserLoginPopup');
Route::post('user-login-popup', 'UserLoginController@checkPopupUserLogin');



Route::group(['middleware' => ['checkuserlogin']], function() {
	Route::get('user-dashboard', 'UserController@viewUserDashboard');
	Route::get('user-logout', array('uses' => 'UserController@userLogout'));
	
	
	Route::get('user-my-account', 'UserController@viewMyAccount');
	Route::post('update-details', 'UserController@updateUserAccountDetails');
	
	Route::get('user-change-password', 'UserController@viewUserChangePassword');
	Route::post('update-password', 'UserController@updateUserPassword');
	
	Route::get('user-order-history', 'UserController@viewUserOrderHistory');
	Route::get('user-order-details/{id}/details', 'UserController@viewUserOrderDetails');
	
	Route::get('user-booking-history', 'UserController@viewUserBookingHistory');
	Route::get('user-booking-details/{id}/details', 'UserController@viewUserBookingDetails');
	
	
	Route::get('paypal', 'CartController@viewPaypal');
	Route::get('order-thank-you', 'CartController@viewOrderThankYou');
	
});
/*******************************USER ROUTES ENDS HERE*************************************/



/*******************************ADMIN ROUTES STARTS HERE*************************************/
Route::get('administrator','AdminLoginController@viewAdminLogin')->name('admin.login');
Route::post('admin-login', 'AdminLoginController@checkAdminLogin')->name('admin.login.submit');

Route::get('administrator/forgot-password','AdminLoginController@showForgotPasswordForm');
Route::post('admin-forgot', 'AdminLoginController@adminForgotPassword')->name('admin.forgot.submit');


Route::post('delete-ppd-record', 'AjaxController@deletePpdRecord');
Route::post('opt-img-delete', 'AjaxController@delOptImages');
Route::post('delete-cms-img', 'AdminController@deleteCmsImage');
	  
Route::group(['prefix' => 'administrator','middleware' => 'checkadminlogin'], function() {
	Route::get('dashboard', 'AdminController@viewAdminDashboard')->name('admin.dashboard');
  
	Route::get('my-account', 'AdminController@viewAccount');
	Route::post('update-admin-details', 'AdminController@updateAccountDetails');
	
	Route::get('change-password', 'AdminController@viewChangePassword');
	Route::post('update-password', 'AdminController@updatePassword');
  
	Route::get('manage-seo', 'AdminController@viewSeo');
	Route::post('update-seo-details', 'AdminController@updateSeoDetails');
	
	Route::resource('manage-seo-settings', 'SeoPageSettingsController');

	Route::get('payment-setting', 'AdminController@paymentSetting');
	Route::post('update-payment-setting', 'AdminController@updatePaymentSetting');
  
	Route::resource('manage-contents', 'CmsContentController');
	
	Route::resource('manage-banners', 'BannerController');
	Route::get('manage-banners/{id}/delete', 'BannerController@destroy');
	
	Route::resource('manage-ma', 'MembershipAffiliationController');
	Route::get('manage-ma/{id}/delete', 'MembershipAffiliationController@destroy');

	Route::resource('manage-services', 'OurServiceController');
	Route::get('manage-services/{id}/delete', 'OurServiceController@destroy');

	
	Route::resource('manage-category', 'CategoryController');
	Route::get('manage-category/{id}/delete', 'CategoryController@destroy');
	
	Route::resource('manage-size', 'SizeController');
	Route::get('manage-size/{id}/delete', 'SizeController@destroy');
	
	Route::resource('manage-color', 'ColorController');
	Route::get('manage-color/{id}/delete', 'ColorController@destroy');
	
	Route::resource('manage-products', 'ProductController');
	Route::get('manage-products/{id}/delete', 'ProductController@destroy');
	
	//Route::get('delete-ppd-record', 'AjaxController@deletePpdRecord');
	
	
	
	Route::resource('manage-trainings', 'TrainingController');
	Route::get('manage-trainings/{id}/delete', 'TrainingController@destroy');
	
	Route::get('manage-bookings', 'AdminController@viewTrainingBookings');
	Route::get('booking-details/{id}/details', 'AdminController@viewTrainingBookingDetails');
	
	Route::get('manage-users', 'AdminController@viewManageUsers');
	Route::get('manage-users/{id}/block', 'AdminController@blockUser');
    Route::get('manage-users/{id}/unblock', 'AdminController@unblockUser');
  
	//Route::get('booking-details/{id}/details', 'AdminController@viewTrainingBookingDetails');
	
	Route::get('manage-orders', 'AdminController@viewManageOrders');
	Route::get('order-details/{id}/details', 'AdminController@viewOrderDetails');
	Route::post('update-order-status', 'AdminController@updateOrderStatus');
	
	Route::resource('manage-testimonials', 'TestimonialController');
	Route::get('manage-testimonials/{id}/delete', 'TestimonialController@destroy');
	
	Route::resource('manage-videos', 'VideosController');
	Route::get('manage-videos/{id}/delete', 'VideosController@destroy');
	
	Route::get('admin-logout', 'AdminController@adminLogout')->name('admin.logout');
});
/*******************************ADMIN ROUTES END HERE****************************************/