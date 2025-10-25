<x-Home_header>
    <x-slot name='title'>Room </x-slot>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

   /* Căn giữa và tăng kích thước tiêu đề */
h4 {
   
    margin-top: 40px; 
    margin-bottom: 0;
    font-weight: 400;
    font-size: 24px;
    text-align: center;
    color: #002864;
    text-transform: uppercase;
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
.required {
    color: red;
    margin-left: 3px;
    font-weight: bold;
}

.text-danger.small {
    color: #d9534f; /* đỏ nhẹ */
    font-size: 13px;
    margin-top: 4px;
    display: block;
}

#payment-provider-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex; /* Nếu bạn muốn các ô thanh toán nằm ngang */
}

.payment-option {
    display: inline-block;
    border: 2px solid transparent; /* 🚫 Không viền khi chưa chọn */
    border-radius: 8px;
    transition: all 0.2s ease;
    padding: 5px;
}

.payment-option:hover {
    border-color: #ccc; /* viền nhẹ khi rê chuột */
}

.payment-option.active {
    border-color: red; /* 🔴 chỉ viền đỏ khi click chọn */
    box-shadow: 0 0 6px rgba(255, 0, 0, 0.4);
}

/* 4. Style cho hình ảnh bên trong thẻ <a> */
.qr-bank-img {
    /* Đảm bảo kích thước ảnh cố định */
    width: 95px; /* Điều chỉnh theo kích thước bạn thấy trong DevTools: 95 x 58 */
    height: 58px; 
    display: block; /* Loại bỏ khoảng trắng dưới ảnh */
    object-fit: contain; /* Đảm bảo hình ảnh vừa vặn */
}



.payment-button {
  background-color: blue;
  border: none;
  color: white;
  padding:  10px 24px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  border-radius: 8px;
 
}
</style>

<h4>Xác nhận đặt phòng</h4>

<div class="container">
    <!-- Form nhập thông tin khách hàng -->
    <div class="form-section">
        <h3>Thông tin khách hàng</h3>
        <form action="{{ route('luu') }}" method="POST">
            @csrf

            <div style="margin-bottom: 15px;">
                <label>Họ và tên:<span class="required">*</span></label>
                <input type="text" name="ho_ten" value="{{ old('ho_ten', optional($user)->name) }}" class="form-control" required>
            @error('ho_ten')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Số điện thoại:<span class="required">*</span></label>
                <input type="text" name="sdt" class="form-control">
             @error('sdt')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Email:<span class="required">*</span></label>
                <input type="text" name="email" value="{{ old('email', optional($user)->email) }}" class="form-control">
            @error('email')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 15px;">
                <label>Yêu cầu thêm:</label>
                <textarea name="note" class="form-control" rows="3"></textarea>
            </div>

            <!-- PHƯƠNG THỨC THANH TOÁN -->
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Chọn hình thức thanh toán:</label>
<ul id="payment-provider-list" class="list-unstyled">
  <li class="a-li-bank">
    <a title="Vietcombank" href="javascript:void(0)" 
       class="li-bank payment-option" 
       data-provider-code="Vietcombank"
       onclick="selectPayment(this)">
      <img src="https://e-bills.vn/assets/img/QRPay.png" alt="QR Pay" height="74" width="160" class="qr-bank-img">
    </a>
  </li>
</ul>
              
    <p class="payment-info">
        Nhấn "Thanh toán" và sử dụng ứng dụng ngân hàng hoặc ví điện tử để quét mã, xác thực thanh toán
    </p>
    
    <button type ="button" class="payment-button" onclick="handlePayment()">
        THANH TOÁN
    </button>

            </div>


    <div id="qr-section" style="display:none;">
        <h4>Quét Mã QR Thanh toán</h4>
        <div id="payment-info"></div>
        <img id="qr-image" src="" alt="QR code thanh toán">
        <button type="submit" class="confirm-button" style="background-color:green;color:white;padding:10px 20px;border:none;border-radius:8px;">
            XÁC NHẬN ĐÃ THANH TOÁN
        </button>
    </div>

    
            <!-- Dữ liệu ẩn -->
            <input type="hidden" name="checkin" value="{{ $checkin }}">
            <input type="hidden" name="checkout" value="{{ $checkout }}">
            <input type="hidden" name="booking_time" value="{{ $bookingTime }}">
            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            <input type="hidden" name="payment_method" id="payment_method" value="Quét mã QR">

            @foreach ($rooms as $index => $room)
                <input type="hidden" name="rooms[{{ $index }}][room_name]" value="{{ $room['room_name'] }}">
                <input type="hidden" name="rooms[{{ $index }}][room_number]" value="{{ $room['room_number'] }}">
                <input type="hidden" name="rooms[{{ $index }}][price]" value="{{ $room['price'] }}">
            @endforeach

            
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
               
                <th>Giá</th>
            </tr>
            @foreach ($rooms as $index => $room)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $room['room_name'] }}</td>
                    
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
   


    function selectPayment(element) {
    document.querySelectorAll('.payment-option').forEach(el => {
        el.classList.remove('active');
    });
    element.classList.add('active');
}
    
let selectedProvider = null;

function selectPayment(element) {
    document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
    selectedProvider = element.dataset.providerCode;
      // Gán giá trị vào input hidden
    const method = element.getAttribute('data-provider-code');
    document.getElementById('payment_method').value = method;
}

function handlePayment() {
    if (!selectedProvider) {
        alert("Vui lòng chọn hình thức thanh toán!");
        return;
    }

    // Lấy dữ liệu từ input
    const totalPrice = document.querySelector('input[name="total_price"]').value;
    const bookingTime = document.querySelector('input[name="booking_time"]').value;
    const checkin = document.querySelector('input[name="checkin"]').value;
    const checkout = document.querySelector('input[name="checkout"]').value;

    const amount = parseFloat(totalPrice.replace(/[^\d]/g, '')) || 0;

    // Nội dung chuyển khoản
    const content = `Thanh toan dat phong ${bookingTime}`;

    // Thông tin tài khoản
    const accountNumber = "106876832327";
    const accountName = "SunSea Hotel";
    const bankCode = "970415"; // Vietcombank

    // Tạo link QR từ VietQR
    const qrUrl = `https://img.vietqr.io/image/${bankCode}-${accountNumber}-compact.png?amount=${amount}&addInfo=${encodeURIComponent(content)}&accountName=${encodeURIComponent(accountName)}`;

    
    document.getElementById("qr-image").src = qrUrl;
    document.getElementById("qr-section").style.display = "block";
// Hiển thị thông tin thanh toán
    document.getElementById("payment-info").innerHTML = `
        <p><strong>Ngân hàng:</strong> VietinBank</p>
        <p><strong>Chủ tài khoản:</strong> ${accountName}</p>
        <p><strong>Số tiền:</strong> ${amount.toLocaleString()} VND</p>
        <p><strong>Nội dung chuyển khoản:</strong> ${content}</p>
    `;
  

    // (Tuỳ bạn) Gửi form tự động sau khi hiển thị QR
    // document.getElementById('bookingForm').submit();
     // Ẩn nút THANH TOÁN, hiện nút XÁC NHẬN
    document.querySelector('.payment-button').style.display = 'none';
    document.getElementById('confirm-payment-btn').style.display = 'inline-block';
}

function confirmPayment() {
    alert("Cảm ơn bạn! Hệ thống đang xác nhận thanh toán...");
    document.getElementById('bookingForm').submit();
}


</script>

</x-Home_header>
