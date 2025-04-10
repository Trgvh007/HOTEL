@extends('Customer_Layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Left Column - Customer Information -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-4">Thông tin khách hàng</h3>
                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="citizen_id">Căn cước công dân</label>
                            <input type="text" class="form-control" id="citizen_id" name="citizen_id" placeholder="Nhập số căn cước công dân" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="notes">Yêu cầu thêm</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Nhập yêu cầu thêm (không bắt buộc)"></textarea>
                        </div>

                        <!-- Payment Method -->
                        <div class="payment-method mt-4">
                            <h5 class="mb-3">Phương thức thanh toán</h5>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="pay_later" value="pay_later" checked>
                                <label class="form-check-label" for="pay_later">
                                    Thanh toán khi nhận phòng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="qr_code" value="qr_code">
                                <label class="form-check-label" for="qr_code">
                                    Quét mã QR
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-warning btn-lg w-100">Xác nhận đặt phòng</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column - Booking Details -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2 class="booking-title text-center mb-4">Thông tin đặt phòng</h2>
                    
                    <div class="booking-info mb-4">
                        <p class="mb-2"><strong>Khách sạn:</strong> VNL Luxury Riverfront</p>
                        <p class="mb-3"><strong>Thời gian phòng:</strong> {{ session('checkin') }} - {{ session('checkout') }}</p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-light">
                                <tr>
                                    <th>Phòng</th>
                                    <th>Loại phòng</th>
                                    <th>Số phòng</th>
                                    <th>Đơn giá (VND)</th>
                                    <th>Thành tiền (VND)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(session()->has('selected_rooms') && is_array(session('selected_rooms')))
                                    @foreach(session('selected_rooms') as $index => $room)
                                        <tr>
                                            <td>Phòng {{ $index + 1 }}</td>
                                            <td>{{ $room['name'] }}</td>
                                            <td>{{ $room['quantity'] }}</td>
                                            <td>{{ number_format($room['price'], 0, ',', '.') }}</td>
                                            <td>{{ number_format($room['price'] * $room['quantity'], 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="font-weight-bold">
                                        <td colspan="4" class="text-right">Tổng cộng</td>
                                        <td>{{ number_format(collect(session('selected_rooms'))->sum(function($room) { 
                                            return $room['price'] * $room['quantity'];
                                        }), 0, ',', '.') }} VND</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">Không có thông tin phòng được chọn</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Booking Policy Section -->
                    <div class="booking-policy mt-4">
                        <h3 class="mb-3">Chính sách đặt phòng</h3>
                        @if(session()->has('selected_rooms') && is_array(session('selected_rooms')))
                            @foreach(session('selected_rooms') as $room)
                                <div class="policy-item">
                                    <p class="room-type"><i class="fas fa-telescope"></i> Phòng {{ $room['name'] }}</p>
                                    <div class="policy-details">
                                        <p>Hủy: Nếu hủy, thay đổi hoặc không đến, khách sẽ trả toàn bộ giá trị tiền đặt phòng.</p>
                                        <p>Thanh toán: Thanh toán toàn bộ giá trị tiền đặt phòng.</p>
                                        <p>Đã bao gồm ăn sáng</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
    margin-bottom: 20px;
}

.card-body {
    padding: 25px;
}

h3 {
    color: #333;
    font-size: 24px;
    font-weight: 600;
}

.form-control {
    border: 1px solid #ced4da;
    padding: 10px 15px;
    height: auto;
}

.form-control::placeholder {
    color: #999;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 600;
}

.table td, .table th {
    padding: 12px;
    vertical-align: middle;
}

.btn-warning {
    background-color: #feba02;
    border: none;
    color: #333;
    font-weight: 500;
    padding: 12px 30px;
}

.btn-warning:hover {
    background-color: #fec334;
}

.payment-method {
    border: 1px solid #dee2e6;
    padding: 20px;
    border-radius: 5px;
    background-color: #f8f9fa;
}

.booking-title {
    font-size: 32px;
    font-weight: 600;
    color: #333;
    margin-bottom: 30px;
}

.booking-info {
    margin-top: 20px;
}

.booking-info p {
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
}

.booking-info strong {
    font-weight: 500;
}

.table {
    margin-top: 20px;
}

.table th {
    background-color: #f8f9fa;
    font-weight: 500;
    border: 1px solid #dee2e6;
}

.table td {
    border: 1px solid #dee2e6;
}

.booking-policy {
    background-color: #ffffff;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 20px;
    margin-top: 30px;
}

.booking-policy h3 {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
}

.policy-item {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e0e0e0;
}

.policy-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.room-type {
    font-weight: bold;
    color: #333;
    margin-bottom: 10px;
}

.room-type i {
    margin-right: 8px;
}

.policy-details {
    padding-left: 4px;
}

.policy-details p {
    margin-bottom: 8px;
    color: #555;
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
    
    .table-responsive {
        overflow-x: auto;
    }

    .booking-policy {
        margin: 20px 0;
        padding: 15px;
    }
}
</style>
@endsection 