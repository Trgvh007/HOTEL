<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;


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
  public function editAjax($id, $room)
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
      return view('AdminLayouts.Phieuphong', compact('booking', 'roomDetails'))->with('action', 'edit');;
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
       return redirect()->route('booking.list')->with('status', 'Cập nhật thành công!');

       //return Redirect::route('booking.list')->with('status', 'Cập nhật thành công!');
    } catch (\Exception $e) {
        DB::rollBack();  // Hủy các thay đổi nếu có lỗi
        return Redirect::back()->withErrors(['error' => 'Cập nhật thất bại: ' . $e->getMessage()]);
    }


}

    // Phương thức xử lý đặt phòng
    public function insertBooking(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'checkin' => 'required|date|before:checkout',
            'checkout' => 'required|date|after:checkin',
            'room_id' => 'required|exists:phong,so_phong',
            'cccd' => 'required|string|max:20',
            'name' => 'required|string|max:100',
            'dob' => 'required|date',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country' => 'required|string|max:50',
            'gender' => 'required|string|max:10',
            'company' => 'nullable|string|max:100',
            'prepaid' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'notes' => 'nullable|string|max:255',
            'payment_method' => 'required|string|max:50',
        ]);

        // Lấy dữ liệu từ form
        $room_id = $request->input('room_id');
        //$checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        //$time_checkin = $request->input('time_checkin');
        $time_checkout = $request->input('time_checkout');
        $cty_group = $request->input('company');
        $tra_truoc = $request->input('prepaid');
        $giam_tru = $request->input('discount');
        $ghi_chu = $request->input('notes');
        $pay = $request->input('payment_method');

        $cccd = $request->input('cccd');
        $ho_ten = $request->input('name');
        $ngay_sinh = $request->input('dob');
        $sdt = $request->input('phone');
        $dia_chi = $request->input('address');
        $email = $request->input('email');
        $quoc_tich = $request->input('country');
        $gioi_tinh = $request->input('gender');

        // Kết hợp ngày và giờ cho checkin và checkout
        $checkin_datetime = now();
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
                'checkindate' => now(),
                'checkoutdate' => $checkout_datetime,
                'don_gia' => $don_gia,
            ]);

            // Cập nhật trạng thái phòng
            DB::table('phong')->where('so_phong', $room_id)->update(['trang_thai' => 'Đã nhận']);

           
        // 4.4 Lấy tổng tiền từ bảng ct_dat_phong đã tính sẵn
$total = DB::table('ct_dat_phong')
->where('FK_ID_Booking', $booking_id)
->value('thanh_tien'); // Tính tổng tiền (theo đơn giá phòng)

            // Thêm hóa đơn
            $user = auth()->user();
            if ($user && $user->nhanVien) {
                // Lấy Ma_NV từ bảng nhan_vien thông qua mối quan hệ đã định nghĩa trong mô hình User
                $nv = $user->nhanVien->Ma_NV; 
            
                DB::table('hoa_don')->insert([
                    'FK_ID_Booking' => $booking_id,
                    'tong_tien' => $total,
                    'phuong_thuc' => $pay,
                    'FK_Ma_NV' => $nv,
                    'ngay_thanh_toan' => now(),
                    'trang_thai' => "Đã thanh toán"
                ]);
            } else {
                throw new Exception("Không có thông tin nhân viên.");
           }

            DB::commit(); // Commit giao dịch

            return redirect()->route('admin.quanly')->with('status', 'Nhận phòng thành công!');

        } catch (Exception $e) {
            DB::rollback(); // Rollback nếu có lỗi
           // Lấy mã lỗi SQL
    $sqlErrorCode = $e->errorInfo[1];

    // Gợi ý lỗi phổ biến
    $errorMessage = 'Lỗi khi xử lý đặt phòng.';

    if ($sqlErrorCode == 1062) {
        // 1062 là lỗi Duplicate entry (MySQL)
        $errorMessage = 'Dữ liệu đã tồn tại. Có thể CCCD, email hoặc số điện thoại bị trùng.';
    } elseif ($sqlErrorCode == 1452) {
        // 1452 là lỗi foreign key constraint fails
        $errorMessage = 'Ràng buộc dữ liệu không đúng. Có thể ID phòng hoặc khách hàng không tồn tại.';
    }

    return back()->with('error', $errorMessage);
} catch (Exception $e) {
    DB::rollback();
    return back()->with('error', 'Lỗi không xác định: ' . $e->getMessage());
    }
}
        //hiển thị form nhận phòng
    public function createBooking($room_id)
{
    $roomDetails = DB::table('phong')
        ->join('loai_phong as lp', 'phong.FK_ID_loai', '=', 'lp.ID_Loai')
        ->where('phong.so_phong', $room_id)
        ->select('phong.*', 'lp.ten_loai')
        ->first();

    if (!$roomDetails) {
        return redirect()->route('booking.list')->withErrors('Không tìm thấy thông tin phòng.');
    }

    return view('AdminLayouts.Phieuphong', [
        'roomDetails' => $roomDetails,
        'booking' => null,
        'now' => now(),
        'action' => 'create'
    ]);
}

