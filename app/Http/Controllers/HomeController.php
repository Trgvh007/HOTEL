<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    function trangchu()
    {
    return view("home");
    }
    public function index()
    {
        try {
            // First, let's check if we can connect to the database
            DB::connection()->getPdo();
            Log::info('Database connection successful');

            // Check if the table exists
            $tableExists = DB::select("SHOW TABLES LIKE 'uu_dai'");
            Log::info('Table check:', ['exists' => !empty($tableExists)]);

            if (!empty($tableExists)) {
                // Get table structure
                $columns = DB::select("SHOW COLUMNS FROM uu_dai");
                Log::info('Table structure:', ['columns' => $columns]);

                // Try to get data
                $uu_dai = DB::select("SELECT * FROM uu_dai");
                Log::info('Data count:', ['count' => count($uu_dai)]);
            } else {
                $uu_dai = [];
                Log::warning('uu_dai table does not exist');
            }

            return view('home', compact('uu_dai'));
        } catch (\Exception $e) {
            Log::error('Database error: ' . $e->getMessage());
            $uu_dai = [];
            return view('home', compact('uu_dai'));
        }
    }

    public function search(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'ngayden' => 'required|date|after_or_equal:today',
            'ngaydi' => 'required|date|after:ngayden',
            'sophong' => 'required|integer|min:1|max:10'
        ]);

        try {
            // Query available rooms from phong table with specific columns
            $availableRooms = DB::table('phong')
                ->select('so_phong', 'ten_phong', 'gia', 'hinh_anh')
                ->whereNotExists(function ($query) use ($validated) {
                    $query->select(DB::raw(1))
                        ->from('dat_phong')
                        ->whereRaw('dat_phong.so_phong = phong.so_phong')
                        ->where(function ($q) use ($validated) {
                            // Check for date overlap
                            $q->whereBetween('ngay_nhan', [$validated['ngayden'], $validated['ngaydi']])
                                ->orWhereBetween('ngay_tra', [$validated['ngayden'], $validated['ngaydi']])
                                ->orWhere(function ($inner) use ($validated) {
                                    $inner->where('ngay_nhan', '<=', $validated['ngayden'])
                                        ->where('ngay_tra', '>=', $validated['ngaydi']);
                                });
                        })
                        ->where('trang_thai', '!=', 'cancelled');
                })
                ->where('trang_thai', 'Trống')
                ->get();

            // Store search results and parameters in session
            session([
                'search_results' => $availableRooms,
                'search_params' => [
                    'ngay_den' => $validated['ngayden'],
                    'ngay_di' => $validated['ngaydi'],
                    'so_phong' => $validated['sophong']
                ]
            ]);

            // Redirect to rooms index with the results
            return redirect()->route('rooms.index');

        } catch (\Exception $e) {
            Log::error('Database error in search: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Không thể tìm kiếm phòng. Vui lòng thử lại.');
        }
    }

    public function booking()
    {
        if (!session('booking_params')) {
            return redirect()->route('home');
        }
        return view('booking');
    }
}
