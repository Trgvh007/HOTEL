<x-Home_header>
    <x-slot name="title">VỤ NỔ LỚN HOTEL</x-slot>

    <!-- Hero Section -->
   <section class="hero-section" style="background-image: url('{{ asset('Cusimage/VNL.jpg') }}'); background-size: cover; background-position: center;">
  
        <div class="container">
            <div class="hero-content">
                <div class="search-form">
                <form action="{{ route('search1') }}" method="POST" onsubmit="return validateDates()">
                @csrf
                <div class="form-group">
                    <label for="checkin">Ngày đến:</label>
                    <input type="text" 
                        id="checkin" 
                        name="checkin" 
                        placeholder="mm/dd/yyyy"
                        onfocus="(this.type='date')" 
                        onblur="if(!this.value)this.type='text'"
                        required>
                </div>
                <div class="form-group">
                    <label for="checkout">Ngày đi:</label>
                    <input type="text" 
                        id="checkout" 
                        name="checkout" 
                        placeholder="mm/dd/yyyy"
                        onfocus="(this.type='date')" 
                        onblur="if(!this.value)this.type='text'"
                        required>
                </div>
                <div class="form-group">
                    <label for="rooms">Số phòng:</label>
                    <input type="number" 
                        id="rooms" 
                        name="rooms" 
                        placeholder="Nhập số phòng"
                        required>
                        
                </div>
                <button type="submit" class="search-btn">Tìm kiếm</button>
