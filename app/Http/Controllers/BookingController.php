<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class BookingController extends Controller
{
  
//////
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

    return view("AdminLayouts.BookingList", compact('bookings'));
}



  //Hiển thị form chỉnh sửa
  public function editBooking($id, $room)
  {
      // Lấy thông tin đặt phòng từ các bảng liên quan
    $booking = DB::table('dat_phong as d')
    ->join('ct_dat_phong as cd', 'd.ID_Booking', '=', 'cd.FK_ID_Booking')
    ->join('phong as p', 'cd.FK_so_phong', '=', 'p.so_phong')
    ->join('loai_phong as lp', 'p.FK_ID_loai', '=', 'lp.ID_Loai')
    ->join('khach_hang as kh', 'd.FK_ma_KH', '=', 'kh.ID_KH')
    ->join('hoa_don as hd', 'hd.FK_ID_Booking', '=', 'cd.FK_ID_Booking')
    ->where('d.ID_Booking', $id)
    ->where('p.so_phong', $room)
    ->select(
        'd.ID_Booking',
        'p.so_phong',
        'lp.ten_loai',
        'p.don_gia',
        DB::raw('DATE(d.ngay_dat) as ngay_dat'),
        DB::raw('TIME(d.ngay_dat) as gio_dat'),
        DB::raw('DATE(cd.checkindate) as ngay_vao'),
        DB::raw('TIME(cd.checkindate) as gio_vao'),
        DB::raw('DATE(cd.checkoutdate) as ngay_ra'),
        DB::raw('TIME(cd.checkoutdate) as gio_ra'),
        'cd.so_dem',
        'd.tra_truoc',
        'd.giam_tru',
        'd.ghi_chu',
        'hd.phuong_thuc',
        'kh.*'  // Lấy tất cả các trường từ bảng khach_hang
    )
    ->first();

// Nếu không tìm thấy thông tin đặt phòng hoặc phòng, trả về thông báo lỗi
if (!$booking) {
    return redirect()->route('booking.list')->withErrors('Không tìm thấy thông tin đặt phòng.');
}

// Lấy thêm thông tin chi tiết về phòng, ví dụ như phòng loại nào, trạng thái phòng,...
$roomDetails = DB::table('phong')
    ->join('loai_phong as lp', 'phong.FK_ID_loai', '=', 'lp.ID_Loai')
    ->where('phong.so_phong', $room)
    ->select('phong.*', 'lp.ten_loai')
    ->first();

// Kiểm tra nếu không tìm thấy phòng
if (!$roomDetails) {
    return redirect()->route('AdminLayouts.BookingList')->withErrors('Không tìm thấy thông tin phòng.');
}
      return view('AdminLayouts.Phieuphong', compact('booking', 'roomDetails'));
  }


