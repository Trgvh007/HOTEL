 <!-- Kiểm tra và hiển thị thông báo thành công -->

    <!-- Kiểm tra và hiển thị lỗi -->
    @if ($errors->any())
        <div style="color:red; margin:0 auto;">
            <div>{{ __('Whoops! Something went wrong.') }}</div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
    <script>
        alert("{{ session('status') }}");
    </script>
@endif
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
                        <a href="javascript:void(0);" onclick="openPhieuPhong('{{ $checkin->ma_booking }}', '{{ $checkin->phong }}')" class="edit">✏️</a>

                        @endif
                        <a href="#" onclick="deleteBooking('{{ $checkin->ma_booking  }}', '{{  $checkin->phong}}', this)" class='delete'>❌</a>
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
          <div id="overlay-background" onclick="closePhieuPhong()"
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.6); z-index:999;"></div>

<div id="phieu-phong-overlay"
     style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%,-50%);
     background:white; padding:30px; border-radius:12px; z-index:1000; max-height:90vh; overflow-y:auto; width:80%;">
</div>

<script>
function openPhieuPhong(bookingId, roomNumber) {
    fetch(`/booking/edit-ajax/${bookingId}/${roomNumber}`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('phieu-phong-overlay').innerHTML = html;
            document.getElementById('overlay-background').style.display = 'block';
            document.getElementById('phieu-phong-overlay').style.display = 'block';
        });
}

function closePhieuPhong() {
    document.getElementById('overlay-background').style.display = 'none';
    document.getElementById('phieu-phong-overlay').style.display = 'none';
}
</script>


</x-Admin_Layout>