@php
    $ho_ten = session('ho_ten');
    $email = session('email');
    $checkin = session('checkin');
    $checkout = session('checkout');
    $booking_time = session('booking_time');
    $rooms = session('rooms');
    $totalAmount = session('totalAmount');
    $id = session('id_booking');
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoàn tất đặt phòng</title>
    <style>

    /* Lớp cho ảnh nền */
    .background-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/Cusimage/Payment.png');
        background-size: cover;
        background-position: center;
        z-index: 0;
    }

    /* Nội dung chính */
    .content {
        position: relative;
        z-index: 1;
        text-align: center;
        padding: 20px;
        background-color: transparent;
        margin-top: 0.00001px; /* Cách lề trên 200px */
    }

    /* Nút */
    .button-container {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 500px;
    margin-bottom: 80px;
}


    .button {
        padding: 20px 50px; 
        font-size: 1rem; 
        font-weight: bold;
        color: white;
        border: none;
        border-radius: 10px; 
        cursor: pointer;
        white-space: nowrap;
        text-decoration: none; 
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2); 
        transition: transform 0.2s, box-shadow 0.2s; 
    }

    .button:hover {
        transform: translateY(-2px); 
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3); 
    }

    .print-button {
        background: linear-gradient(135deg, #28a745, #45d96f); 
    }

    .print-button:hover {
        background: linear-gradient(135deg, #218838, #3ecb65); 
    }

    .home-button {
        background: linear-gradient(135deg, #007bff, #329cff); 
    }

    .home-button:hover {
        background: linear-gradient(135deg, #0056b3, #267ddf); 
    }

    </style>

</head>
<body>

    <!-- Nền ảnh -->
    <div class="background-image"></div>

    <!-- Nội dung chính -->
    <div class="content">
        <div class="button-container">
            <a href="{{route('home')}}" class="button home-button">Về Trang chủ</a>
            <a href="{{ route('booking.print') }}" class="button print-button">In phiếu đặt phòng</a>
        </div>
    </div>

</body>
</html>

