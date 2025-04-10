<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UuDai extends Model
{
    protected $table = 'uu_dai';
    
    protected $fillable = [
        'tieu_de',
        'mo_ta',
        'gia',
        'hinh_anh',
        'trang_thai'
    ];

    protected $casts = [
        'gia' => 'decimal:2',
        'trang_thai' => 'boolean'
    ];
} 