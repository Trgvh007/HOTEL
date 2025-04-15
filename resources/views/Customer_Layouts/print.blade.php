

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
    <h1>Thông tin đặt phòng</h1>
    
    <div class="customer-info">
    <p><strong>Mã đặt phòng:</strong> {{ session('id_booking', 'N/A') }}</p>
        <p><strong>Họ và tên:</strong> {{ session('ho_ten', 'Chưa có thông tin') }}</p>
        <p><strong>Email:</strong> {{ session('email', 'Chưa có email') }}</p>
        <p><strong>Thời gian phòng:</strong> {{ session('checkin', 'Chưa có thông tin') }} đến {{ session('checkout', 'Chưa có thông tin') }}</p>
        <p><strong>Thời gian đặt phòng:</strong> {{ session('booking_time', 'Chưa có thời gian') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Loại phòng</th>
                <th>Số phòng</th>
                <th>Đơn giá (VND)</th>
                <th>Thành tiền (VND)</th>
                
            </tr>
        </thead>
        <tbody>
        @foreach ($bookingData['rooms'] as $room)
                <tr>
                    <td>{{ $room['room_name'] }}</td>
                    <td>{{ $room['room_number'] }}</td>
                    <td>{{  number_format((int) preg_replace('/[^\d]/', '', $room['price']), 0, ',', '.') }}</td>
                    <td>{{ number_format($bookingData['totalAmount'], 0, ',', '.') }}</td>
                    
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Tổng cộng:</td>
                <td>{{ number_format($bookingData['totalAmount'], 0, ',', '.') }} VND</td>
            </tr>
        </tfoot>
    </table>

    <a href="javascript:window.print()" class="print-button">In phiếu đặt phòng</a>
</div>



 
