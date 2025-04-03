<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="/css/dsach.css">
    
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
            
            <li><a href="quanly.php">Sơ đồ khách sạn</a></li>
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
            <li><a href="" style="">Khách hàng đặt phòng</a></li>
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

            </script>