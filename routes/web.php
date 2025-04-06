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
