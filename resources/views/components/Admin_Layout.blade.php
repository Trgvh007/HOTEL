<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="/css/dsach.css">
    <link rel="stylesheet" href="./css/qlystyle.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <h1>VNL HOTEL</h1>
        </div>
        
            <div class="user-info">
            <?php
       if (isset($_SESSION["Ho_ten"])) { 
    
        $avatar = ($_SESSION['gioi_tinh'] == 'Nam') ? './image/avanam.png' : './image/aviiia.png'; // Chọn avatar
     ?>
     <img src="<?php echo $avatar; ?>" alt="User Image"><br>
     <span> <?php  echo $_SESSION['Ho_ten'] . '</span>';
    }
 ?>
        </div>

        <ul class="menu">
            
            <li><a href="{{url('/quanly')}}">Sơ đồ khách sạn</a></li>
            <li class="active">
            <a href="#" onclick="toggleMenu('room-management-submenu')" >Quản lý phòng </span></a>
        <ul class="submenu" id="room-management-submenu" style="display: none;">
            <li><a href="#">Danh sách phòng</a></li>
            <li><a href="#">Phòng trống</a></li>
        </ul>
    </li>

            <li>
        <a href="#"  onclick="toggleMenu('customer-submenu')">Khách hàng</a>
        <ul class="submenu" id="customer-submenu" style="display: none;">
            <li><a href="{{url('/BookingList')}}" style="">Khách hàng đặt phòng</a></li>
            <li><a href="#">Khách hàng checkin</a></li>
            <li><a href="#">Danh sách khách hàng</a></li>
        </ul>
    </li>
        
            <li><a href="#">Nhân viên</a></li>
            <li><a href="#">Dịch vụ & Kho</a></li>
            <li><a href="#">Thống kê</a></li>
            <li><a href="#">Chính sách</a></li>
        </ul>
    </div>
    {{$slot}}
</body>
</html>

