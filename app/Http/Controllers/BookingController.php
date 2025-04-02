<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    //
    public function getBookings() {
        $bookings = DB::table('khach_hang as kh')
        ->join('dat_phong as dp', 'dp.FK_Ma_KH', '=', 'kh.ID_KH')
        ->join('ct_dat_phong as ct', 'dp.ID_Booking', '=', 'ct.FK_ID_Booking')
        ->join('phong as ph', 'ph.so_phong', '=', 'ct.FK_so_phong')
        ->join('loai_phong as lp', 'lp.ID_loai', '=', 'ph.FK_ID_loai')
        ->join('hoa_don as hd', 'hd.FK_ID_Booking', '=', 'dp.ID_Booking')
        ->select([
            'ct.FK_ID_Booking as ma_booking',
            'kh.ho_ten',
            'ct.checkindate',
            'ct.checkoutdate',
            'ct.FK_so_phong as phong',
            'dp.ngay_dat',
            'hd.trang_thai'
        ])
        ->orderBy('ct.checkindate', 'DESC')
        ->orderBy('dp.ngay_dat', 'DESC')
        ->get()
        ->groupBy(function ($booking) {
            return date('Y-m-d', strtotime($booking->checkindate));
        });

    return view("CustomerLayouts.BookingList", compact('bookings'));
}

}