</form>

                </div>
            </div>
        </div>
    </section>

    <!-- Container Image Section -->
    <section class="container-image py-5">
        <div class="container text-center">
            <img src="{{ asset('Cusimage/Container.png') }}" alt="VNL Hotel Features" class="img-fluid">
        </div>
    </section>

    <!-- Promotions Section -->
    <section class="promotions" id="promotions-section">
        <div class="container">
            <h2 class="section-title">ƯU ĐÃI ĐẶC BIỆT</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="promotion-card">
                        <div class="image-uudai">
                            <a href="#">
                                <img src="/Cusimage/uudai1.png" alt="[WINTER PROMOTION HÀ TĨNH]">
                            </a>
                        </div>
                        <div class="promotion-info">
                            <h5>[WINTER PROMOTION HÀ TĨNH] - Nghỉ dưỡng 2N1Đ + 01 bữa ăn chính dành cho 02 người lớn và 02 trẻ em dưới 6 tuổi</h5>
                            <div class="promotion-price">1,000,000 VNĐ</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="promotion-card">
                        <div class="image-uudai">
                            <a href="#">
                                <img src="/Cusimage/uudai2.png" alt="[NIGHT DEAL - ƯU ĐÃI TỐI 75%]">
                            </a>
                        </div>
                        <div class="promotion-info">
                            <h5>[NIGHT DEAL - ƯU ĐÃI TỐI 75%] Đêm tuyệt vời, giá siêu hấp dẫn!</h5>
                            <div class="promotion-price">704,000 VNĐ</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="promotion-card">
                        <div class="image-uudai">
                            <a href="#">
                                <img src="/Cusimage/uudai3.png" alt="[WINTER PROMOTION | NHA TRANG]">
                            </a>
                        </div>
                        <div class="promotion-info">
                            <h5>[WINTER PROMOTION | NHA TRANG] Nghỉ dưỡng 2N1Đ + Bữa ăn chính set menu cho 2 khách</h5>
                            <div class="promotion-price">2,375,000 VNĐ</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="promotion-card">
                        <div class="image-uudai">
                            <a href="#">
                                <img src="/Cusimage/uudai4.png" alt="[VNL NGHỈ DƯỠNG SANG CHẢNH]">
                            </a>
                        </div>
                        <div class="promotion-info">
                            <h5>[VNL NGHỈ DƯỠNG SANG CHẢNH] Ngắm bình minh trên biển, đắm mình trong không gian sang trọng tại VNL.</h5>
                            <div class="promotion-price">1,500,000 VNĐ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    <section class="destinations">
        <div class="container">
            <h2 class="section-title">ĐIỂM ĐẾN NỔI BẬT</h2>
            <div class="text-center">
                <img src="{{ asset('Cusimage/diemden.png') }}" alt="Điểm đến nổi bật" class="img-fluid">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about-section">
        <div class="container">
            <h2 class="section-title">GIỚI THIỆU</h2>
            
            <!-- Full-width image -->
            <div class="row mb-4">
                <div class="col-12">
                    <img src="{{ asset('Cusimage/Gioithieu.png') }}" alt="VNL Luxury Riverfront" class="img-fluid w-100">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="hotel-info">
                        <h3 class="hotel-name">VNL Luxury Riverfront</h3>
                        <ul class="contact-list">
                            <li>Số 270, đường Võ Chí Công, phường Mỹ An, quận Ngũ Hành Sơn, thành phố Đà Nẵng, Việt Nam</li>
                            <li>Email: info@luxuryriverfront.VNL.vn</li>
                            <li>Tel: (+84) 236 3956789</li>
                        </ul>
                        
                        <div class="hotel-description">
                            <p>Chào mừng bạn đến với VNL Luxury Riverfront, một thiên đường nghỉ dưỡng sang trọng tọa lạc bên bờ sông tuyệt đẹp. Khách sạn của chúng tôi mang đến cho bạn một trải nghiệm nghỉ dưỡng đẳng cấp với các tiện nghi hiện đại và dịch vụ hoàn hảo.</p>
                            
                            <p>VNL Luxury Riverfront tự hào với các phòng nghỉ rộng rãi, thiết kế tinh tế và tầm nhìn tuyệt đẹp ra sông. Mỗi phòng đều được trang bị đầy đủ tiện nghi cao cấp, từ giường ngủ êm ái, phòng tắm sang trọng đến hệ thống giải trí hiện đại.</p>
                            
                            <p>Khách sạn còn có nhà hàng sang trọng, nơi bạn có thể thưởng thức các món ăn ngon miệng từ ẩm thực địa phương đến quốc tế, được chế biến bởi các đầu bếp tài ba. Ngoài ra, bạn còn có thể thư giãn tại quầy bar với các loại đồ uống phong phú và không gian thoải mái. Để đáp ứng nhu cầu giải trí và thư giãn của bạn, VNL Luxury Riverfront cung cấp nhiều tiện ích như hồ bơi ngoài trời, trung tâm thể dục hiện đại, spa cao cấp và các hoạt động giải trí đa dạng. Đội ngũ nhân viên chuyên nghiệp và thân thiện của chúng tôi luôn sẵn sàng phục vụ bạn 24/7, đảm bảo bạn có một kỳ nghỉ tuyệt vời và đáng nhớ. Hãy đến và trải nghiệm sự sang trọng và đẳng cấp tại VNL Luxury Riverfront, nơi bạn sẽ tìm thấy sự thoải mái và hài lòng tuyệt đối.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="why-choose-us">
                        <h3>Vì sao nên chọn VNL?</h3>
                        <ul>
                            <li>Giá không thể tốt hơn</li>
                            <li>Đặt phòng an toàn</li>
                            <li>Quản lý đặt phòng trực tuyến</li>
                            <li>Tiện nghi và vị trí tuyệt vời</li>
                            <li>Nhân viên nói tiếng Việt & Anh</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    function validateDates() {
        const checkinInput = document.getElementById("checkin").value;
        const checkoutInput = document.getElementById("checkout").value;
        const roomsInput = parseInt(document.getElementById("rooms").value);

        const today = new Date();
        today.setHours(0, 0, 0, 0); // bỏ giờ để so sánh chính xác ngày

        const checkinDate = new Date(checkinInput);
        const checkoutDate = new Date(checkoutInput);

        // Kiểm tra ngày đến > hôm nay
        if (checkinDate <= today) {
            alert("Ngày đến phải lớn hơn ngày hiện tại.");
            return false;
        }

        // Kiểm tra ngày đi > ngày đến
        if (checkoutDate <= checkinDate) {
            alert("Ngày đi phải lớn hơn ngày đến.");
            return false;
        }

        // Kiểm tra số phòng > 0
        if (isNaN(roomsInput) || roomsInput <= 0) {
            alert("Số phòng phải lớn hơn 0.");
            return false;
        }

        return true; // tất cả điều kiện hợp lệ
    }
</script>

</body>
</html> 
</x-Home_header>