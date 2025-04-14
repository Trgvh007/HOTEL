<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

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


//Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
//Route::get('login', [LoginController::class, 'getLogin'])->name('login');

// Public routes


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/trangchu', [HomeController::class, 'trangchu'])->name('home');

require __DIR__.'/auth.php';
// Room routes
Route::prefix('rooms')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('rooms.index');
    Route::get('/search', [RoomController::class, 'search'])->name('rooms.search');
    Route::get('/{room}', [RoomController::class, 'show'])->name('rooms.show');
});

// Booking routes
Route::middleware(['admin:1|3'])->group(function () {


    Route::prefix('booking')->group(function () {
        Route::get('/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
        Route::post('/store', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/done', [BookingController::class, 'done'])->name('booking.done');
    });

    Route::get('/BookingList', [BookingController::class, 'getBookings'])->name('booking.list');
    Route::post('booking/update/{id}', [BookingController::class, 'updateBooking'])->name('booking.update');
    Route::get('/booking/edit/{id}/{room}', [BookingController::class, 'editBooking'])->name('booking.edit');
    Route::post('/booking/insert', [BookingController::class, 'insertBooking'])->name('booking.insert');

    Route::get('/quanly', [RoomController::class, 'quanly'])->name('admin.quanly');

    Route::get('/phieunhanphong/{id}', [BookingController::class, 'createBooking'])->name('booking.create');
    Route::post('/deletebooking', [BookingController::class, 'delete'])->name('booking.delete');

    // Chuyển phòng
    Route::get('/chuyen-phong/{room}', [BookingController::class, 'showTransferForm'])->name('chuyen-phong');
    Route::post('/chuyen-phong', [BookingController::class, 'submitTransfer'])->name('chuyen-phong.submit');

    // AJAX room fetch
    Route::get('/fetchrooms', [BookingController::class, 'fetchRooms'])->name('fetch.rooms');
    Route::get('/ajax/fetch-rooms', [BookingController::class, 'fetchRooms'])->name('ajax.fetch-rooms');


   
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/'); // hoặc về trang chủ
})->name('logout');


Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');

Route::post('/rooms', [RoomController::class, 'search'])->name('search1');


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
Route::get('/booking/edit-ajax/{id}/{room}', [BookingController::class, 'editAjax'])->name('booking.editAjax');

Route::post('/batdauluu', 'App\Http\Controllers\RoomController@luudulieu')->name("luu");

