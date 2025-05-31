<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --accent-color: #e74c3c;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Arial', sans-serif;
            color: #333;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .navbar {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 10px;
            padding: 15px 25px;
            margin-bottom: 30px;
        }
        
        .navbar-brand img {
            width: 100px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
            transition: transform 0.3s;
        }
        
        .navbar-brand img:hover {
            transform: scale(1.05);
        }
        
        .navbar-nav .nav-item {
            margin-right: 10px;
        }
        
        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .navbar-nav .nav-link:hover {
            background-color: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }
        
        .cart-badge {
            position: relative;
            display: inline-block;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .user-menu {
            display: flex;
            align-items: center;
        }
        
        .user-email {
            margin-right: 15px;
            font-weight: 500;
            color: white;
        }
        
        .sidebar {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 20px;
            height: 100%;
        }
        
        .list-group-item {
            border: none;
            border-radius: 8px !important;
            margin-bottom: 8px;
            transition: all 0.3s;
            background-color: transparent;
        }
        
        .list-group-item:hover {
            background-color: var(--light-color);
            transform: translateX(5px);
        }
        
        .list-group-item a {
            text-decoration: none;
            color: var(--dark-color);
            display: block;
            font-weight: 500;
        }
        
        .content-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            padding: 25px;
            min-height: 500px;
        }
        
        footer {
            margin-top: 50px;
            padding: 20px 0;
            text-align: center;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        }
        
        /* Card styling for menu items */
        .menu-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            height: 100%;
        }
        
        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .menu-img {
            height: 200px;
            object-fit: cover;
        }
        
        .menu-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .position-relative:hover .menu-overlay {
            opacity: 1;
        }
        
        .btn {
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary-color), #4aa3df);
            border: none;
        }
        
        .btn-danger {
            background: linear-gradient(to right, var(--accent-color), #e84c3d);
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mt-4">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/"><img src="{{ asset ('gambar/gagak.png') }}" alt="Logo Restoran"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            @if (session()->has('cart'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('cart') }}">
                                    <div class="cart-badge">
                                        <i class="bi bi-cart3 fs-5"></i>
                                        <span class="cart-count">
                                            @php
                                                $count=count(session('cart'));
                                                echo $count;
                                            @endphp
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="bi bi-cart3 fs-5"></i>
                                </a>
                            </li>
                            @endif
                    
                            @if (session()->missing('idpelanggan'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('register') }}">
                                    <i class="bi bi-person-plus"></i> Daftar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('login') }}">
                                    <i class="bi bi-box-arrow-in-right"></i> Login
                                </a>
                            </li>
                            @endif
                            
                            @if (session()->has('idpelanggan'))
                            <li class="nav-item user-menu">
                                <span class="user-email">
                                    <i class="bi bi-person-circle"></i> {{ session('idpelanggan')['email'] }}
                                </span>
                                <a class="nav-link btn btn-outline-light btn-sm" href="{{ url('logout') }}">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="sidebar">
                        <h5 class="mb-3 fw-bold">Kategori Menu</h5>
                        <ul class="list-group">
                            @foreach ($kategoris as $kategori)
                                <li class="list-group-item">
                                    <a href="{{ url('show/'.$kategori->idkategori) }}">{{ $kategori->kategori }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="content-container">
                        @yield('content')
                    </div>
                </div>
            </div>
            
            <footer class="mt-5">
                <div class="container">
                    <p class="mb-0">&copy; {{ date('Y') }} Aplikasi Restoran SMK - Dibuat dengan <i class="bi bi-heart-fill"></i></p>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>