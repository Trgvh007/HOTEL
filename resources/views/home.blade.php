<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VNL HOTEL</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            scroll-behavior: smooth;
        }

        .top-header {
            background-color: #333;
            color: white;
            padding: 10px 0;
        }

        .top-header .phone {
            margin-right: 20px;
        }

        .top-header .nav-links a {
            color: white;
            margin-left: 15px;
            text-decoration: none;
            font-weight: 500;
        }

        .top-header .nav-links a:hover {
            color: #feba02;
        }

        .social-icons a {
            color: white;
            margin-left: 10px;
            text-decoration: none;
        }

        .main-header {
            padding: 10px 0;
            background: white;
        }

        .logo img {
            height: 60px;
        }

        .nav-links {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .nav-links a {
            color: #333;
            text-decoration: none;
            margin-left: 20px;
        }

        .hero-section {
            position: relative;
            height: 100vh;
            background-image: url("{{ asset('Cusimage/home.png') }}");
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            padding-bottom: 40px;
        }

        .hero-content {
            position: relative;
            text-align: center;
            color: white;
            width: 100%;
            max-width: 1200px;
            padding: 0 20px;
        }

        .hero-title {
            font-size: 100px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            color: white;
            font-weight: normal;
        }

        .hero-subtitle {
            font-size: 28px;
            margin-bottom: 50px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            letter-spacing: 2px;
        }

        .form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.95);
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 85%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            gap: 25px;
            z-index: 10;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            color: #666;
            background-color: white;
            height: 45px;
        }

        .form-control::placeholder {
            color: #999;
        }

        input[type="date"].form-control {
            position: relative;
            padding-right: 35px;
        }

        .date-wrapper {
            position: relative;
        }

        .date-wrapper::after {
            content: "";
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23666' viewBox='0 0 16 16'%3E%3Cpath d='M14 2H13V1a1 1 0 0 0-2 0v1H5V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm0 12H2V7h12v7z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center;
            pointer-events: none;
        }

        .btn-search {
            background: #feba02;
            color: #333;
            border: none;
            padding: 12px 35px;
            height: 45px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            margin-top: 28px;
            white-space: nowrap;
            transition: background-color 0.2s;
        }

        .btn-search:hover {
            background: #fec334;
        }

        .service-icons {
            padding: 40px 0;
            text-align: center;
        }

        .service-icon {
            display: inline-block;
            margin: 0 30px;
            text-align: center;
        }

        .service-icon img {
            width: 50px;
            margin-bottom: 10px;
        }

        .section-title {
            text-align: center;
            font-size: 32px;
            margin: 40px 0;
            font-weight: bold;
        }

        .promotion-card {
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            background: white;
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid #e0e0e0;
        }

        .promotion-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .promotion-info {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .promotion-info h5 {
            font-size: 15px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            line-height: 1.4;
            min-height: 42px;
        }

        .promotion-price {
            color: #0d6efd;
            font-weight: bold;
            font-size: 20px;
            margin-top: auto;
        }

        .destinations {
            margin: 40px 0;
        }

        .destination-image {
            position: relative;
            margin-bottom: 20px;
        }

        .destination-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 5px;
        }

        .destination-name {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            font-size: 24px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .about-section {
            padding: 40px 0;
            background: #f8f9fa;
        }

        .about-image {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .why-choose-us {
            background: white;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .why-choose-us h3 {
            color: #003580;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 24px;
        }

        .why-choose-us ul {
            list-style: none;
            padding: 0;
        }

        .why-choose-us li {
            margin-bottom: 12px;
            padding-left: 28px;
            position: relative;
            font-size: 16px;
        }

        .why-choose-us li:before {
            content: "✓";
            color: #28a745;
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        .hotel-info {
            margin-top: 20px;
        }

        .hotel-name {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }

        .contact-list {
            list-style-type: disc;
            padding-left: 20px;
            margin-bottom: 20px;
        }

        .contact-list li {
            margin-bottom: 8px;
            color: #333;
        }

        .hotel-description {
            margin-top: 20px;
            color: #333;
            line-height: 1.6;
        }
        .gioithieu,
        .Uudai {
            width: 100%;
            padding: 50px 0;
        }
        .tieudegioithieu,
        .tieudeuudaidacbiet {
            text-align: center;
        }
        .hinhanhuudaidacbiet {
            display: flex;
            justify-content: space-between;
            gap: 5px;
        }
        .uudai {
            display: flex;
            flex-direction: column;
            width: 23%;
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            flex-grow: 1;
            position: relative;
        }

        .uudai img {
            width: 100%;
            height: 200px;
            border-radius: 8px;
            object-fit: cover;
        }

        .text-uudai {
            text-align: left;
            flex-grow: 1;
            margin-top: 10px;
        }

        .text-uudai h3 {
            font-size: 16px;
            margin: 5px 0;
        }

        .text-uudai p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        footer {
            background: #003580;
            color: white;
            padding: 40px 0;
        }

        footer h4 {
            margin-bottom: 20px;
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            margin-bottom: 10px;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        .btn-login {
            background: #feba02;
            color: #333;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
        }

        .search-form {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 0 auto;
        }

        .search-form form {
            display: flex;
            gap: 20px;
            align-items: flex-end;
        }

        .search-form .form-group {
            flex: 1;
        }

        .search-form label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .search-form input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        .search-form input[type="text"] {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23666' viewBox='0 0 16 16'%3E%3Cpath d='M14 2H13V1a1 1 0 0 0-2 0v1H5V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm0 12H2V7h12v7z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 20px;
        }

        .search-btn {
            background: #feba02;
            color: #333;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            height: 45px;
            white-space: nowrap;
        }

        .search-btn:hover {
            background: #fec334;
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <div class="top-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="phone mr-3">
                        1900 1408
                    </div>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <nav class="nav-links">
                        <a href="{{ route('home') }}" class="text-white mr-3">Trang chủ</a>
                        <a href="#about-section" class="text-white mr-3">Giới thiệu</a>
                        <a href="#promotions-section" class="text-white mr-3">Ưu đãi</a>
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-login ml-2">Đăng nhập</a>
                        @else
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-login ml-2">Đăng xuất</button>
                            </form>
                        @endguest
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
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