//Hàm xóa
public function delete(Request $request)
{
    $bookingId = $request->input('id');
    $roomNumber = $request->input('room');

    try {
        DB::beginTransaction();

        // Xóa chi tiết đặt phòng
        DB::table('ct_dat_phong')
            ->where('FK_ID_Booking', $bookingId)
            ->where('FK_so_phong', $roomNumber)
            ->delete();

        // Cập nhật trạng thái phòng
        DB::table('phong')
            ->where('so_phong', $roomNumber)
            ->update(['trang_thai' => 'Trống']);

        // Kiểm tra nếu không còn phòng nào khác thì xóa dat_phong
        $remaining = DB::table('ct_dat_phong')
            ->where('FK_ID_Booking', $bookingId)
            ->count();

        if ($remaining === 0) {
            DB::table('dat_phong')
                ->where('ID_Booking', $bookingId)
                ->delete();

            DB::table('hoa_don')
                ->where('FK_ID_Booking', $bookingId)
                ->delete();
        }

        DB::commit();

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
}


public function showTransferForm($room)
    {
        $oldRoom = $room;
        $roomTypes = DB::table('loai_phong')->get();

        return view('AdminLayouts.Chuyenphong', compact('oldRoom', 'roomTypes'));
    }

    public function fetchRooms(Request $request)
    {
        $roomTypeId = $request->query('room_type'); // lấy loại phòng từ request

        // Kiểm tra nếu room_type không tồn tại hoặc là null
        if (!$roomTypeId) {
            return response()->json(['error' => 'Room type is required'], 400);
        }
    
        // Truy vấn bảng phong và lấy các phòng trống
        $rooms = DB::table('phong')
            ->where('FK_ID_loai', $roomTypeId) // Điều kiện loại phòng
            ->where('trang_thai', 'Trống') // Điều kiện phòng trống
            ->pluck('so_phong'); // Lấy số phòng
    
        // Nếu không tìm thấy phòng trống
        if ($rooms->isEmpty()) {
            return response()->json(['error' => 'No available rooms'], 404);
        }
    
        return response()->json($rooms);
    }
    
    
//
    public function submitTransfer(Request $request)
    {
        $request->validate([
            'room-number' => 'required',
            'old-room' => 'required'
        ]);

        $oldRoom = $request->input('old-room');
        $newRoom = $request->input('room-number');

        DB::beginTransaction();

        try {
            DB::table('ct_dat_phong')
                ->where('FK_so_phong', $oldRoom)
                ->update(['FK_so_phong' => $newRoom]);

            DB::table('phong')
                ->where('so_phong', $newRoom)
                ->update(['trang_thai' => 'Đặt trước', 'ngay_cap_nhat' => now()]);

            DB::table('phong')
                ->where('so_phong', $oldRoom)
                ->update(['trang_thai' => 'Trống', 'ngay_cap_nhat' => now()]);

            DB::commit();


            return redirect()->route('booking.list')->with('success', 'Chuyển phòng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Lỗi chuyển phòng: ' . $e->getMessage()]);
        }
    }

//customer 
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