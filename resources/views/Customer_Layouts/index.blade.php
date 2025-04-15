<x-Home_header>
    <x-slot name='title'>Room </x-slot>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<style>
    
    #overlay-room-detail {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.4); /* lớp nền mờ */
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    padding: 20px;
    box-sizing: border-box;
    padding-left: 80px;
    overflow: auto; /* Thêm để cuộn toàn bộ overlay nếu cần */
}

#room-detail-html {
    background: #FFFFF0;
    border-radius: 10px;
    padding: 20px;
    width: 90%;
    max-width: 1200px;
    max-height: 90vh;
    overflow-y: auto; /* Bật cuộn dọc */
    overflow-x: hidden; /* Ẩn cuộn ngang nếu không cần */
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    position: relative;
    transform: translateX(8%);
    align-items: stretch;
}

.image-container {
    flex: 6; /* 50% */
    padding: 10px;
    max-height: 100%;
    overflow: hidden;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
    display: block;
}

.info-container {
    flex: 4; /* 50% */
    padding: 20px;
    overflow: hidden;
}

#overlay-room-detail .back-button {
    position: absolute;
    top: 30px;
    right: 30px;
    font-size: 22px;
    color: black;
    border: none;
    cursor: pointer;
    padding: 10px;
    border-radius: 50%;
    z-index: 10000;
    transition: transform 0.2s ease;
}

#overlay-room-detail .back-button:hover {
    background-color: #ffe26f;
    transform: scale(1.1);
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
    content: "✓";
    position: absolute;
    left: 0;
    color: #28a745;
}


   .search-container {
    display: flex;
    align-items: center;
    justify-content: space-between; /* Canh đều các input */
    margin: 20px auto; /* Canh giữa */
    width: 80%; /* Giới hạn chiều rộng */
    max-width: 1200px; /* Định chiều rộng tối đa */
    }

    .container {
        display: flex;
        align-items: flex-start; /* Căn theo đỉnh trên */
        justify-content: space-between; /* Đảm bảo căn thẳng hàng */
        max-width: 1200px;
        margin: 0 auto; /* Canh giữa */
    }

    .room-selection {
        flex: 7;
        padding: 20px;
        margin-right: 10px; /* Giữ khoảng cách với booking-info */
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 10px; /* Bo góc */
    }

    .room-card {
        border: none; /* Xóa viền giữa các thẻ phòng */
        margin-bottom: 10px; /* Khoảng cách giữa các thẻ phòng */
    }

    .booking-info {
        flex: 3;
        padding: 10px;
        border: 1px solid #ccc; /* Giữ viền cho thông tin đặt phòng */
        border-radius: 8px;
        background-color: #f9f9f9;
        max-width: 40%; /* Điều chỉnh cho hợp với flex */
    }
    table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ccc;
}
    </style>
<div class="search-container" style="max-width: 1200px; margin: 20px auto; padding: 20px; border: 1px solid #e0e0e0; border-radius: 8px; background-color: #fff; display: flex; justify-content: space-between; align-items: center;">
    <form method="POST" onsubmit="return ktngay()" style="width: 100%; display: flex; align-items: center;">
        @csrf
        <div style="flex: 1; margin-right: 15px;">
            <label style="display: block; margin-bottom: 5px;">Ngày đến</label>
            <input type="date" id="checkin" name="checkin" value="{{ $checkin ?? '' }}"
            style="width: 70%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="flex: 1; margin-right: 15px;">
            <label style="display: block; margin-bottom: 5px;">Ngày đi</label>
            <input type="date" id="checkout" name="checkout" value="{{ $checkout ?? '' }}" style="width: 70%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="flex: 1; margin-right: 15px;">
            <label style="display: block; margin-bottom: 5px;">Số phòng</label>
            <input type="number" id="rooms" name="rooms" value="{{ $roomCount ?? '' }}"
 style="width: 70%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="margin-top: 25px;">
            <button type="submit" style="background-color: #f1c40f; color: #fff; padding: 10px 30px; border: none; border-radius: 4px; cursor: pointer;">Tìm Kiếm</button>
        </div>
    </form>
</div>

