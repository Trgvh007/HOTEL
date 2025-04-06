<x-phieuphong>
    <x-slot name='title'> 
        {{ $action =='edit' ? 'Chỉnh sửa đặt phòng': 'Phiếu nhận phòng' }} </x-slot>
        
<div class="container">
            <div class="header">
                <img src="/Adimage/person.png" width="35px" padding = "15px"   margin=" 10px">
              
                <span style="font-size: 30px">
                {{ $action == 'edit' ? "Chỉnh sửa đặt phòng - R{$roomDetails->so_phong}" : "Phiếu nhận phòng {$roomDetails->so_phong}" }}
                @if($action == 'edit')
                <a href="{{ route('chuyen-phong', ['room' => $roomDetails->so_phong]) }}" class="edit">✏️</a> - [{{ $booking->ID_Booking ?? '' }}]
                @endif
            </span>
</div>
<form action="{{ $action=='edit' ? route('booking.update', ['id' => $booking->ID_Booking]) : route('booking.insert') }}" method="post" enctype="multipart/form-data">

          
            @csrf
            <div class="section">
        <div class="section-title">Thông tin đăng ký - <span style="color: red;">{{$booking->ten_loai ?? '' }}</span></div>
        <div class="registration-info">
            <div class="column">
                <div class="form-group">
                    <label for="checkin">Ngày vào:</label>
                    <input type="date" id="checkin" name="checkin" value="{{ old('checkin', $booking->ngay_vao ?? '') }}">
                    <input type="time" name="time_checkin" class="time" value="{{ old('time_checkin', $booking->gio_vao ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="checkout">Ngày ra:</label>
                    <input type="date" id="checkout" name="checkout" value="{{ old('checkout', $booking->ngay_ra ?? '') }}">
                    <input type="time" name="time_checkout" class="time" value="{{ old('time_checkout', $booking->gio_ra ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="company">Cty/Group:</label>
                    <input type="text" id="company" name="company" value="{{ old('company', $booking->group ?? '') }}">
                </div>
            </div>
            <div class="column">
                <div class="form-group">
                    <label for="prepaid">Trả trước:</label>
                    <input type="text" id="prepaid" name="prepaid" value="{{ old('prepaid', $booking->tra_truoc ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="discount">Giảm trừ:</label>
                    <input type="text" id="discount" name="discount" value="{{ old('discount', $booking->giam_tru ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="notes">Ghi chú:</label>
                    <input type="text" id="notes" name="notes" value="{{ old('notes', $booking->ghi_chu ?? '') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <label class="add-service">Thêm dịch vụ</label>
        <select id="add-service" name="add_service">
            <!-- Option sẽ được thêm vào đây -->
        </select>
    </div>

    <div class="section">
        <div class="section-title">Thông tin khách hàng</div>
        <div class="customer-info">
            <div class="column">
                <div class="form-group">
                    <label for="id">CCCD/Passport:</label>
                    <input type="text" id="id" name="cccd" value="{{ old('cccd', $booking->cccd ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="name">Họ tên:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $booking->ho_ten ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="dob">Ngày sinh:</label>
                    <input type="date" id="dob" name="dob" value="{{ old('dob', $booking->ngay_sinh ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $booking->sdt ?? '') }}">
                </div>
            </div>
            <div class="column">
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $booking->dia_chi ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $booking->email ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="country">Quốc tịch:</label>
                    <select id="country" name="country">
                        <option value="Mỹ" {{ old('country', $booking->quoc_tich ?? '') == 'Mỹ' ? 'selected' : '' }}>Mỹ</option>
                        <option value="Úc" {{ old('country', $booking->quoc_tich ?? '') == 'Úc' ? 'selected' : '' }}>Úc</option>
                        <option value="Anh" {{ old('country', $booking->quoc_tich ?? '') == 'Anh' ? 'selected' : '' }}>Anh</option>
                        <option value="Việt Nam" {{ old('country', $booking->quoc_tich ?? '') == 'Việt Nam' ? 'selected' : '' }}>Việt Nam</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gender">Giới tính:</label>
                    <select id="gender" name="gender">
                        <option value="Nam" {{ old('gender', $booking->gioi_tinh ?? '') == 'Nam' ? 'selected' : '' }}>Nam</option>
                        <option value="Nữ" {{ old('gender', $booking->gioi_tinh ?? '') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Phương thức thanh toán</div> <br>
        <input type='radio' name='payment_method' value="Tiền mặt" {{ old('payment_method', $booking->phuong_thuc ?? '') == 'Tiền mặt' ? 'checked' : '' }}> Tiền mặt <br>
        <input type='radio' name='payment_method' value="Quét mã QR" {{ old('payment_method', $booking->phuong_thuc ?? '') == 'Quét mã QR' ? 'checked' : '' }}> Quét mã QR
    
            
                </div>
                <div class="buttons">
                @if($action == 'edit')
                    <button type="button" class="cancel" onclick="goBack()">Cancel</button>
                    <button type="submit" class="confirm">✅ Cập nhật</button>
                @else
                    <button type="reset" class="cancel" onclick="goBack()">Hủy</button>
                    <button type="submit" class="confirm">✅ Nhận phòng</button>
                @endif
            </form>
            </div>
          
            </x-phieuphong>
