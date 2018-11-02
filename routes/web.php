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



    Route::match(['get', 'post'],'/guest/occupy_guest','GuestController@getOccupyGuestList');

    Route::match(['get', 'post'],'/guest/reserve_guest','GuestController@getReservedGuestList');

    Route::match(['get', 'post'],'/guest/hotel_archive','GuestController@getGuestArchive');



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

    Route::match(['get', 'post'], '/settings/update_fd/{id}','ManageController@updatefd');



    //Delete route
    Route::get('/settings/delete-room/{id}','ManageController@deleteRoom');

    Route::get('/settings/delete-roomtype/{id}','ManageController@deleteRoomType');

    Route::get('/settings/delete-roomextra/{id}','ManageController@deleteRoomExtra');

    Route::get('/settings/delete-roomextracategory/{id}','ManageController@deleteRoomExtraCategory');

    Route::get('/settings/delete-frontdesk/{id}','ManageController@deleteFrontDesk');



    //another function
    Route::match(['get','post'], '/status/roomreservedexisting/{id}','ManageController@reservedExisting');

    Route::match(['get','post'], '/status/roomreservedexisting1/{id}','ManageController@reservedExisting1');

    Route::match(['get','post'], '/status/getextra/{id}','ExtraController@addCustomerExtra');

    Route::get('/status/delete-extra/{id}','ExtraController@deleteExtra');

    Route::match(['get','post'], '/status/getReserve/{id}','BookingController@roomReserveExisting');



    //Route::match(['get','post'],'/','checkoutController@getCheckOut');
    Route::match(['get','post'],'/multiple_reservation/index','ReservationController@getReserve');

    Route::match(['get','post'], '/multiple_reservation/getReserve/{id}','ReservationController@getSave');

    Route::match(['get','post'], '/multiple_reservation/getnameReserve/{id}','ReservationController@nameReserved');

    Route::match(['get','post'], '/multiple_reservation/getdateReserve/{id}','ReservationController@dateReserved');

    Route::match(['get','post'], '/multiple_reservation/reserved/{id}','ReservationController@viewReserve');

    Route::match(['get','post'], '/multiple_reservation/reservedroom/{id}','ReservationController@roomReserved');

    Route::match(['get','post'], '/setDateAnotherRoom/{id}','ReservationController@getdateSave');

    //Route::match(['get','post'], '/multiple_reservation/getReserve1/{id}','ReservationController@getDateSave');

    //void room or delete
    Route::match(['get','post'], '/void-room/{id}','ReservationController@voidRoom');

    Route::match(['get','post'], '/void-room1/{id}','ReservationController@cancelTheRoom');

    Route::match(['get', 'post'], '/multiple_reservation/print/{id}', 'ReservationController@print');



    Route::match(['get','post'], '/multiple_reservation/occupy/{id}','OccupyController@occupyRoom');

    Route::match(['get','post'], '/multiple_reservation/getOccupy/{id}','OccupyController@getOccupySave');

    Route::match(['get','post'], '/multiple_reservation/getnameOccupy/{id}','OccupyController@nameOccupy');

    Route::match(['get','post'], '/multiple_reservation/getdateOccupy/{id}','OccupyController@dateOccupy');

    Route::match(['get','post'], '/multiple_reservation/selectRoom/{id}','OccupyController@roomOccupy');

    Route::match(['get','post'], '/voidOccupy-room/{id}','OccupyController@voidOccupyRoom');

    Route::match(['get','post'], '/multiple_reservation/setdate/{id}','OccupyController@setdateSave');


    //multiple reserve view
    Route::match(['get','post'], '/viewReservedCustomer/{id}','GuestController@viewCustomerReserve');

    Route::match(['get','post'], '/setDate/{id}','ReservationController@getdateSave1');

    Route::match(['get','post'], '/void-Allroom/{id}','ReservationController@voidAllRoom');

    Route::get('/viewApplication/{id}','ReservationController@viewOccupyApplication');

    Route::match(['get','post'], '/Occupy-Allroom/{id}','ReservationController@occupyReserveRoom');

    Route::match(['get','post'], '/Occupy-Oneroom/{id}','ReservationController@occupyOnlyOne');

    Route::match(['get','post'], '/occupyReserve-room/{id}','ReservationController@occupySpecificRoom');

    Route::match(['get','post'], '/cancelReserve-room/{id}','ReservationController@cancelReservedRoom');

    //Route::match(['get','post'], '/Occupy-view-Allroom/{id}','Occupy@viewOccupyRoom');


    Route::match(['get','post'], '/viewExtra/{id}','OccupyController@viewExtra');

  //  Route::match(['get','post'], '/extra/{id}','OccupyController@addExtra');

    Route::get('/delete-extra/{id}','OccupyController@voidExtra');

    Route::get('/printReserve/{id}','BookingController@printReserve');

    Route::match(['get', 'post'], '/multiple_occupy/print/{id}', 'OccupyController@print');

    Route::match(['get', 'post'], '/multiple_occupied/print/{id}', 'OccupyController@print_occupied');

    Route::match(['get', 'post'], '/multiple_occupy/print1/{id}', 'OccupyController@print1');

    Route::match(['get','post'], '/occupy/getextra/{id}','OccupyController@addOccupyExtra');

    Route::match(['get','post'], '/OccupyCheckout/{id}','OccupyController@checkoutOnce');

    Route::match(['get','post'],'/checkOutall/{id}','OccupyController@checkoutAll');



    Route::match(['get','post'],'/reports/generateRecord/','ReportController@fetchRecord');

    Route::match(['get','post'],'/reports/print/{id}','ReportController@print');



    Route::match(['get','post'],'/viewOccupiedCustomer/{id}','GuestController@viewCustomerOccupy');


});

Route::get('/logout', 'AdminController@logout');

