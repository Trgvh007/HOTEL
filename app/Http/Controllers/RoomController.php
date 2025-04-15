<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;



class RoomController extends Controller
{
  
   

    public function quanly()

    {
        // Fetch room status counts
        $statusCounts = DB::table('phong')
            ->select('trang_thai', DB::raw('COUNT(*) as so_luong'))
            ->groupBy('trang_thai')
            ->get();

        // Fetch room details
        $rooms = DB::table('phong')
            ->join('loai_phong', 'phong.FK_ID_loai', '=', 'loai_phong.ID_Loai')
            ->select('phong.tang', 'phong.so_phong', 'loai_phong.ten_loai', 'phong.don_gia', 'phong.trang_thai', 'phong.ngay_cap_nhat')
            ->orderBy('phong.tang')
            ->orderBy('phong.so_phong')
            ->get();

        return view('AdminLayouts.Quanly', compact('statusCounts', 'rooms'));
    }

    // Helper function to format status class
    public static function formatStatusClass($status)
    {
        if (!$status) return '';

        // Chuẩn hoá tiếng Việt, viết thường, xoá dấu
        $status = self::normalizeStatus($status);
    
        switch ($status) {
            case 'trong':
                return 'trong';
            case 'dat truoc':
                return 'dat-truoc';
            case 'da nhan':
                return 'da-nhan';
            case 'don dep':
                return 'don-dep';
            case 'sua chua':
                return 'sua-chua';
            default:
                return '';
        }
    }
    
    private static function normalizeStatus($str)
    {
        $str = mb_strtolower(trim($str), 'UTF-8');
        $str = str_replace(
            ['à','á','ạ','ả','ã','â','ầ','ấ','ậ','ẩ','ẫ','ă','ằ','ắ','ặ','ẳ','ẵ',
             'è','é','ẹ','ẻ','ẽ','ê','ề','ế','ệ','ể','ễ',
             'ì','í','ị','ỉ','ĩ',
             'ò','ó','ọ','ỏ','õ','ô','ồ','ố','ộ','ổ','ỗ','ơ','ờ','ớ','ợ','ở','ỡ',
             'ù','ú','ụ','ủ','ũ','ư','ừ','ứ','ự','ử','ữ',
             'ỳ','ý','ỵ','ỷ','ỹ',
             'đ'],
            ['a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a','a',
             'e','e','e','e','e','e','e','e','e','e','e',
             'i','i','i','i','i',
             'o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o','o',
             'u','u','u','u','u','u','u','u','u','u','u',
             'y','y','y','y','y',
             'd'],
            $str
        );
    
        return preg_replace('/\s+/', ' ', $str); // Loại khoảng trắng thừa
}



    public function index()
    {
        return view('Customer_Layouts.index');
    }

