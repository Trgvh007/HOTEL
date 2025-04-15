<x-Home_header>
    <x-slot name='title'>Room </x-slot>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

   /* Căn giữa và tăng kích thước tiêu đề */
h4 {
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 30px;
}

/* Container hiển thị theo tỷ lệ 6:4 */
.container {
    display: flex;
    gap: 30px;
    justify-content: space-between;
}

/* Phần form thông tin khách hàng (chiếm 60%) */
.form-section {
    flex: 0 0 60%;
    background-color: #f9f9f9;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

/* Phần thông tin đặt phòng (chiếm 40%) */
.info-section {
    flex: 0 0 40%;
    border: 2px dashed #ccc;
    padding: 20px;
    border-radius: 12px;
    background-color: #fff;
    align-self: flex-start;
}



    .info-section h2 {
        margin-bottom: 20px;
        color: #f1c40f;
        text-align: center;
    }

    .info-section h2, .info-section h3 {
        margin-top: 0;
        color: #f1c40f;
        text-align: center;
    }

    .info-section table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .info-section table th,
    .info-section table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    .info-section table th {
        background-color: #f0f0f0;
    }

    .alert-error {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 20px;
    }

    

    .btn-primary {
    background-color: #f1c40f !important;
    border-color: #FFFF00 !important;
    color: #000 !important; /* Màu chữ nên là đen để nổi bật trên nền vàng */
}

.btn-primary:hover {
    background-color: #d4ac0d !important; /* Màu đậm hơn khi hover */
    border-color: #d4ac0d !important;
}


</style>

<h4>Xác nhận đặt phòng</h4>

@if ($errors->any())
    <div class="alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <!-- Form nhập thông tin khách hàng -->
    <div class="form-section">
        <h2>Thông tin khách hàng</h2>
        <form action="{{ route('luu') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Họ và tên:</label>
                <input type="text" name="ho_ten" value="{{ old('ho_ten', optional($user)->name) }}" class="form-control" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Số điện thoại:</label>
                <input type="text" name="sdt" class="form-control">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Căn cước công dân:</label>
                <input type="text" name="cccd" class="form-control">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Email:</label>
                <input type="text" name="email" value="{{ old('email', optional($user)->email) }}" class="form-control">
            </div>

            <div style="margin-bottom: 15px;">
                <label>Yêu cầu thêm:</label>
                <textarea name="note" class="form-control" rows="3"></textarea>
            </div>

            <!-- PHƯƠNG THỨC THANH TOÁN -->
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Phương thức thanh toán:</label>

                <label><input type="radio" name="payment_method" value="Thanh toán khi nhận phòng" checked onchange="toggleQRCode()"> Thanh toán khi nhận phòng</label><br>

                <label><input type="radio" name="payment_method" value="Quét mã QR" onchange="toggleQRCode()"> Quét mã QR</label>

                <div id="qr-container" style="margin-top: 20px; display: none; text-align: center;">
                    <p>Vui lòng quét mã QR để thanh toán:</p>
                    <img src="{{ asset('Cusimage/qrcode.png') }}" alt="QR Code" style="width: 200px; height: 200px; border: 2px solid #ccc; border-radius: 8px;">
                    <div style="margin-top: 10px; font-size: 16px; font-weight: bold; color: #1a73e8; background-color: #f1f3f4;  padding: 6px 12px; border-radius: 6px;">
                Tổng tiền: {{ $totalPrice }} VNĐ
                    </div>
</div>

            </div>

            <!-- Dữ liệu ẩn -->
            <input type="hidden" name="checkin" value="{{ $checkin }}">
            <input type="hidden" name="checkout" value="{{ $checkout }}">
            <input type="hidden" name="booking_time" value="{{ $bookingTime }}">
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">

            @foreach ($rooms as $index => $room)
                <input type="hidden" name="rooms[{{ $index }}][room_name]" value="{{ $room['room_name'] }}">
                <input type="hidden" name="rooms[{{ $index }}][room_number]" value="{{ $room['room_number'] }}">
                <input type="hidden" name="rooms[{{ $index }}][price]" value="{{ $room['price'] }}">
            @endforeach

            <div style="text-align: center;">
                <button type="submit" class="btn btn-primary">💾 Hoàn tất đặt phòng</button>
            </div>
        </form>
    </div>

    <!-- Thông tin đặt phòng -->
    <div class="info-section">
        <h1>Thông tin đặt phòng</h1>
        <h2>VNL Luxury Riverfront</h2>
        <p><strong>Ngày nhận phòng:</strong> {{ $checkin }}</p>
        <p><strong>Ngày trả phòng:</strong> {{ $checkout }}</p>
        <p><strong>Thời gian đặt:</strong> {{ $bookingTime }}</p>
        

        <h3>Danh sách phòng đã chọn:</h3>
        <table>
            <tr>
                <th>STT</th>
                <th>Tên phòng</th>
                <th>Mã phòng</th>
                <th>Giá</th>
            </tr>
            @foreach ($rooms as $index => $room)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $room['room_name'] }}</td>
                    <td>{{ $room['room_number'] }}</td>
                    <td>{{ $room['price'] }}</td>
                </tr>
            @endforeach
        </table>
        <p style="text-align: right; margin: 0; font-size: 18px; font-weight: bold; position: relative; top:10px; font-family: 'Tahoma', sans-serif;">
    <strong>Tổng giá:</strong> {{ $totalPrice }} VNĐ </p>


    </div>
