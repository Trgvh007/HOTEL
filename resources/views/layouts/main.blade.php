<!DOCTYPE html>
<html>
	<head>
		<title>@yield('title')</title>
		<link rel="stylesheet"
		href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	</head>
<body>
<header style="background-color: #f8f9fa; padding: 10px 0;">
    <div class="header-container" style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto;">
        <div class="contact" style="display: flex; align-items: center;">
            <span style="margin-right: 10px;">📞 1900 1833</span>
            <a href="https://www.facebook.com/"><img src="{{ asset('Cusimage/fbicon.jpg') }}"  style="width: 20px; margin-right: 5px;"></a>
            <a href="https://www.instagram.com/"><img src="{{ asset('Cusimage/insicon.jpg') }}" style="width: 20px; margin-right: 5px;"></a>
            <a href="https://www.youtube.com/"><img src="{{ asset('Cusimage/youtubeicon.jpg') }}" style="width: 20px;"></a>
        </div>
        <div class="logo" style="flex-grow: 1; text-align: center;">
            <img src="{{ asset('Cusimage/logo1.png') }}" alt="VNL Hotel Logo" style="max-height: 60px;">     
        </div>
        <div class="user-options" style="text-align: right;">
            <a href="#" style="text-decoration: none; color: #000; margin-right: 10px;">Về trang chủ</a>
            <a href="#" style="text-decoration: none; background-color: #f1c40f; color: #fff; padding: 5px 10px; border-radius: 5px;">Đăng xuất</a>
        </div>
    </div>
</header>
	<main>
		@yield('content')
	</main>
	<footer style="width: 100%; background-color: #f8f9fa;">    
            <img src="/Cusimage/footer.png" style="max-width: 100%; ">
</footer>
</body>
</html>