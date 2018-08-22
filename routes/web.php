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

// Route::get('/', function () {
//     return view('welcome');
// });








// Route::get('/', 'AdminController@loginpage');

Route::get('/', 'AdminController@loginpage');

Route::get('/home', 'HomeController@index')->name('home');

Route::match(['get','post'], '/admin', 'AdminController@login');

Auth::routes();


// Route::get('/settings/room', 'ManageController@manageRoom');
Route::group(['middleware' => ['auth']],function(){

    Route::get('/admin/dashboard', 'AdminController@dashboard');

    Route::get('/settings/changePassword', 'AdminController@cpassword')->name('ChangePassword');

    Route::get('/admin/check-pwd','AdminController@chkPassword');

    Route::match(['get', 'post'], '/admin/update-pwd','AdminController@updatePassword');

    Route::match(['get', 'post'],'/settings/add-room','ManageController@addRoom');

    Route::get('/settings/room', 'ManageController@viewRoomList');

    Route::match(['get', 'post'], '/settings/edit_room/{id}','ManageController@editRoomList');

    Route::get('/settings/room_type', 'ManageController@roomType');

    Route::match(['get','post'],'/settings/room-type', 'ManageController@addRoomType');

    Route::match(['get', 'post'], '/settings/edit_roomType/{id}','ManageController@updateRoomType');

    Route::get('/settings/room_extra', 'ManageController@roomExtra');

    Route::get('/settings/room_categoryExtra', 'ManageController@viewCatExtra');

    Route::match(['get', 'post'],'/settings/room-addcategoryExtra','ManageController@addCatExtra');

    Route::match(['get', 'post'], '/settings/edit_extraCategory/{id}','ManageController@updateCatExtra');

    Route::match(['get', 'post'],'/settings/add-extra','ManageController@addExtra');

    Route::match(['get', 'post'],'/settings/edit_extra/{id}','ManageController@updateExtra');

    Route::match(['get', 'post'], '/status/room_checkin/{id}', 'BookingController@bookIn');

    Route::match(['get', 'post'],'/status/add-reserve/{id}','BookingController@roomReserve');

    Route::match(['get','post'],'/status/room_reserved/{id}', 'BookingController@bookIn');

    Route::match(['get', 'post'],'/status/occupied-room','BookingController@occupiedRoom');

    Route::match(['get', 'post'],'/status/occupy-room/{id}','BookingController@room_occupy');

    Route::match(['get', 'post'],'/admin/cancel-reserve/{id}','BookingController@reserveCancel');

    Route::get('/status/room_occupy', 'ManageController@bookIn');

    Route::match(['get', 'post'],'/guest/hotel_guest','GuestController@getGuestList');

    // Route::match(['get', 'post'], '/status/invoice/{id}', 'BookingController@invoice');

    Route::get('/dynamic_pdf', 'GuestController@index');

    Route::get('/customers/pdf', 'GuestController@export_pdf');

    Route::get('/checkout/index', 'CheckoutController@checkOut')->name('out');

    Route::get('/reports/index', 'ReportController@reportsCollection')->name('collection');

    Route::get('/reports/remitt', 'ReportController@remittedCollection')->name('rcollection');

    Route::get('/settings/user', 'ManageController@userAdmin')->name('user');
    // Route::get('/home', 'HomeController@index')->name('home');
    Route::match(['get', 'post'],'/status/invoice/{id}', 'GuestController@index');

    Route::match(['get', 'post'],'/export/{id}', 'GuestController@export');

    Route::match(['get', 'post'],'/settings/add-user','AdminController@user_reg');

    Route::match(['get','post'],'/settings/frontdesk', 'ManageController@front_desk')->name('front');


    Route::match(['get', 'post'],'/settings/add-fd','ManageController@addfd');

});

Route::get('/logout', 'AdminController@logout');

