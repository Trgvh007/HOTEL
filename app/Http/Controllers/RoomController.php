<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
class RoomController extends Controller
{
    public function index()
    {
        return view('Customer_Layouts.index');
    }
    public function search(Request $request)
    {
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $request->validate([
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'rooms' => 'required|integer|min:1',
        ]);
        // Thực hiện truy vấn trực tiếp đến cơ sở dữ liệu
        $rooms = DB::table('phong as p')
            ->join('loai_phong as lp', 'p.FK_ID_loai', '=', 'lp.ID_Loai')
            ->select('p.so_phong', 'p.FK_ID_loai', 'p.hinh_anh', 'p.loai_giuong', 'p.don_gia', 'p.trang_thai',
                     'lp.ten_loai', 'lp.dien_tich', 'lp.mo_ta', 'p.view')
            ->where('p.trang_thai', 'Trống')
            ->get();
        return view('Customer_Layouts.index', compact('rooms', 'checkin', 'checkout'));
    }
    public function show($room_id)
    {
        $room = DB::table('phong as p')
            ->join('loai_phong as lp', 'p.FK_ID_loai', '=', 'lp.ID_Loai')
            ->select('p.*', 'lp.mo_ta', 'lp.so_nguoi', 'lp.ten_loai', 'lp.dien_tich')
            ->where('p.so_phong', $room_id)
            ->first();
        if (!$room) {
            abort(404, 'Phòng không tồn tại');
        }
        // Lấy danh sách tiện nghi
        $amenities = DB::table('bang_tien_nghi as btn')
            ->join('tien_nghi as tn', 'btn.ID_tien_nghi', '=', 'tn.ID_TN')
            ->where('btn.FK_ID_loai', $room->FK_ID_loai)
            ->select('tn.ten_tien_nghi')
            ->get();
        return view('Customer_Layouts.chitietphong', compact('room', 'amenities'));
    }
    public function xacNhan(Request $request)
{
    // 1. Validate cơ bản
    $validated = $request->validate([
        'checkin' => 'required|date',
        'checkout' => 'required|date|after:checkin',
        'booking_time' => 'required|string',
        'total_price' => 'required|string',
        'rooms' => 'required|array|min:1',
        'rooms.*.room_name' => 'required|string',
        'rooms.*.room_number' => 'required|string',
        'rooms.*.price' => 'required|string',
    ]);

    // 2. Gửi dữ liệu sang view
    return view('Customer_Layouts.xacnhan', [
        'bookingData' => $validated
    ]);
}

    public function confirmBooking(Request $request)
    {
        // Xác nhận thông tin đầu vào từ form
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'cccd' => 'required|string',
            'email' => 'required|email',
            'payment_method' => 'required|string',
            'rooms' => 'required|array',
        ]);

        // Lấy dữ liệu từ form
        $ho_ten = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $cccd = $request->input('cccd');
        $ghi_chu = $request->input('note');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $rooms = $request->input('rooms');
        $payment_method = $request->input('payment_method');

        // Tính tổng tiền
        $tong_tien = 0;
        foreach ($rooms as $room) {
            $tong_tien += $room['total'];
        }

        // Tính số đêm
        $so_dem = (strtotime($checkout) - strtotime($checkin)) / 86400;

        // Bắt đầu giao dịch
        DB::beginTransaction();
        try {
            // Lưu thông tin khách hàng
            $id_khach_hang = DB::table('khach_hang')->insertGetId([
                'ho_ten' => $ho_ten,
                'email' => $email,
                'sdt' => $phone,
                'cccd' => $cccd,
            ]);

            // Lưu thông tin đặt phòng
            $id_booking = DB::table('dat_phong')->insertGetId([
                'ghi_chu' => $ghi_chu,
                'FK_ma_KH' => $id_khach_hang,
                'ngay_dat' => Carbon::now(),
            ]);

            // Cập nhật trạng thái phòng
            foreach ($rooms as $room) {
                DB::table('phong')
                    ->where('so_phong', $room['roomNumber'])
                    ->update(['trang_thai' => 'Đặt trước']);
            }

            // Lưu thông tin chi tiết phòng
            foreach ($rooms as $room) {
                DB::table('ct_dat_phong')->insert([
                    'FK_ID_Booking' => $id_booking,
                    'FK_so_phong' => $room['roomNumber'],
                    'checkindate' => $checkin,
                    'checkoutdate' => $checkout,
                    'don_gia' => $room['price'],
                ]);
            }

            // Thêm thông tin hóa đơn
            $ngay_thanh_toan = ($payment_method === "Quét mã QR") ? Carbon::now() : null;

            DB::table('hoa_don')->insert([
                'tong_tien' => $tong_tien,
                'phuong_thuc' => $payment_method,
                'FK_ID_Booking' => $id_booking,
                'ngay_thanh_toan' => $ngay_thanh_toan,
            ]);

            // Commit giao dịch
            DB::commit();

            // Redirect hoặc trả về thông báo thành công
            return redirect()->route('booking.success')->with('message', 'Đặt phòng thành công!');
        } catch (\Exception $e) {
            // Rollback giao dịch nếu có lỗi
            DB::rollBack();
            return back()->withErrors(['error' => 'Đã có lỗi xảy ra, vui lòng thử lại!']);
        }
    }
    public function success()
    {
        return view('Customer_Layouts.thanhcong');
    }
}
