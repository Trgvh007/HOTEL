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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

<<<<<<< HEAD

Route::get('/BookingList','App\Http\Controllers\BookingController@getBookings')->name('booking.list');
Route::post('booking/update/{id}', 'App\Http\Controllers\BookingController@updateBooking')->name('booking.update');
Route::get('/booking/edit/{id}/{room}', 'App\Http\Controllers\BookingController@editBooking')->name('booking.edit');
Route::post('/booking/insert', 'App\Http\Controllers\BookingController@insertBooking')->name('booking.insert');
Route::get('/quanly', 'App\Http\Controllers\RoomController@index');

Route::get('/phieunhanphong/{id}', 'App\Http\Controllers\BookingController@createBooking')->name('booking.create');
Route::post('/deletebooking', 'App\Http\Controllers\BookingController@delete')->name('booking.delete');

// Form chuyển phòng
Route::get('/chuyen-phong/{room}', 'App\Http\Controllers\BookingController@showTransferForm')->name('chuyen-phong');

// Lấy danh sách phòng trống theo loại (AJAX)
Route::get('/fetchrooms', 'App\Http\Controllers\BookingController@fetchRooms')->name('fetch.rooms');
// Route để fetch danh sách phòng
Route::get('/ajax/fetch-rooms', 'App\Http\Controllers\BookingController@fetchRooms')->name('ajax.fetch-rooms');

// Xử lý chuyển phòng (POST)
Route::post('/chuyen-phong', 'App\Http\Controllers\BookingController@submitTransfer')->name('chuyen-phong.submit');
=======
use App\Http\Controllers\RoomController;

Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

Route::post('/rooms', [RoomController::class, 'search'])->name('rooms.search');

Route::post('/rooms/xacnhan', [RoomController::class, 'xacNhan'])->name('rooms.xacnhan');
Route::get('/rooms/xacnhan', [RoomController::class, 'xacNhan'])->name('rooms.xacnhan');

Route::post('/confirm-booking', [RoomController::class, 'confirmBooking'])->name('booking.confirm');
Route::get('/confirm-booking', [RoomController::class, 'confirmBooking'])->name('booking.confirm');
Route::get('/booking-success', [RoomController::class, 'success'])->name('thanhcong');

//chi tiết phòng mới
// web.php
Route::get('/rooms/show/{room_id}', [RoomController::class, 'show'])->name('rooms.show');
//chaythu
Route::get('/dienform', [RoomController::class, 'chaythu'])->name('chaythu');
Route::post('/themdulieu', 'App\Http\Controllers\RoomController@chaythu')->name("them");

// Xử lý lưu sách
Route::post('/batdauluu', 'App\Http\Controllers\RoomController@luudulieu')->name("luu");
>>>>>>> Cus_Booking_RoomDetail_Filter(Ad)
