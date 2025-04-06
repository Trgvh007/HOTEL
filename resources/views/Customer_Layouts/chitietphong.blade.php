<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết phòng - {{ $room->ten_loai }}</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Căn giữa theo chiều dọc */
        }

        .container {
            display: flex;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 1200px;
            width: 90%;
        }

        .image-container {
            flex: 1; /* Chiếm 50% chiều rộng */
        }

        .image-container img {
            width: 100%;
            height: 100%; /* Điều chỉnh chiều cao tự động */
        }

        .info-container {
            flex: 1; /* Chiếm 50% chiều rộng */
            padding: 20px;
        }

        .room-title {
            font-size: 2rem;
            margin: 0;
            font-weight: bold;
        }

        .room-description {
            margin: 10px 0;
            font-size: 1rem;
            color: #666;
        }

        .details, .amenities {
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .details h3, .amenities h3 {
            margin: 10px 0;
            font-weight: bold;
        }

        .details ul, .amenities ul {
            list-style-type: none;
            padding: 0;
        }

        .details ul li, .amenities ul li {
            margin: 5px 0;
            position: relative;
            padding-left: 20px;
        }

        .details ul li:before, .amenities ul li:before {
            content: "✓"; /* Dấu kiểm */
            position: absolute;
            left: 0;
            color: #28a745; /* Màu xanh lá cho dấu kiểm */
        }
        .back-button {
    position: fixed;
    top: 10px;
    right: 10px;
    
    color: black;
    padding: 8px 12px;
    border-radius: 50%; /* Làm tròn giống dấu X */
    text-decoration: none;
    font-weight: bold;
    font-size: 16px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.back-button:hover {
    background-color: #f1c40f; /* Màu đậm hơn khi hover */
    transform: scale(1.1); /* Hiệu ứng phóng to nhẹ khi hover */
}

    </style>
</head>
<body>
<a href="{{ url()->previous() }}" class="back-button">✖</a>

    <div class="container">
        <div class="image-container">
            <img src="{{ asset('Cusimage/' . $room->hinh_anh) }}" alt="{{ $room->ten_loai }}">
        </div>
        <div class="info-container">
            <h1 class="room-title">{{ $room->ten_loai }}</h1>
            <p class="room-description">{{ $room->mo_ta }}</p>
            <div class="details">
                <h3>Chi tiết phòng:</h3>
                <ul>
                    <li>Diện tích: {{ $room->dien_tich }} m²</li>
                    <li>View: {{ $room->view }}</li>
                    <li>Số người tối đa: {{ $room->so_nguoi }}</li>
                    <li>Giường: {{ $room->loai_giuong }}</li>
                </ul>
            </div>

            <div class="amenities">
                <h3>Luôn bao gồm các tiện nghi:</h3>
                <ul>
                    @foreach ($amenities as $amenity)
                        <li>{{ $amenity->ten_tien_nghi }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
