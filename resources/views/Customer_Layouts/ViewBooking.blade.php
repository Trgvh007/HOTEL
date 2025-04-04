
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>In phiếu đặt phòng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .receipt-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
        }

        .customer-info {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            background-color: #f1f1f1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f1f1f1;
            color: #333;
        }

        tfoot tr {
            font-weight: bold;
            background-color: #e9e9e9;
        }

        .total-row {
            font-weight: bold;
        }

        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #f1c40f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

        .print-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <h1>Thông tin Đặt Phòng</h1>
    
    <div class="customer-info">
        <p><strong>Mã đặt phòng:</strong> {{ $id }}</p>
        <p><strong>Họ và tên:</strong> {{ $ho_ten }}</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Thời gian phòng:</strong> {{ $checkin }} đến {{ $checkout }}</p>
        <p><strong>Thời gian đặt phòng:</strong> {{ $booking_time }}</p>
    </div>

    <table>
    <thead>
    <tr>
        <th>Số phòng</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Số đêm</th>
        <th>Đơn giá (VND)</th>
        <th>Thành tiền (VND)</th>
    </tr>
</thead>
<tbody>
    @foreach ($rooms as $room)
        <tr>
            <td>{{ $room->roomNumber }}</td>
            <td>{{ $room->checkindate }}</td>
            <td>{{ $room->checkoutdate }}</td>
            <td>{{ $room->so_dem }}</td>
            <td>{{ number_format($room->don_gia, 0, ',', '.') }}</td>
            <td>{{ number_format($room->thanh_tien, 0, ',', '.') }}</td>
        </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <td colspan="5">Tổng cộng:</td>
        <td>{{ number_format($totalAmount, 0, ',', '.') }} VND</td>
    </tr>
</tfoot>
    </table>

    <a href="javascript:window.print()" class="print-button">In phiếu đặt phòng</a>
</div>

</body>
</html>
