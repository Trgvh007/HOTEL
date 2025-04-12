<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('AdminLayouts.Quanly'); // Đường dẫn đến view Quản lý/Nhân viên
    }
}
