<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Print_ViewBookingController extends Controller
{
    public function viewBooking($id)

    {
        $booking = DB::table('dat_phong')
            ->join('khach_hang', 'dat_phong.FK_ma_KH', '=', 'khach_hang.ID_KH')
            ->where('dat_phong.ID_Booking', $id)
            ->select(
                'dat_phong.ID_Booking',
                'dat_phong.ngay_dat',
                'khach_hang.ho_ten',
                'khach_hang.email'
            )
            ->first();

        if (!$booking) {
            abort(404, 'Không tìm thấy đơn đặt phòng');
        }

        $rooms = DB::table('ct_dat_phong')
            ->where('FK_ID_Booking', $id)
            ->select(
                'FK_so_phong as roomNumber',
                'checkindate',
                'checkoutdate',
                'so_dem',
                'don_gia',
                'thanh_tien'
            )
            ->get();

        $totalAmount = $rooms->sum('thanh_tien');

        return view('Customer_Layouts.ViewBooking', [

            'id' => $booking->ID_Booking,
            'ho_ten' => $booking->ho_ten,
            'email' => $booking->email,
            'checkin' => optional($rooms->first())->checkindate,
            'checkout' => optional($rooms->first())->checkoutdate,
            'booking_time' => $booking->ngay_dat,
            'rooms' => $rooms,
            'totalAmount' => $totalAmount
        ]);
    }
}