@if(isset($rooms) && count($rooms) > 0)
<div class="container">
        <div class="room-selection" >
            @foreach($rooms as $room)
            <div class='room-card' style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; display: flex; position: relative;'>
                <img src='./Cusimage/{{ $room->hinh_anh }}' alt='{{ $room->ten_loai }}' class='room-image' style='width: 50%; height: auto; object-fit: cover; margin-right: 10px;'>
                <div class='room-info' style='flex: 1;'>
                    <h3>{{ $room->ten_loai }}</h3>
                    <p>👀 Số phòng: {{ $room->so_phong }}</p>
                    <p>🏠 Diện tích: {{ $room->dien_tich }} m²</p>
                    <p>🌇 View: {{ $room->view }}</p>
                    <p>🛏️ Giường: {{ $room->loai_giuong }}</p>
                    <a href="{{ route('rooms.show', ['room_id' => $room->so_phong]) }}" class="detail-room-link">Xem chi tiết phòng</a>
                    <div>
                        <p>✅ Hủy MIỄN PHÍ trước ngày 10 kể từ ngày đặt phòng</p>
                        <p>✅ Miễn phí các tiện ích: Hồ bơi, Phòng gym và spa,... trong suốt thời gian lưu trú</p>
                    </div>
                    <p>Giá: {{ number_format($room->don_gia, 0, ',', '.') }} VND/đêm</p>
                </div>
                <button class='select-room-btn' style='position: absolute; bottom: 10px; right: 10px; background-color: #f1c40f; color: white; border: none; padding: 10px 15px; cursor: pointer; border-radius: 5px;' 
                    data-name='{{ $room->ten_loai }}' 
                    data-price='{{ $room->don_gia }}'
                    data-room-number='{{ $room->so_phong }}'>Chọn phòng</button>
            </div>
            @endforeach
        </div>
@else
    <p>Hiện tại không có phòng trống.</p>
@endif

<!-- Khu vực hiển thị thông tin đặt phòng -->
<div class="booking-info" >
        <h3>Thông tin đặt phòng</h3>
        <p id="hotel-name">VNL Luxury Riverfront</p>
        <p><strong>Thời gian phòng:</strong> <span id="booking-time">Chưa xác định</span></p>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
            <thead>
                <tr>
                    <th>Phòng</th>
                    <th>Loại phòng</th>
                    <th>Số phòng</th>
                    <th>Giá</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="booking-rooms">
            </tbody>
        </table>
        <p><strong>Tổng cộng:</strong> <span id="final-total">--</span> VND</p>
        <button id="book-now-btn" class="book-now-btn" 
        style="padding: 10px 20px; background-color: #f1c40f; color: white; border: none; border-radius: 4px; cursor: pointer;">
        Đặt ngay</button>
    </div>
</div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Nếu input chưa có value (tức chưa có từ Request), mới lấy từ localStorage
        if (!document.getElementById("checkin").value && localStorage.getItem("checkin")) {
            document.getElementById("checkin").value = localStorage.getItem("checkin");
        }
        if (!document.getElementById("checkout").value && localStorage.getItem("checkout")) {
            document.getElementById("checkout").value = localStorage.getItem("checkout");
        }
        if (!document.getElementById("rooms").value && localStorage.getItem("rooms")) {
            document.getElementById("rooms").value = localStorage.getItem("rooms");
        }
    });
</script>

<script>
    
