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
