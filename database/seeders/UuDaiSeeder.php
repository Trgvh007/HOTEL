<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UuDaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uu_dai')->insert([
            [
                'tieu_de' => '[WINTER PROMOTION HÀ TĨNH] - Nghỉ dưỡng 2N1Đ + 01 bữa ăn chính dành cho 02 người lớn và 02 trẻ em dưới 6 tuổi',
                'hinh_anh' => 'images/uudai1.png',
                'gia' => 1000000,
                'trang_thai' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tieu_de' => '[NIGHT DEAL - ƯU ĐÃI TỚI 75%] Đêm tuyệt vời, giá siêu hấp dẫn!',
                'hinh_anh' => 'images/uudai2.png',
                'gia' => 704000,
                'trang_thai' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tieu_de' => '[WINTER PROMOTION | NHA TRANG] Nghỉ dưỡng 2N1Đ + Bữa ăn chính set menu cho 2 khách',
                'hinh_anh' => 'images/uudai3.png',
                'gia' => 2375000,
                'trang_thai' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tieu_de' => '[VNL NGHỈ DƯỠNG SANG CHẢNH] Ngắm bình minh trên biển, đắm mình trong không gian sang trọng tại VNL.',
                'hinh_anh' => 'images/uudai4.png',
                'gia' => 1500000,
                'trang_thai' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
