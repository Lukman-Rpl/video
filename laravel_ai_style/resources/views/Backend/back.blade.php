<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin page Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --accent-color: #e74c3c;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --sidebar-width: 250px;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Arial', sans-serif;
            color: #333;
            min-height: 100vh;
        }
        
        .sidebar {
            background: linear-gradient(to bottom, var(--dark-color), #34495e);
            color: #fff;
            min-height: 100vh;
            width: var(--sidebar-width);
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: all 0.3s;
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header h3 {
            color: white;
            margin-bottom: 0;
            font-weight: 600;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(to right, var(--primary-color), #4aa3df);
            color: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
        }
        
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-info .badge {
            font-size: 12px;
            padding: 5px 10px;
            background: linear-gradient(to right, var(--primary-color), #4aa3df);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .card-header {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            border-bottom: 1px solid #eee;
            font-weight: bold;
            padding: 15px 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .table {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        
        .table thead {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
        }
        
        .table thead th {
            font-weight: 600;
            border-bottom: none;
            padding: 12px 15px;
        }
        
        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
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
        
        .btn-success {
            background: linear-gradient(to right, var(--secondary-color), #27ae60);
            border: none;
        }
        
        .btn-danger {
            background: linear-gradient(to right, var(--accent-color), #c0392b);
            border: none;
        }
        
        .btn-warning {
            background: linear-gradient(to right, #f39c12, #e67e22);
            border: none;
            color: white;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .pagination {
            justify-content: center;
        }
        
        .pagination .page-item .page-link {
            border-radius: 5px;
            margin: 0 3px;
            color: var(--primary-color);
            transition: all 0.3s;
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(to right, var(--primary-color), #4aa3df);
            border-color: var(--primary-color);
        }
        
        .alert {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        
        .logout-btn {
            background: linear-gradient(to right, var(--accent-color), #c0392b);
            color: white;
            border: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin')) ? 'active' : '' }}" href="{{ url('admin') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            @if (Auth::user()->level=='admin')
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/user*')) ? 'active' : '' }}" href="{{ url('admin/user') }}">
                    <i class="bi bi-people"></i> User
                </a>
            </li>
            @endif
            
            @if (Auth::user()->level=='kasir')
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/order*')) ? 'active' : '' }}" href="{{ url('admin/order') }}">
                    <i class="bi bi-cart3"></i> Order
                </a>
            </li>
            @endif
            
            @if (Auth::user()->level=='manager')
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/kategori*')) ? 'active' : '' }}" href="{{ url('admin/kategori') }}">
                    <i class="bi bi-tags"></i> Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/menu*')) ? 'active' : '' }}" href="{{ url('admin/menu') }}">
                    <i class="bi bi-menu-button-wide"></i> Menu
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/order*')) ? 'active' : '' }}" href="{{ url('admin/order') }}">
                    <i class="bi bi-cart3"></i> Order
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/orderdetail*')) ? 'active' : '' }}" href="{{ url('admin/orderdetail') }}">
                    <i class="bi bi-receipt"></i> Order Detail
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (request()->is('admin/pelanggan*')) ? 'active' : '' }}" href="{{ url('admin/pelanggan') }}">
                    <i class="bi bi-person"></i> Pelanggan
                </a>
            </li>
            @endif
            
            <li class="nav-item mt-3">
                <a class="nav-link logout-btn" href="{{ url('admin/logout') }}">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
    
    <div class="main-content">
        <nav class="navbar">
            <div class="container-fluid">
                <h4 class="mb-0">Aplikasi Restoran SMK</h4>
                <div class="user-info">
                    <span><i class="bi bi-person-circle"></i> {{ Auth::user()->email }}</span>
                    <span class="badge">{{ Auth::user()->level }}</span>
                </div>
            </div>
        </nav>
        
        <div class="content">
            @yield('admincontent')
        </div>
    </div>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>