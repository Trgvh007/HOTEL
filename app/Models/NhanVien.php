<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;

 
    protected $table = 'nhan_vien';

    // Nếu table không có các cột timestamps (created_at, updated_at)
    public $timestamps = false;

    // Các cột có thể gán hàng loạt
    protected $fillable = [
        'Ma_NV',
        'Ho_en',
        'Gioi_tinh',
        'Chuc_vu',
        
        // thêm các cột khác nếu cần
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'FK_ID_user', 'id');
}

}