<script> 
                 function toggleMenu(menuId) {
        // Danh sách tất cả các menu có thể có
        const menuIds = ['room-management-submenu', 'customer-submenu'];

        // Đóng tất cả các menu
        menuIds.forEach(id => {
            if (id !== menuId) {
                document.getElementById(id).style.display = 'none';
            }
        });

        // Chuyển trạng thái menu hiện tại
        const submenu = document.getElementById(menuId);
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    }


               // Ẩn menu dropdown khi tải lại trang
    window.onload = function() {
        const menu = document.getElementById("dropdownMenu");
        menu.style.display = "none"; // Đặt menu ở trạng thái ẩn
    };

        function toggleDropdown() {
            const menu = document.getElementById("dropdownMenu");
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        }

        // Đóng menu khi nhấn bên ngoài
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-button')) {
                const dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        } 

        function showOptions() {
        var options = document.getElementById("room-type-options");
        options.style.display = (options.style.display === "none") ? "block" : "none";
    }

     // Hiển thị menu ngữ cảnh khi nhấp vào phòng bằng chuột trái
     document.querySelectorAll('.room').forEach(function(room) {
        room.addEventListener('click', function(event) {
            const contextMenu = document.getElementById('context-menu');
            const roomClass = room.classList[1]; // Lớp thứ hai của phòng (trạng thái)

            // Lưu ID phòng vào menu ngữ cảnh
            contextMenu.setAttribute('data-room-id', room.getAttribute('data-room-id'));

            // Xóa tất cả các nút hiện có trong menu
            contextMenu.innerHTML = '';

            // Kiểm tra phòng màu xanh lá cây và màu vàng
            if (roomClass === 'trong' || roomClass === 'dat-truoc') { // Màu xanh lá cây hoặc vàng
                            contextMenu.innerHTML += '<button onclick="nhanPhong()">Nhận phòng</button> <br>';
                            contextMenu.innerHTML += '<button onclick="datPhong()">Đặt phòng trước</button> <br>';
                        }


            // Hiển thị menu dựa trên trạng thái phòng
            if (roomClass === 'da-nhan') { // Màu đỏ
                contextMenu.innerHTML += '<button onclick="traPhong()">Trả phòng</button>';
            }
            contextMenu.innerHTML += '<button onclick="capNhatTrangThai()">Cập nhật trạng thái</button>';
            contextMenu.innerHTML += '<button onclick="xoaPhong()">Xóa phòng</button>';
            
            // Đặt vị trí cho menu ngữ cảnh
            contextMenu.style.top = event.pageY + 'px';
            contextMenu.style.left = event.pageX + 'px';
            contextMenu.style.display = 'block'; // Hiển thị menu
        });
    });

    // Ẩn menu khi nhấp ra ngoài
    document.addEventListener('click', function(event) {
        if (!event.target.closest('#context-menu') && !event.target.closest('.room')) {
            document.getElementById('context-menu').style.display = 'none'; // Ẩn menu
        }
    });

    // Các hàm xử lý cho các hành động
    function nhanPhong() {
       
        const roomId = document.getElementById('context-menu').getAttribute('data-room-id');
    const url = "{{ url('phieunhanphong') }}/" + roomId; // Correct URL format
    
    window.location.href = url;
    }
    function datPhong() {
        const roomId = document.getElementById('context-menu').getAttribute('data-room-id');
        window.location.href = "dat_phong.php?room_id" + roomId; // Chuyển hướng tới trang dat_phong.php
    }

    function capNhatTrangThai() {
        const roomId = document.getElementById('context-menu').getAttribute('data-room-id');
        window.location.href = "cap_nhat_trang_thai.php?room_id=" + roomId; // Chuyển hướng tới trang cap_nhat_trang_thai.php
    }

    function xoaPhong() {
        const roomId = document.getElementById('context-menu').getAttribute('data-room-id');
        alert("Xóa phòng: " + roomId); // Thay thế bằng logic thực tế
    }

    function traPhong() {
        const roomId = document.getElementById('context-menu').getAttribute('data-room-id');
        alert("Trả phòng: " + roomId); // Thay thế bằng logic thực tế
    }

    function checkIn() {
        const roomId = document.getElementById('context-menu').getAttribute('data-room-id');
        alert("Checkin phòng: " + roomId); // Thay thế bằng logic thực tế
    }

    function checkOut() {
        const roomId = document.getElementById('context-menu').getAttribute('data-room-id');
        alert("Checkout phòng: " + roomId); // Thay thế bằng logic thực tế
    }


function goBack() {
    // Redirect to the desired page
    window.location.href = "{{ url('/quanly') }}"; // Replace with your actual page
}

  //hàm xử lý kiểm tra xem ngày ra có lớn hơn ngày vào không.
  function validateDates() {
            const checkin = new Date(document.getElementById('checkin').value);
            const checkout = new Date(document.getElementById('checkout').value);
            if (checkin >= checkout) {
                alert("Ngày ra phải lớn hơn ngày vào!");
                return false;
            }
            return true;
        }

        function showOverlay() {
        document.getElementById('formOverlay').style.display = 'flex';
    }

    function hideOverlay() {
        document.getElementById('formOverlay').style.display = 'none';
    }

//Hàm xóa
function deleteBooking(bookingId, roomNumber, element) {
    event.preventDefault();

    if (confirm('Bạn có chắc chắn muốn xóa đặt phòng này không?')) {
        fetch('/deletebooking', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: `id=${encodeURIComponent(bookingId)}&room=${encodeURIComponent(roomNumber)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // ✅ Truy lên cha <tr> rồi xóa
                const row = element.closest('tr');
                if (row) {
                    row.remove();
                }
                alert('Đặt phòng đã được xóa thành công!');
            } else {
                alert('Có lỗi xảy ra: ' + (data.error || 'Không xác định'));
            }
        })
        .catch(error => {
            console.error('Lỗi khi gửi yêu cầu:', error);
            alert('Đã xảy ra lỗi khi gửi yêu cầu.');
        });
    }
}





    </script>