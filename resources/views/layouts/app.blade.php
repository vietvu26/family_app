<!DOCTYPE html>
<html class="no-js" lang="en_AU">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Family Manage | Take care of family</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="themes/default/style.min.css">
    <link rel="stylesheet" href="themes/default-dark/style.min.css">
    <link rel="stylesheet" href="/path/to/cdn/bootstrap.min.css" />
    <script src="/path/to/cdn/jquery.min.js"></script>
    <script src="/path/to/cdn/bootstrap.bundle.min.js"></script>
    <link href="dist/css/bstreeview.min.css" rel="stylesheet" />
    <script src="dist/js/bstreeview.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
    <link rel="stylesheet" type="text/scss" href="{{asset('assets/css/tree.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />
</head>

<body data-instant-intensity="mousedown">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
            <div class="container">
                <a class="navbar-brand" href="/" style="font-family: 'Roboto', sans-serif; font-size: 16px; font-weight: bold;">
                    QUẢN LÝ GIA PHẢ
                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item">
                            @auth
                                <a class="nav-link" aria-current="page" href="{{ route('admin.person.manage') }}">Trang chủ</a>
                            @else
                                <a class="nav-link" aria-current="page" href="/">Trang chủ</a>
                            @endauth
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Quản lý thu
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{route('admin.thu.manage')}}">Quản lý định mức thu</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin.dong.manage')}}">Quản lý người đóng</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin.report.index')}}">Quản lý báo cáo thu</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Quản lý chi
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{route('admin.chi.manage')}}">Quản lý loại chi</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin.kchi.manage')}}">Quản lý ghi nhận chi</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin.creport.index')}}">Quản lý báo cáo chi</a></li>
                                </ul>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.tcreport.index')}}">Báo cáo thu chi</a>
                        </li>
                    </ul>
                    @guest
                        <a class="btn btn-outline-primary me-2" href="{{route('login')}}" type="submit">Login</a>
                    @else
                        <a class="btn btn-primary" href="{{route('account.logout')}}" type="submit">Logout</a>
                    @endguest
                </div>
            </div>
        </nav>
    </header>
    <main class="min-vh-100">
        @yield('main')
    </main>
    <footer class="bg-dark py-3 bg-2">
        <div class="container">
            <p class="text-center text-white pt-3 fw-bold fs-6">© 2024 xyz company, all right reserved</p>
        </div>
    </footer>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
