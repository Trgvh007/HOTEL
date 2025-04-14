<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;


class RoomController extends Controller
{
    //
    public function index()
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
}