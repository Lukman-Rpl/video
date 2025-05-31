<?php
ob_start();
session_start();
require_once "dbcontroller.php";
$db = new DB;

$sql = "SELECT * FROM tblkategori ORDER BY kategori";
$row = $db->getALL($sql);

if (isset($_GET['log']) && $_GET['log'] == 'logout') {
    session_destroy();
    header("location:index.php");
    exit;
}

function cart() {
    global $db;
    $cart = 0;

    foreach ($_SESSION as $key => $value) {
        if ($key <> 'pelanggan' && $key <> 'idpelanggan' && $key <> 'user' && $key <> 'level' && $key <> 'iduser') {
            $id = substr($key, 1);
            $sql = "SELECT * FROM tblmenu WHERE idmenu=$id";
            $row = $db->getALL($sql);
            foreach ($row as $r) {
                $cart++;
            }
        }
    }
    return $cart;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran - Aplikasi Pemesanan Makanan</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --accent-color: #FFE66D;
            --dark-color: #1A535C;
            --light-color: #F7FFF7;
        }
        
        body {
            background-color: var(--light-color);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        
        .navbar {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--primary-color) !important;
        }
        
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .card-img-top {
            transition: transform 0.5s ease;
        }
        
        .card:hover .card-img-top {
            transform: scale(1.1);
        }
        
        .card-title {
            color: var(--dark-color);
            font-weight: 600;
        }
        
        .card-text {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.2rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--dark-color);
            transform: scale(1.05);
        }
        
        h2 a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
            transition: color 0.3s ease;
        }
        
        h2 a:hover {
            color: var(--dark-color);
            text-decoration: none;
        }
        
        h3 {
            color: var(--dark-color);
            margin-bottom: 20px;
            font-weight: 700;
            position: relative;
            padding-bottom: 10px;
        }
        
        h3:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .nav-link {
            color: var(--dark-color);
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 5px;
            padding: 8px 15px;
        }
        
        .nav-link:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateX(5px);
        }
        
        .float-right a {
            color: var(--dark-color);
            font-weight: 500;
            margin-left: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 5px 10px;
            border-radius: 5px;
        }
        
        .float-right a:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 30px 0;
            margin-top: 70px;
            border-radius: 15px 15px 0 0;
        }
        
        .form-control {
            border-radius: 30px;
            padding: 12px 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        
        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 205, 196, 0.25);
        }
        
        /* Animasi untuk elemen-elemen */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .card, h3, .nav-item {
            animation: fadeIn 0.5s ease forwards;
        }
        
        /* Styling untuk header */
        .header-container {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .header-container h2 a {
            color: white;
        }
        
        /* Styling untuk kategori */
        .kategori-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        /* Styling untuk footer */
        .footer-text {
            font-weight: 500;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="container">
       <div class="row header-container mt-3">
          <div class="col-md-3 mt-2">
             <h2><a href="index.php"><i class="fas fa-utensils mr-2"></i>Restoran</a></h2>
          </div>
          <div class="col-md-9">
            <?php
            if (isset($_SESSION['pelanggan'])) {
                echo'
                <div class="float-right mt-3"><a href="?log=logout"><i class="fas fa-sign-out-alt mr-1"></i>Logout</a></div>
                <div class="float-right mt-3"><i class="fas fa-user mr-1"></i>'.$_SESSION['pelanggan'].'</div>
                <div class="float-right mt-3"><a href="?f=Home&m=beli"><i class="fas fa-shopping-cart mr-1"></i>Cart ('.cart().')</a></div>
                <div class="float-right mt-3"><a href="?f=Home&m=history"><i class="fas fa-history mr-1"></i>History</a></div>
                ';
            }else{
                echo'
                <div class="float-right mt-3"><a href="?f=Home&m=login"><i class="fas fa-sign-in-alt mr-1"></i>Login</a></div>
                <div class="float-right mt-3"><a href="?f=Home&m=daftar"><i class="fas fa-user-plus mr-1"></i>Daftar</a></div>
                ';
            }
            ?>
          </div>
       </div>
       <div class="row mt-4">
        <div class="col-md-3">
            <div class="kategori-container">
                <h3><i class="fas fa-list mr-2"></i>Kategori</h3>
                <hr>
                <?php if (!empty($row)) {?>
                    <ul class="nav flex-column">
                        <?php foreach ($row as $r) :?>
                            <li class="nav-item"><a class="nav-link" href="?f=Home&m=produk&id=<?php echo $r['idkategori'] ?>"><i class="fas fa-angle-right mr-2"></i><?php echo $r['kategori'] ?></a> </li>
                        <?php endforeach ?>
                    </ul>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-9">
         <?php
         if (isset($_GET['f']) && isset($_GET['m'])) {
            $f=$_GET['f'];
            $m=$_GET['m'];

            $file=$f.'/'.$m.'.php';

            require_once $file;
         }else{
            require_once "Home/produk.php";
         }
         ?>
        </div>
       </div>
       <div class="row mt-5">
        <div class="col">
           <p class="text-center footer-text">Hak milik LUKMAN &copy; <?php echo date('Y'); ?></p>
        </div>
       </div>
    </div>
    
    <!-- Tambahkan script JavaScript untuk animasi dan interaksi -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>