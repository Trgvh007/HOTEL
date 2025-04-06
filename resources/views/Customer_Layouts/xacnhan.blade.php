@extends('layouts.main')
@section("title","Xác nhận")
@section('content')
<h4>Xác nhận đặt phòng</h4>
<div class="container">
    <!-- Form thông tin khách hàng -->
    <div class="box">
        <h2>Thông tin khách hàng</h2>
        <form action="{{ route('booking.confirm') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Họ và tên</label>
                <input type="text" id="name" name="name" placeholder="Nhập họ và tên" value="{{ old('name', $name ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" value="{{ old('phone', $phone ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="cccd">Căn cước công dân</label>
                <input type="text" id="cccd" name="cccd" placeholder="Nhập số căn cước công dân" value="{{ old('cccd', $cccd ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email" value="{{ old('email', $email ?? '') }}" required>
            </div>
            <div class="form-group">
                <label for="note">Yêu cầu thêm</label>
                <textarea id="note" name="note" placeholder="Nhập yêu cầu thêm (không bắt buộc)">{{ old('note') }}</textarea>
            </div>
   
            <!-- Phương thức thanh toán -->
            <p style="font-weight: bold;">Phương thức thanh toán</p>
            <div style="margin: 15px 0; display: flex; flex-direction: column; gap: 10px; width: 550px; white-space: nowrap;">
                <label style="display: flex; align-items: center; gap: 10px; border: 2px solid #ccc; border-radius: 8px; padding: 10px; width: 100%; justify-content: flex-start; position: relative;">
                    <input type="radio" name="payment_method" value="Thanh toán khi nhận phòng" required style="margin: 0; flex-grow: 0; position: relative; left: -90px;">
                    <span style="min-width: 300px; position: relative; left: -90px;">Thanh toán khi nhận phòng</span>
                </label>
                <label style="display: flex; align-items: center; gap: 10px; border: 2px solid #ccc; border-radius: 8px; padding: 10px; width: 100%; justify-content: flex-start; position: relative; text-align: left;">
                    <input type="radio" name="payment_method" value="Quét mã QR" style="margin: 0; flex-grow: 0; position: relative; left: -90px;">
                    <span style="min-width: 300px; position: relative; left: -90px;">Quét mã QR</span>
                </label>
            </div>
            <!-- Danh sách phòng -->
    <input type="hidden" name="rooms" value="{{ json_encode($bookingData['rooms']) }}">
            <div style="text-align: center; margin-top: 15px;">
        <button type="submit">Hoàn tất</button>
            </div>
        </form>
    </div>
    <div id="booking-message" style="margin-top: 20px;"></div>
    <!-- Thông tin đặt phòng -->
    <div class="booking-container">
        <h2>Thông tin đặt phòng</h2>
        <p><strong>Khách sạn:</strong> VNL Luxury Riverfront</p>
        <p><strong>Thời gian phòng:</strong> {{ $bookingData['booking_time'] }}</p>
        <table>
            <thead>
                <tr>
                    <th>Phòng</th>
                    <th>Loại phòng</th>
                    <th>Số phòng</th>
                    <th>Đơn giá (VND)</th>
                </tr>
            </thead>
            <tbody>
            @foreach($bookingData['rooms'] as $room)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $room['room_name'] }}</td>
                    <td>{{ $room['room_number'] }}</td>
                    <td>{{ $room['price'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p class="total-row"><strong>Tổng cộng:</strong> {{ $bookingData['total_price'] }} VND</p>
    </div>
</div>


<div style="margin: 1em auto 1em 13em; padding: 1em; background-color: #ffffff; border: 1px solid #e0e0e0; border-radius: 10px; max-width: 90%; width: 680px;">
    <h3 style="margin: 0;">Chính sách đặt phòng</h3>
    <div>
        @foreach($bookingData['rooms'] as $room)
        <div style="margin: 1em 0; border-bottom: 1px solid #e0e0e0; padding-bottom: 0.5em;">
            <p style="font-weight: bold;">🔭 Phòng {{ $room['room_name'] }}</p>
            <p style="margin-left: 1em;">Hủy: Nếu hủy, thay đổi hoặc không đến, khách sẽ trả toàn bộ giá trị tiền đặt phòng.</p>
            <p style="margin-left: 1em;">Thanh toán: Thanh toán toàn bộ giá trị tiền đặt phòng.</p>
            <p style="margin-left: 1em;">Đã bao gồm ăn sáng</p>
        </div>
        @endforeach
    </div>
</div>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
            text-size-adjust: 100%;
        }
 

        .title {
            width: auto;
            padding: 5px;
            background: #f8f7f7;
            text-align: center;
            color: rgb(6, 0, 94);
            font-size: 1rem;
        }
        .bttn {
            position: absolute;
            top: 5%;
            display: flex;
            width: 95%;
            justify-content: space-between;
        }


        .button-right {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 70%;
            height: 100%;
            gap: 10px;
        }


        .button-left {
            white-space: nowrap;
            display: flex;
            gap: 6px;
            margin-left: 9%;
            width: 10%;
            height: 10%;
        }
        button {
            width: 200px;
            padding: 10px;
            background-color: #180e3b;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }


        .social-icons {
            display: flex;
            gap: 15px;
            width: 50%;
            height: 100%;
        }


        .social-icons img {
            width: 30px;
            height: 30px;
            transition: transform 0.3s ease;
        }


        .social-icons img:hover {
            transform: scale(1.2);
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
        }
        .box {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
           
        }
        .booking-container {
            flex: none;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #f1c40f;
            margin-bottom: 20px;
        }


        h3 {
            color: #555;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
        }
        .total-row {
            font-weight: bold;
            text-align: right;
           
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, textarea {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
        }
        button {
            padding: 10px 20px;
            background-color: #f1c40f;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        h4 {
        text-align: center;
        font-size: 30px;
        font-weight: bold;
        }
    </style>
@endsection



