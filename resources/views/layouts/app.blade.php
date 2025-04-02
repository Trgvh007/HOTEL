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
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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

        .btn-login {
            background: #feba02;
            color: #333;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
        }

        .btn-login:hover {
            background: #fec334;
            color: #333;
            text-decoration: none;
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
                        <a href="{{ route('home') }}#about-section" class="text-white mr-3">Giới thiệu</a>
                        <a href="{{ route('home') }}#promotions-section" class="text-white mr-3">Ưu đãi</a>
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

    <!-- Main Content -->
    @yield('content')

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
                    <img src="{{ asset('images/logo1.png') }}" alt="VNL Hotel" class="img-fluid" style="max-width: 200px;">
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
</body>
</html> 