</div>
<h3 class="policy-title">Chính sách đặt phòng</h3>
<div class="booking-policy">
    <div class="policy-block">
        <p class="policy-detail"><i class="fas fa-ban"></i> Hủy: Nếu hủy, thay đổi hoặc không đến, khách sẽ trả toàn bộ giá trị tiền đặt phòng.</p>
        <p class="policy-detail"><i class="fas fa-money-bill-wave"></i> Thanh toán: Thanh toán toàn bộ giá trị tiền đặt phòng.</p>
        <p class="policy-detail"><i class="fas fa-utensils"></i> Đã bao gồm ăn sáng</p>
        <p class="policy-detail"><i class="fas fa-clock"></i> Giờ nhận phòng: 14:00 | Giờ trả phòng: 12:00 hôm sau.</p>
        <p class="policy-detail"><i class="fas fa-child"></i> Trẻ em dưới 6 tuổi được miễn phí ngủ chung giường với bố mẹ.</p>
        <p class="policy-detail"><i class="fas fa-dog"></i> Không được mang thú cưng vào khách sạn.</p>
        <p class="policy-detail"><i class="fas fa-id-card"></i> Yêu cầu xuất trình CCCD/hộ chiếu khi nhận phòng.</p>
        <p class="policy-detail"><i class="fas fa-exclamation-circle"></i> Khách đến muộn sau 18:00 vui lòng liên hệ trước để giữ phòng.</p>
    </div>
</div>
<style>
.policy-title {
    font-size: 24px;
    font-weight: bold;
    color: #2c3e50;
    display: flex;
    align-items: center;
    margin-top: 50px;
    margin-bottom: 20px;
    gap: 10px;
    padding-left: 270px;
}

.policy-title::before {
    content: "📖";
    font-size: 28px;
}

.booking-policy {
    max-width: 900px;
    margin: 0 auto 60px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border-left: 5px solid #f1c40f;
    
}


.policy-block {
    padding: 10px 20px;
    padding-left: -50px;
}

.policy-detail {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin-bottom: 10px;
    color: #444;
    font-size: 15px;
    line-height: 1.5;
}

.policy-detail i {
    color: #f1c40f;
    margin-top: 3px;
    min-width: 18px;
}

</style>


<script>
    function toggleQRCode() {
        const qrContainer = document.getElementById("qr-container");
        const qrOption = document.querySelector('input[name="payment_method"][value="Quét mã QR"]');

        qrContainer.style.display = qrOption.checked ? "block" : "none";
    }
</script>

</x-Home_header>
