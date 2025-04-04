<?php

use App\Http\Controllers\Auth\Print_ViewBookingController;

Route::get('/view-booking/{id}', [Print_ViewBookingController::class, 'viewBooking']);