function ktngay() {
    const checkinDate = new Date(document.getElementById('checkin').value);
    const checkoutDate = new Date(document.getElementById('checkout').value);
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Đặt giờ, phút, giây, mili giây về 0 để so sánh chỉ với ngày

    const numberOfRooms = parseInt(document.getElementById('rooms').value, 10);

    if (checkinDate < today) {
        alert("Ngày đến không hợp lệ");
        return false; 
    }

    if (checkoutDate <= checkinDate) {
        alert("Ngày đi phải lớn hơn ngày đến.");
        return false; 
    }

    if (numberOfRooms < 1) {
        alert("Số phòng phải lớn hơn hoặc bằng 1.");
        return false; 
    }

   

    return true;
}


    document.addEventListener("DOMContentLoaded", function () {
    const bookingRooms = document.getElementById("booking-rooms");
    const bookingTime = document.getElementById("booking-time");
    const finalTotal = document.getElementById("final-total");

    let selectedRooms = [];

    document.querySelectorAll(".select-room-btn").forEach(button => {
        button.addEventListener("click", function () {
            const roomNumber = this.dataset.roomNumber;

            // Kiểm tra xem phòng đã được chọn chưa
            if (selectedRooms.some(room => room.roomNumber === roomNumber)) {
                alert(`Phòng ${roomNumber} đã được chọn trước đó.`);
                return;
            }

            const room = {
                id: roomNumber,
                name: this.dataset.name,
                roomNumber: roomNumber,
                price: parseFloat(this.dataset.price)
            };

            selectedRooms.push(room);
            updateBookingInfo();
        });
    });

    function updateBookingInfo() {
        bookingRooms.innerHTML = "";
        let totalNights = calculateNights();
        let checkin = document.getElementById("checkin").value;
        let checkout = document.getElementById("checkout").value;

        bookingTime.textContent = checkin && checkout
            ? `${formatDate(checkin)} - ${formatDate(checkout)} (${totalNights} đêm)`
            : "Chưa xác định";

        let totalCost = 0;

        selectedRooms.forEach((room, index) => {
            let row = document.createElement("tr");
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${room.name}</td>
                <td>${room.roomNumber}</td>
                <td>${room.price.toLocaleString()} VNĐ</td>
                <td>
                    <button class="cancel-room-btn" data-id="${room.id}" style="color: red; cursor: pointer; border: none; background: none;">Hủy</button>
                </td>
            `;
            bookingRooms.appendChild(row);

            totalCost += room.price * totalNights;
        });

        finalTotal.textContent = totalCost.toLocaleString() ;

        // Thêm sự kiện xóa phòng
        document.querySelectorAll(".cancel-room-btn").forEach(button => {
            button.addEventListener("click", function () {
                selectedRooms = selectedRooms.filter(room => room.id !== this.dataset.id);
                updateBookingInfo();
            });
        });
    }

    function calculateNights() {
        const checkin = new Date(document.getElementById("checkin").value);
        const checkout = new Date(document.getElementById("checkout").value);
        return (checkout - checkin) / (1000 * 60 * 60 * 24) || 0;
    }

    function formatDate(dateString) {
        let date = new Date(dateString);
        return date.toLocaleDateString("vi-VN");
    }
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("book-now-btn").addEventListener("click", function () {
        const numberOfRooms = parseInt(document.getElementById('rooms').value, 10);
        const bookingRoomsCount = document.querySelectorAll("#booking-rooms tr").length;

        if (numberOfRooms !== bookingRoomsCount) {
            alert("Vui lòng chọn đúng số lượng phòng");
            return;
        }

        let form = document.createElement("form");
        form.method = "POST";
        form.action = "{{ route('them') }}";

        let csrf = document.createElement("input");
        csrf.type = "hidden";
        csrf.name = "_token";
        csrf.value = "{{ csrf_token() }}";
        form.appendChild(csrf);

        // Các thông tin chung
        const dataFields = {
            checkin: document.getElementById("checkin").value,
            checkout: document.getElementById("checkout").value,
            booking_time: document.getElementById("booking-time").innerText,
            total_price: document.getElementById("final-total").innerText,
        };

        for (let key in dataFields) {
            let input = document.createElement("input");
            input.type = "hidden";
            input.name = key;
            input.value = dataFields[key];
            form.appendChild(input);
        }

        // Danh sách phòng
        document.querySelectorAll("#booking-rooms tr").forEach((row, index) => {
            let columns = row.getElementsByTagName("td");
            if (columns.length > 0) {
                ['room_name', 'room_number', 'price'].forEach((field, colIndex) => {
                    let input = document.createElement("input");
                    input.type = "hidden";
                    input.name = `rooms[${index}][${field}]`;
                    input.value = columns[colIndex + 1].innerText;
                    form.appendChild(input);
                });
            }
        });

        document.body.appendChild(form);
        form.submit();
    });
});
</script>

<div id="overlay-room-detail">
    <div id="room-detail-html">
        <button class="back-button">✖</button>
    </div>
</div>

<!-- Script xử lý AJAX & overlay -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.detail-room-link').on('click', function(e) {
            e.preventDefault();
            const url = $(this).attr('href');

            $.get(url, function(data) {
                $('#room-detail-html').append(data); 
                $('#overlay-room-detail').fadeIn();
            });
        });

        // Đóng overlay khi nhấn X
        $(document).on('click', '.back-button', function() {
            $('#overlay-room-detail').fadeOut(function() {
                $('#room-detail-html').html('<button class="back-button">✖</button>'); // reset nội dung + giữ lại nút
            });
        });

        // Đóng overlay khi nhấn ra ngoài (tuỳ chọn)
        $('#overlay-room-detail').on('click', function(e) {
            if (e.target.id === 'overlay-room-detail') {
                $('#overlay-room-detail').fadeOut(function() {
                    $('#room-detail-html').html('<button class="back-button">✖</button>');
                });
            }
        });
    });
</script>
</x-Home_header>
