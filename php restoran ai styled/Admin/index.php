<?php
session_start();
require_once('../dbcontroller.php');
$db = new DB;

if (!isset($_SESSION['user'])) {
    header("location:login.php");
    exit;
}

if (isset($_GET['log']) && $_GET['log'] == 'logout') {
    session_destroy();
    header("location:login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Page | Aplikasi Restoran SMK</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" />
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-3">
                <a href="index.php"><h3>Admin Page</h3></a>
            </div>

            <div class="col-md-9">
                <div class="float-right mt-4"><a href="?log=logout">Logout</a></div>
                <div class="float-right mr-4 mt-4">User: 
                    <a href="?f=User&m=updateuser&id=<?php echo $_SESSION['iduser']; ?>">
                        <?php echo htmlspecialchars($_SESSION['user']); ?>
                    </a>
                </div>
                <div class="float-right mr-4 mt-4">Level : <?php echo htmlspecialchars($_SESSION['level']); ?></div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-3">
                <ul class="nav flex-column">
                    <?php
                    $level = $_SESSION['level'];
                    switch ($level) {
                        case 'admin':
                            echo '
                            <li class="nav-item"><a class="nav-link" href="?f=Kategori&m=select">Kategori</a></li>
                            <li class="nav-item"><a class="nav-link" href="?f=Menu&m=select">Menu</a></li>
                            <li class="nav-item"><a class="nav-link" href="?f=Pelanggan&m=select">Pelanggan</a></li>
                            <li class="nav-item"><a class="nav-link" href="?f=Order&m=select">Order</a></li>
                            <li class="nav-item"><a class="nav-link" href="?f=OrderDetail&m=select">Order Detail</a></li>
                            <li class="nav-item"><a class="nav-link" href="?f=User&m=select">User</a></li>
                            ';
                            break;
                        case 'kasir':
                            echo '
                            <li class="nav-item"><a class="nav-link" href="?f=Order&m=select">Order</a></li>
                            <li class="nav-item"><a class="nav-link" href="?f=OrderDetail&m=select">Order Detail</a></li>
                            ';
                            break;
                        case 'koki':
                            echo '
                            <li class="nav-item"><a class="nav-link" href="?f=OrderDetail&m=select">Order Detail</a></li>
                            ';
                            break;
                        default:
                            echo "<li class='nav-item'>Tidak ada menu</li>";
                            break;
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-9">
                <?php
                if (isset($_GET['f']) && isset($_GET['m'])) {
                    $f = $_GET['f'];
                    $m = $_GET['m'];

                    $file = '../' . $f . '/' . $m . '.php';

                    if (file_exists($file)) {
                        require_once $file;
                    } else {
                        echo "<p>File tidak ditemukan.</p>";
                    }
                }
                ?>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <p class="text-center">2024 - copyright by lanku</p>
            </div>
        </div>
    </div>
</body>
</html>
