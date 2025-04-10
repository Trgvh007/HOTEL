<x-Admin_Layout>
<x-slot name='title'>Quản lý Khách sạn</x-slot>

<div class="content">
        <div class="header">
            <h2>Sơ đồ khách sạn</h2>
            <div>
                <a href="#">Chuyển ca</a>
                <a href="#">Thoát</a>
            </div>
        </div>
        <h1>Sơ đồ khách sạn</h1>
        <div>
            <div class ="status">
    @foreach($statusCounts as $status)
        @php
            $color = '';
            switch ($status->trang_thai) {
                case 'Đã nhận':
                    $color = 'red';
                    break;
                case 'Trống':
                    $color = 'green';
                    break;
                case 'Sửa chữa':
                    $color = 'gray';
                    break;
                case 'Đặt trước':
                    $color = 'orange';
                    break;
                case 'Dọn dẹp':
                    $color = 'blue';
                    break;
            }
        @endphp
        <span style="color: {{ $color }}; font-weight: bold;">
            {{ $status->so_luong }} {{ $status->trang_thai }}
        </span>
@endforeach
        </div>

        <div class="common-button">
        <label for="room-type"></label>
        <!-- Nút chọn 'Khách đoàn/Cty' -->
        <div class="dropdown">
    <button class="common-button dropdown-button" style=" margin-right: 10px;" onclick="toggleDropdown()">Khách đoàn/CTY</button>
    <div class="dropdown-content" id="dropdownMenu">
        <a href="#">Đặt phòng trước</a>
        <a href="#">Nhận phòng khách đoàn</a>
        <a href="#">Checkin khách đoàn</a>
        <a href="#">Checkout khách đoàn</a>
    </div>


    <!-- Container chứa các lựa chọn -->
    <div id="room-type-options" style="display: none;z-index:100;background-color: white; border: 1px solid #ccc;">
            <button onclick="window.location.href='phongkhachdoan.php';" value="luxury">Nhận phòng khách đoàn</button>
            <button value="standard">Đặt phòng trước</button>
            <button value="superior">Checkin khách đoàn</button>
            <button value="suite">Checkout khách đoàn</button>
        </div>

        </div>

         <!-- Nút DS Checkin -->
    <button class="common-button dropdown-button" style="background: #8A0D86; margin-right: 10px;">DS Checkin</button>
    <!-- Nút DS Checkout -->
    <button class="common-button dropdown-button" style="background: #424955;  margin-right: 10px;">DS Checkout</button>
    <!-- Nút Phiếu dịch vụ -->
    <button class="common-button dropdown-button" style="background: #EF9657;  margin-right: 10px;  ">Phiếu dịch vụ</button>
        <label for="room-type"></label>
        
    </div>
            </div>

        
<div class="floor-container">
@php $currentFloor = -1; @endphp
@foreach($rooms as $room)
    @if($room->tang != $currentFloor)
        @if($currentFloor != -1)
            </div> <!-- End previous floor -->
        @endif
        @php $currentFloor = $room->tang; @endphp
        <div class="floors">
            <div class="floor">Tầng {{ $currentFloor }}</div></div>
        <div class="rooms-row">
    @endif

    @php
    $statusClass = \App\Http\Controllers\RoomController::formatStatusClass($room->trang_thai); 
   
    @endphp

    <div class="room {{ $statusClass }}" data-room-id="{{ $room->so_phong }}">
        {{ $room->so_phong }}<br>{{ $room->ten_loai }}
        <p>{{ number_format($room->don_gia, 0, ',', '.') }} VND</p>
       
    </div>

@endforeach
</div>
        </div> <!-- End last floor -->
       
        

        <div id="context-menu">
        <button onclick="nhanPhong()">Nhận phòng</button>
            <button onclick="datPhong()">Đặt phòng trước</button> 
            <button onclick="capNhatTrangThai()">Cập nhật trạng thái</button> 
            <button onclick="xoaPhong()">Xóa phòng</button>
    </div>
        </div>
   
       
    

</x-Admin_Layouts>