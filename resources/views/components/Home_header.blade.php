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
                            <a href="{{ route('register') }}" class="btn btn-register">Đăng ký</a>
                        @else
                        <div class="dropdown">
<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
{{ Auth::user()->name }}
</button>
<div class="dropdown-menu">
<a class="dropdown-item" href="#">Lịch sử đặt phòng</a>

                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <a class="dropdown-item" onclick="event.preventDefault();
                                this.closest('form').submit();">Đăng xuất</a>
                            </form>
                        @endguest
                    </nav>
                </div>
            </div>
        </div>
    </div>
 
    {{$slot}}
</body>
</html>