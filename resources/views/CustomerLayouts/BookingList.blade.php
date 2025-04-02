<x-Admin_Layout>
<x-slot name='title'>
Danh Sách Đặt Phòng
</x-slot>

<div class="content">
        <div class="header">
            <h2>Danh sách đặt phòng</h2>
            <div>
                <a href="#">Chuyển ca</a>
                <a href="#">Thoát</a>
            </div>
        </div>
        <div class="filter-section">
    <label for="entries">Hiển thị</label>
    <select id="entries">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
    </select>
    <label for="from-date">Từ:</label>
    <input type="date" id="from-date">
    <label for="to-date">Đến:</label>
    <input type="date" id="to-date">
    <input type="text" id="search" placeholder="Tìm kiếm...">
    <button class="btn" id="filter-btn">Lọc</button>
    <button onclick ="resetTable()" class="btn btn-reset" id="reset-btn">Reset</button>
</div>

<div class="table-container">
            <table id="booking-table">
            <tr>
            <th><input type="checkbox" id="selectall" onclick="toggleCheckboxes(this)"></th>
            <th>STT</th>
            <th>Mã Booking</th>
            <th>Họ tên</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Phòng</th>
            <th>Trạng thái</th>
            <th>Ngày đặt phòng</th>
            <th>Thao tác</th>
        </tr>
        @php $stt = 1; @endphp
        @foreach($bookings as $date => $checkins)
            <tr data-date-row="{{ $date }}">
                <td colspan="10" style="color: red; text-align: left;">{{ $date }} - {{ count($checkins) }} check-in</td>
            </tr>
            @foreach($checkins as $checkin)
                <tr>
                    <td><input type="checkbox" name="room_check[]"></td>
                    <td>{{ $stt }}</td>
                    <td>{{ $checkin->ma_booking }}</td>
                    <td>{{ $checkin->ho_ten }}</td>
                    <td>{{ $checkin->checkindate }}</td>
                    <td>{{ $checkin->checkoutdate }}</td>
                    <td>{{ $checkin->phong }}</td>
                    <td>{{ $checkin->trang_thai }}</td>
                    <td>{{ $checkin->ngay_dat }}</td>
                    <td>
                        @if($checkin->checkindate >= date('Y-m-d'))
                            <a href="{{ url('chinhsuadatphong?.id=' . $checkin->ma_booking . '&room=' . $checkin->phong) }}" class='edit'>✏️</a>
                        @endif
                        <a href="#" onclick="deleteBooking('{{ $checkin->ma_booking  }}', '{{  $checkin->phong}}')" class='delete'>❌</a>
                    </td>
                </tr>
                @php $stt++; @endphp
            @endforeach
        @endforeach
</table>
</div>
                    <div class="button-container">
            
            <button onclick="printTable()" class="btn btn-primary">Print</button>
            <button style = "background: blue; color:#fff";  class="btn btn-primary"> ✅ Nhận phòng </button>
          </div>
</x-Admin_Layout>