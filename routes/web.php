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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/home', 'DashboardController@index')->name('home');

Auth::routes();
Route::get('/login', 'Auth\ClientLoginController@loginForm')->name('login');
Route::post('/login', 'Auth\ClientLoginController@login');
//Route::get('/password/reset/{token?}', 'Auth\ResetClientPasswordController@showResetForm')->name('password.reset');
//Route::post('/password/reset', 'Auth\ResetClientPasswordController@reset')->name('password.update');
//Route::get('/home', 'HomeController@index')->name('home');


Route::get('payment-draft/data','PaymentController@getDraftPaymentData');
Route::get('payment-draft','PaymentController@draftPayment');
Route::get('payment-draft/{id}','PaymentController@showPaymentDraft');

Route::get('payment/data','PaymentController@getData');
Route::resource('payment','PaymentController');

Route::get('invoice/data','InvoiceController@getData');
Route::resource('invoice','InvoiceController');

Route::post('comment/store','TicketCommentController@store')->name('comment.store');
Route::get('ticket/data','TicketController@getData');
Route::resource('ticket','TicketController');

Route::get('profile/overview','ProfileController@overview');
Route::get('profile/personal-info','ProfileController@personalInfo');
Route::get('profile/change-password','ProfileController@PasswordChangeForm');
Route::post('profile/change-password','ProfileController@changePassword');
Route::post('profile/update-basic-info','ProfileController@updateByTicket')->name('profile.ticket');
Route::post('profile/update-other-info','ProfileController@update')->name('profile.update');


Route::get('vehicle/data','VehicleController@getData');
Route::resource('vehicle','VehicleController');

Route::get('offer/data','OfferController@getData');
Route::resource('offer','OfferController');

//Route::get('/logout', 'Auth\ClientLoginController@logout')->name('client.logout');
