<x-Home_header>
    <x-slot name="title">VỤ NỔ LỚN HOTEL</x-slot>
</x-Home_header>
    <!-- Hero Section -->
   <section class="hero-section" style="background-image: url('{{ asset('Cusimage/home.png') }}'); background-size: cover; background-position: center;">
  
        <div class="container">
            <div class="hero-content">
                <div class="search-form">
                    <form action="{{ route('search') }}" method="GET" onsubmit="return validateDates()">
                        <div class="form-group">
                            <label for="ngayden">Ngày đến:</label>
                            <input type="text" 
                                   id="ngayden" 
                                   name="ngayden" 
                                   placeholder="mm/dd/yyyy"
                                   onfocus="(this.type='date')" 
                                   onblur="if(!this.value)this.type='text'"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="ngaydi">Ngày đi:</label>
                            <input type="text" 
                                   id="ngaydi" 
                                   name="ngaydi" 
                                   placeholder="mm/dd/yyyy"
                                   onfocus="(this.type='date')" 
                                   onblur="if(!this.value)this.type='text'"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="sophong">Số phòng:</label>
                            <input type="text" 
                                   id="sophong" 
                                   name="sophong" 
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

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>BẠN CẦN GIÚP ĐỠ?</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Quản lý đặt chỗ của bạn</a></li>
                        <li><a href="#" class="text-white">Hỗ trợ</a></li>
                        <li><a href="#" class="text-white">Bán chạy nhất</a></li>
                    </ul>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ asset('Cusimage/logo1.png') }}" alt="VNL Hotel" class="img-fluid" style="max-width: 200px;">
                    <div class="social-icons mt-3">
                        <a href="#" class="text-white mx-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white mx-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white mx-2"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4>ĐIỀU KHOẢN & QUY ĐỊNH</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Điều khoản chung</a></li>
                        <li><a href="#" class="text-white">Quy định chung</a></li>
                        <li><a href="#" class="text-white">Quy định về thanh toán</a></li>
                        <li><a href="#" class="text-white">Chính sách giải quyết tranh chấp</a></li>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="mb-0">© 2023 VNL Hotel. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
    function validateDates() {
        const ngayDi = new Date(document.getElementById('ngaydi').value);
        const ngayDen = new Date(document.getElementById('ngayden').value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (ngayDi < today) {
            alert("Ngày đi không hợp lệ");
            return false;
        }

        if (ngayDi <= ngayDen) {
            alert("Ngày đi phải lớn hơn ngày đến");
            return false;
        }
        return true;
    }
    </script>
</body>
</html> 
