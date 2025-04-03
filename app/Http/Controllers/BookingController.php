<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function confirm(Request $request)
    {
        // Get booking data from session
        $bookingData = session('booking_data', []);
        $checkin = session('checkin');
        $checkout = session('checkout');
        $rooms = session('selected_rooms', []);
        
        // Calculate total amount
        $totalAmount = 0;
        foreach ($rooms as $room) {
            $totalAmount += $room['total'];
        }

        // Get user data if logged in
        $userData = [];
        if (auth()->check()) {
            $user = auth()->user();
            $userData = [
                'ho_ten' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
                'cccd' => $user->cccd ?? ''
            ];
        }

        return view('confirm', compact('checkin', 'checkout', 'rooms', 'totalAmount', 'userData'));
    }

    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'cccd' => 'required|string|max:20',
            'note' => 'nullable|string',
            'payment_method' => 'required|in:Thanh toán khi nhận phòng,Quét mã QR',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'rooms' => 'required|json'
        ]);

        try {
            DB::beginTransaction();

            // Insert customer data
            $customerId = DB::table('khach_hang')->insertGetId([
                'ho_ten' => $validated['name'],
                'email' => $validated['email'],
                'sdt' => $validated['phone'],
                'cccd' => $validated['cccd']
            ]);

            // Create booking
            $bookingId = DB::table('dat_phong')->insertGetId([
                'ghi_chu' => $validated['note'],
                'FK_ma_KH' => $customerId,
                'ngay_dat' => now()
            ]);

            // Decode rooms data
            $rooms = json_decode($validated['rooms'], true);
            
            // Insert booking details and update room status
            foreach ($rooms as $room) {
                // Insert booking detail
                DB::table('ct_dat_phong')->insert([
                    'FK_ID_Booking' => $bookingId,
                    'FK_so_phong' => $room['roomNumber'],
                    'checkindate' => $validated['checkin'],
                    'checkoutdate' => $validated['checkout'],
                    'don_gia' => $room['price']
                ]);

                // Update room status
                DB::table('phong')
                    ->where('so_phong', $room['roomNumber'])
                    ->update([
                        'trang_thai' => 'Đặt trước',
                        'ngay_cap_nhat' => now()
                    ]);
            }

            // Calculate total amount
            $totalAmount = array_sum(array_column($rooms, 'total'));

            // Insert invoice
            $paymentDate = $validated['payment_method'] === 'Quét mã QR' ? now() : null;
            DB::table('hoa_don')->insert([
                'tong_tien' => $totalAmount,
                'phuong_thuc' => $validated['payment_method'],
                'FK_ID_Booking' => $bookingId,
                'ngay_thanh_toan' => $paymentDate
            ]);

            DB::commit();

            // Store booking information in session
            session([
                'id_booking' => $bookingId,
                'ho_ten' => $validated['name'],
                'email' => $validated['email'],
                'rooms' => $validated['rooms'],
                'totalAmount' => $totalAmount,
                'checkin' => $validated['checkin'],
                'checkout' => $validated['checkout'],
                'booking_time' => now()
            ]);

            return redirect()->route('booking.done');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking error: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi đặt phòng. Vui lòng thử lại.');
        }
    }
} 