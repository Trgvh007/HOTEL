<x-Home_header>
    <x-slot name='title'>Lịch sử đặt phòng </x-slot>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<h2>Lịch sử đặt phòng</h2>

@if (count($lichSu) === 0)
    <p>Bạn chưa có đặt phòng nào.</p>
@else
    @foreach ($lichSu as $item)
        <div class="booking-item" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 20px;">
            <p><strong>Mã đặt phòng:</strong> {{ $item['booking']->ID_Booking }}</p>
            <p><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($item['booking']->ngay_dat)->format('d/m/Y H:i') }}</p>

            <h4>Chi tiết phòng:</h4>
            <ul>
                @foreach ($item['phong'] as $phong)
                    <li>
                        {{ $phong->so_dem }} (Số: {{ $phong->so_phong }})  
                        | Nhận: {{ $phong->checkindate }}  
                        | Trả: {{ $phong->checkoutdate }}  
                        | Giá: {{ number_format($phong->don_gia) }} VNĐ
                    </li>
                @endforeach
            </ul>

            <p><strong>Tổng tiền:</strong> {{ number_format($item['hoadon']->tong_tien ?? 0) }} VNĐ</p>
            <p><strong>Phương thức thanh toán:</strong> {{ $item['hoadon']->phuong_thuc ?? 'N/A' }}</p>
        </div>
    @endforeach
@endif

</x-Home_header>