/////Chỉnh sửa đặt phòng
public function updateBooking($id, Request $request)
{
    // Validate form data
    $request->validate([
        'checkin' => 'required|date',
        'checkout' => 'required|date',
        'company' => 'nullable|string|max:255',
        'prepaid' => 'nullable|numeric',
        'discount' => 'nullable|numeric',
        'notes' => 'nullable|string',
        'cccd' => 'required|string|max:20',
        'name' => 'required|string|max:255',
        'dob' => 'required|date',
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'country' => 'required|string|max:100',
        'gender' => 'required|string|max:10',
        'payment_method'=> 'required|string',
    ]);

    // Lấy các giá trị từ form
    $data = $request->only([
        'checkin', 'checkout', 'company', 'prepaid', 'discount', 'notes',
        'cccd', 'name', 'dob', 'phone', 'address', 'email', 'country', 'gender','payment_method'
    ]);

    DB::beginTransaction();  // Bắt đầu transaction

    try {
        // Cập nhật thông tin khách hàng
        DB::table('khach_hang')
            ->where('ID_KH', function($query) use ($id) {
                $query->select('FK_ma_KH')
                      ->from('dat_phong')
                      ->where('ID_Booking', $id)
                      ->limit(1);
            })
            ->update([
                'ho_ten' => $data['name'],
                'ngay_sinh' => $data['dob'],
                'sdt' => $data['phone'],
                'cccd' => $data['cccd'],
                'email' => $data['email'],
                'dia_chi' => $data['address'],
                'group' => $data['company'],
                'quoc_tich' => $data['country'],
                'gioi_tinh' => $data['gender'],
            ]);

        // Cập nhật thông tin đặt phòng
        DB::table('dat_phong')
            ->where('ID_Booking', $id)
            ->update([
                'tra_truoc' => $data['prepaid'],
                'giam_tru' => $data['discount'],
                'ghi_chu' => $data['notes'] ?? '',
            ]);

        // Cập nhật thông tin chi tiết đặt phòng
        DB::table('ct_dat_phong')
            ->where('FK_ID_Booking', $id)
            ->update([
                'checkindate' => $data['checkin'],
                'checkoutdate' => $data['checkout'],
            ]);

            //Cập nhật thông tin hóa đơn
            DB::table('hoa_don')
            ->where('FK_ID_Booking', $id)
            ->update([
                'phuong_thuc' => $data['payment_method'],
                'ngay_thanh_toan' => Carbon::now(),
            ]);
        DB::commit();  // Lưu các thay đổi
       // return redirect()->route('booking.list')->with('status', 'Cập nhật thành công!');

       return Redirect::route('booking.list')->with('status', 'Cập nhật thành công!');
    } catch (\Exception $e) {
        DB::rollBack();  // Hủy các thay đổi nếu có lỗi
        return Redirect::back()->withErrors(['error' => 'Cập nhật thất bại: ' . $e->getMessage()]);
    }


}

    /* Phương thức xử lý đặt phòng
    public function insertBooking(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'checkin' => 'required|date|before:checkout',
            'checkout' => 'required|date|after:checkin',
            'room_id' => 'required|exists:phong,so_phong',
            'cccd' => 'required|string|max:20',
            'ho_ten' => 'required|string|max:100',
            'birthday' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'company' => 'nullable|string|max:100',
            'prepay' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'note' => 'nullable|string|max:255',
            'cash' => 'required|numeric',
        ]);

        // Lấy dữ liệu từ form
        $room_id = $request->input('room_id');
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $time_checkin = $request->input('time_checkin');
        $time_checkout = $request->input('time_checkout');
        $cty_group = $request->input('company');
        $tra_truoc = $request->input('prepay');
        $giam_tru = $request->input('discount');
        $ghi_chu = $request->input('note');
        $pay = $request->input('cash');

        $cccd = $request->input('cccd');
        $ho_ten = $request->input('ho_ten');
        $ngay_sinh = $request->input('birthday');
        $sdt = $request->input('phone');
        $dia_chi = $request->input('address');
        $email = $request->input('email');
        $quoc_tich = $request->input('country');
        $gioi_tinh = $request->input('gender');

        // Kết hợp ngày và giờ cho checkin và checkout
        $checkin_datetime = $checkin . ' ' . $time_checkin;
        $checkout_datetime = $checkout . ' ' . $time_checkout;

        DB::beginTransaction(); // Bắt đầu transaction

        try {
            // Lấy đơn giá phòng từ bảng phong
            $room = DB::table('phong')->where('so_phong', $room_id)->first();
            if (!$room) {
                throw new Exception("Không tìm thấy phòng.");
            }
            $don_gia = $room->don_gia;

            // Insert khách hàng
            $customer_id = DB::table('khach_hang')->insertGetId([
                'ho_ten' => $ho_ten,
                'ngay_sinh' => $ngay_sinh,
                'sdt' => $sdt,
                'cccd' => $cccd,
                'email' => $email,
                'dia_chi' => $dia_chi,
                'quoc_tich' => $quoc_tich,
                'gioi_tinh' => $gioi_tinh,
                'group' => $cty_group,
            ]);

            // Insert đặt phòng
            $booking_id = DB::table('dat_phong')->insertGetId([
                'FK_ma_KH' => $customer_id,
                'ngay_dat' => now(),
                'tra_truoc' => $tra_truoc,
                'giam_tru' => $giam_tru,
                'ghi_chu' => $ghi_chu,
            ]);

            // Insert chi tiết đặt phòng
            DB::table('ct_dat_phong')->insert([
                'FK_ID_Booking' => $booking_id,
                'FK_so_phong' => $room_id,
                'checkindate' => $checkin_datetime,
                'checkoutdate' => $checkout_datetime,
                'don_gia' => $don_gia,
            ]);

            // Cập nhật trạng thái phòng
            DB::table('phong')->where('so_phong', $room_id)->update(['trang_thai' => 'Đã nhận']);

            // Tính tổng tiền
            $total = $don_gia; // Tính tổng tiền (theo đơn giá phòng)

            // Thêm hóa đơn
            if (Session::has('ma_nv')) {
                $nv = Session::get('ma_nv');
                DB::table('hoa_don')->insert([
                    'FK_ID_Booking' => $booking_id,
                    'tong_tien' => $total,
                    'phuong_thuc' => $pay,
                    'FK_Ma_NV' => $nv,
                    'ngay_thanh_toan' => now(),
                ]);
            } else {
                throw new Exception("Không có thông tin nhân viên.");
            }

            DB::commit(); // Commit giao dịch

            return redirect()->route('booking.list')->with('status', 'Nhận phòng thành công!');

        } catch (Exception $e) {
            DB::rollback(); // Rollback nếu có lỗi
            return back()->with('error', 'Lỗi khi xử lý: ' . $e->getMessage());
        }
    }
        */
}
