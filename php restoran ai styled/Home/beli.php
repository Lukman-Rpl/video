<?php
if (isset($_GET['hapus'])) {
    $id=$_GET['hapus'];
    unset($_SESSION['_'.$id]);
    header("location:?f=Home&m=beli");
    exit;
}

if (isset($_GET['tambah'])) {
    $id=$_GET['tambah'];
    $_SESSION['_'.$id]++;
}

if (isset($_GET['kurang'])) {
    $id=$_GET['kurang'];
    $_SESSION['_'.$id]--;
   if ($_SESSION['_'.$id]==0) {
    unset($_SESSION['_'.$id]);
   }
}

if (!isset($_SESSION['pelanggan'])) {
    header("location:?f=Home&m=beli");
    exit;
}else{
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        isi($id);
        header("location:?f=Home&m=beli");
        exit;
       }else{
        keranjang();
       }
}

function isi($id)
{
    if (isset($_SESSION['_'.$id])) {
        $_SESSION['_'.$id]++;
    }else {
        $_SESSION['_'.$id]=1;
    }
}

function keranjang(){
    global $db;
    $total = 0;

    echo '<h3 style="text-align: center">Keranjang Belanja</h3>';
    echo '<table class="table table-bordered w-70 mt-4">
    <tr>
        <th>Menu</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Hapus</th>
    </tr>';

    foreach ($_SESSION as $key => $value) {
        if (!in_array($key, ['pelanggan', 'idpelanggan', 'user', 'level', 'iduser'])) {
            $id = substr($key, 1);
            $sql = "SELECT * FROM tblmenu WHERE idmenu=$id";
            $row = $db->getALL($sql);

            foreach ($row as $r) {
                echo '<tr>';
                echo '<td>'.$r['menu'].'</td>';
                echo '<td>'.$r['harga'].'</td>';    
                echo '<td><a href="?f=Home&m=beli&tambah='.$r['idmenu'].'">[+]</a> &nbsp '.$value.' &nbsp <a href="?f=Home&m=beli&kurang='.$r['idmenu'].'">[-]</a></td>';    
                echo '<td>Rp. '.($r['harga'] * $value).'</td>';    
                echo '<td><a href="?f=Home&m=beli&hapus='.$r['idmenu'].'">Hapus</a></td>';    
                echo '</tr>';

                $total += ($value * $r['harga']);
            }
        }
    }

    echo '<tr>
        <td colspan=3><h4>Grand Total :</h4></td>
        <td colspan=2><h3>Rp. '.$total.'</h3></td>
    </tr>';
    echo '</table>';

    if ($total > 0) {
        echo '<a class="btn btn-primary" href="?f=Home&m=checkout&total='.$total.'" role="button">Checkout</a>';
    } else {
        echo '<p style="text-align:center">Keranjang kosong</p>';
    }
}

?>