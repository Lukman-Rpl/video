<?php
require_once __DIR__ . '/../dbcontroller.php';
//session_start();
$db = new DB;

if (isset($_GET['total'])) {
    $total = $_GET['total'];
    $idorder = idorder();
    $idpelanggan = $_SESSION['idpelanggan'];
    $tgl = date('Y-m-d');

    // Cek apakah order sudah ada
    $sql = "SELECT * FROM tblorder WHERE idorder=$idorder";
    $count = $db->rowCOUNT($sql);

    if ($count == 0) {
        $insertOrder = insertOrder($idorder, $idpelanggan, $tgl, $total);
        if ($insertOrder) {
            insertOrderDetail($idorder);
        } else {
            echo "Gagal insert order.";
            exit;
        }
    } else {
        insertOrderDetail($idorder);
    }
    Sessionkosong();
    header("location:?f=Home&m=checkout");
    exit;
} else {
    info();
}

function idorder() {
    global $db;
    $sql = "SELECT idorder FROM tblorder ORDER BY idorder DESC LIMIT 1";
    $jumlah = $db->rowCOUNT($sql);

    if ($jumlah == 0) {
        $id = 1;
    } else {
        $item = $db->getITEM($sql);
        $id = $item['idorder'] + 1;
    }
    return $id;
}

function insertOrder($idorder, $idpelanggan, $tgl, $total) {
    global $db;
    // Isi kolom bayar, kembali, status, dan created_at sesuai kebutuhan
    $bayar = 0;
    $kembali = 0;
    $status = 0;
    $sql = "INSERT INTO tblorder (idorder, idpelanggan, tglorder, total, bayar, kembali, status, created_at) 
            VALUES ($idorder, $idpelanggan, '$tgl', $total, $bayar, $kembali, $status, NOW())";
    return $db->runSQL($sql);
}

function insertOrderDetail($idorder) {
    global $db;
    foreach ($_SESSION as $key => $value) {
        if ($key != 'pelanggan' && $key != 'idpelanggan' && $key != 'user' && $key != 'level' && $key != 'iduser') {
            $id = substr($key, 1);

            $sql = "SELECT * FROM tblmenu WHERE idmenu=$id";
            $row = $db->getALL($sql);

            foreach ($row as $r) {
                $idmenu = $r['idmenu'];
                $harga_jual = $r['harga'];

                $sql = "INSERT INTO tblorderdetail (idorderdetail, idorder, idmenu, jumlah, hargajual, created_at) 
                        VALUES (NULL, $idorder, $idmenu, $value, $harga_jual, NOW())";
                $db->runSQL($sql);
            }
        }
    }
}

function Sessionkosong() {
    foreach ($_SESSION as $key => $value) {
        if ($key != 'pelanggan' && $key != 'idpelanggan') {
            $id = substr($key, 1);
            unset($_SESSION['_' . $id]);
        }
    }
}

function info() {
    echo '<h4>Terimakasih sudah berbelanja</h4>';
}
