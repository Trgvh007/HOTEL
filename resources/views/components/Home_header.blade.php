<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/header.css">
</head>
<body>
    <!-- Top Header -->
    <div style="background-color: #333;"> <!-- hoặc .bg-dark -->
    <div class="top-header" style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto;">
        
                <div class="d-flex align-items-center">
                    <div class="phone mr-3" style="margin-right: 10px;" >
                    📞 1900 1408
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
                        <div class="dropdown">
<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
{{ Auth::user()->name }}
</button>
<div class="dropdown-menu">
<a class="dropdown-item" href="{{route('booking.print')}}">Lịch sử đặt phòng</a>

                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <a class="dropdown-item" style="cursor: pointer;"  onclick="event.preventDefault();
                                this.closest('form').submit();">Đăng xuất</a>
                            </form>
                        @endguest
                    </nav>
                </div>
            
                </div>
    </div>
 
    {{$slot}}

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
</body>
</html>