    public function search(Request $request)
{
    $checkin = $request->input('checkin');
    $checkout = $request->input('checkout');
    $roomCount = $request->input('rooms'); // đổi tên để không đụng với danh sách phòng

    $request->validate([
        'checkin' => 'required|date|after_or_equal:today',
        'checkout' => 'required|date|after:checkin',
        'rooms' => 'required|integer|min:1',
    ]);

    $rooms = DB::table('phong as p')
        ->join('loai_phong as lp', 'p.FK_ID_loai', '=', 'lp.ID_Loai')
        ->select('p.so_phong', 'p.FK_ID_loai', 'p.hinh_anh', 'p.loai_giuong', 'p.don_gia', 'p.trang_thai',
                 'lp.ten_loai', 'lp.dien_tich', 'lp.mo_ta', 'p.view')
        ->where('p.trang_thai', 'Trống')
        ->get();

    return view('Customer_Layouts.index', [
        'rooms' => $rooms,
        'checkin' => $checkin,
        'checkout' => $checkout,
        'roomCount' => $roomCount // truyền thêm biến này
    ]);
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
    
   
   
public function chaythu(Request $request)
{
    $checkin = $request->input('checkin');
    $checkout = $request->input('checkout');
    $bookingTime = $request->input('booking_time');
    $totalPrice = $request->input('total_price');
    $rooms = $request->input('rooms', []);

    $user = Auth::user(); // Lấy thông tin user nếu đã đăng nhập

    return view('Customer_Layouts.chaythu', compact(
        'checkin',
        'checkout',
        'bookingTime',
        'totalPrice',
        'rooms',
        'user' // truyền thêm
    ));
}



public function luudulieu(Request $request)
{
   
    $paymentMethod = $request->input('payment_method');

    // 1. VALIDATE
    $request->validate([
        'ho_ten' => 'required',
        'email' => 'required|email',
        'sdt' => 'required',
        'cccd' => 'required',
    ], [
        'ho_ten.required' => 'Vui lòng nhập họ tên khách hàng.',
        'email.required' => 'Vui lòng nhập email.',
        'email.email' => 'Email không đúng định dạng.',
        'sdt.required' => 'Vui lòng nhập số điện thoại.',
        'cccd.required' => 'Vui lòng nhập số CCCD.',
    ]);

    // 2. Lấy danh sách phòng và các thông tin chung (ví dụ checkin, checkout)
    $rooms   = $request->input('rooms', []);
    $checkin = $request->input('checkin');
    $checkout = $request->input('checkout');
    $user = Auth::user(); 
    // 3. Tính tổng tiền (ví dụ cộng tất cả đơn giá của các phòng, cần đảm bảo giá được xử lý dạng số)
    //$tong_tien = 0;

//$tong_tien *= 1000; // Thêm 3 số 0 vào cuối


    // 4. Transaction: lưu tất cả thông tin vào DB
    DB::transaction(function () use ($request, $rooms, $paymentMethod, $checkin, $checkout) {
        // 4.1 Lưu khách hàng
        
        // 4.1 Kiểm tra user đã đăng nhập và tìm xem đã có thông tin khách hàng chưa

$id_khach_hang = null;
$user = Auth::user(); 
if ($user) {
    $existingCustomer = DB::table('khach_hang')->where('FK_ID_user', $user->id)->first();

    if ($existingCustomer) {
        // Đã tồn tại thông tin khách hàng, lấy ID
        $id_khach_hang = $existingCustomer->ID_KH; // hoặc ID_KH tuỳ tên cột trong bảng của bạn
    } else {
        // Chưa có, tiến hành thêm mới
        $id_khach_hang = DB::table('khach_hang')->insertGetId([
            'ho_ten'     => $request->ho_ten,
            'email'      => $request->email,
            'sdt'        => $request->sdt,
            'cccd'       => $request->cccd,
            'FK_ID_user' => $user->id,
        ]);
    }
} else {
    // Người dùng chưa đăng nhập, tạo khách hàng không gắn với user
    $id_khach_hang = DB::table('khach_hang')->insertGetId([
        'ho_ten' => $request->ho_ten,
        'email'  => $request->email,
        'sdt'    => $request->sdt,
        'cccd'   => $request->cccd,
        // Không có FK_ID_user
    ]);
}


        // 4.2 Lưu đặt phòng (booking)
        $id_dat_phong = DB::table('dat_phong')->insertGetId([
            'ghi_chu'                => $request->ghi_chu,
            'FK_ma_KH'               => $id_khach_hang,
            'ngay_dat'               => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        // 4.3 Lưu chi tiết đặt phòng và cập nhật trạng thái phòng
        foreach ($rooms as $room) {
            // Cập nhật trạng thái phòng thành "Đặt trước"
            DB::table('phong')
                ->where('so_phong', $room['room_number'])
                ->update(['trang_thai' => 'Đặt trước']);

            // Xử lý giá phòng (loại bỏ định dạng định dạng tiền)
           // $priceClean = str_replace([' VNĐ', 'đ', ','], '', $room['price']);
           // $gia_so = floatval($priceClean);

       
            $gia_so = (int) preg_replace('/[^\d]/', '', $room['price']);
          
        
            // Lưu chi tiết đặt phòng
            DB::table('ct_dat_phong')->insert([
                'FK_ID_Booking' => $id_dat_phong, // Liên kết với booking vừa chèn
                'FK_so_phong'   => $room['room_number'],
                'checkindate'   => $checkin,
                'checkoutdate'  => $checkout,
                'don_gia'       => $gia_so,
            ]);
        }

        // 4.4 Lấy tổng tiền từ bảng ct_dat_phong đã tính sẵn
$tong_tien = DB::table('ct_dat_phong')
->where('FK_ID_Booking', $id_dat_phong)
->value('thanh_tien'); 
        // 4.4 Xác định ngày thanh toán dựa vào phương thức thanh toán
        // Nếu là quét mã QR: lấy thời gian hiện tại, nếu là thanh toán khi nhận phòng: để 0000-00-00
        $ngay_thanh_toan = ($paymentMethod === 'Quét mã QR') 
                            ? Carbon::now('Asia/Ho_Chi_Minh') 
                            : null;

        // 4.5 Lưu thông tin hóa đơn
        DB::table('hoa_don')->insert([
            'tong_tien'       => $tong_tien,
            'phuong_thuc'     => $paymentMethod,
            'FK_ID_Booking'   => $id_dat_phong, // Liên kết với booking đã lưu ở trên
            'ngay_thanh_toan' => $ngay_thanh_toan,
        ]);

        session([
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'checkin'       => $checkin,
            'checkout'      => $checkout,
            'booking_time'  => now()->format('d/m/Y H:i:s'),
            'rooms'         => $rooms,
            'totalAmount'   => $tong_tien,
            'id_booking'    => $id_dat_phong,
        ]);
    });

    

   
    return redirect()->route('thanhcong')->with('success', 'Đã lưu thông tin khách hàng, đặt phòng và hóa đơn thành công!');
}

public function success()
{
    $bookingData = session()->all();
    return view('Customer_Layouts.thanhcong',  compact('bookingData'));
}

public function printReceipt()
{
    $bookingData = session()->all();
    if (!isset($bookingData['id_booking'])) {
        return redirect()->route('home')->with('error', 'Không tìm thấy thông tin đặt phòng trong session.');
    }
    return view('Customer_Layouts.print', compact('bookingData'));
} 



}



