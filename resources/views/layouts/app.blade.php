<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'تأجير السيارات')</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Arabic Font -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700&display=swap" rel="stylesheet">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

    <div class="container-fluid bg-light sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('css/images/logo.png') }}" alt="طارة"> طارة
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">الرئيسية</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">معلومات عنا</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="service.html">الخدمات</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">اتصل بنا</a>
                        </li>

                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">إنشاء حساب</a>
                            </li>
                        @else
                            {{-- <li class="nav-item">
                                <a class="nav-link profile-icon" href="{{ route('profile') }}">
                                    <i class="fas fa-user-circle"></i>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer Section -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">© 2025 طارة | جميع الحقوق محفوظة</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul class="list-unstyled d-flex justify-content-center justify-content-md-end mb-0">
                        <li class="ms-3">
                            <a href="https://facebook.com" target="_blank" class="text-white">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="ms-3">
                            <a href="https://twitter.com" target="_blank" class="text-white">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="ms-3">
                            <a href="https://instagram.com" target="_blank" class="text-white">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li class="ms-3">
                            <a href="https://linkedin.com" target="_blank" class="text-white">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
