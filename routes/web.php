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
Route::post('/booking/insert', 'App\Http\Controllers\BookingController@storeBooking')->name('booking.insert');


