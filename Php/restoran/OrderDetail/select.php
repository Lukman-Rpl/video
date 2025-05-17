<h3>Pembayaran Order</h3>
<div class="form-group">

<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Tanggal awal</label>
     <input type="date" name="dawal" require class="form-control">
    </div>
<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Tanggal akhir</label>
     <input type="date" name="dakhir" require  class="form-control">
    </div>
    <div>
        <input type="submit" name="simpan" value="cari" class="btn btn-primary">
    </div>
</form>

</div>
<?php

$jumlahdata=$db->rowCOUNT("SELECT idorderdetail FROM tblorderdetail $where");

$banyak=3;

$halaman=ceil($jumlahdata/$banyak);

if (isset ($_GET['p'])) {
    $p=$_GET['p'];
    $mulai=($p*$banyak)-$banyak;

}
else {
    $mulai=0;
}

$sql="SELECT * FROM tblorderdetail ORDER BY idorderdetail ASC LIMIT $mulai,$banyak";
$row=$db->getALL($sql);

if (isset($_POST['simpan'])) {
    $dawal=$_POST['dawal'];
    $dakhir=$_POST['dakhir'];
    $sql="SELECT * FROM tblorderdetail WHERE tglorder BETWEEN '$dawal' AND '$dakhir'";
}

$no=1+$mulai;

$total=0;
?>

<table class="table table-ordered w-70">
  <thead>
    <tr>
        <td>No</td>
        <td>Pelanggan</td>
        <td>Tanggal</td>
        <td>Menu</td>
        <td>Harga</td>
        <td>Jumlah</td>
        <td>Total</td>
        <td>Alamat</td>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($row)) {?>
    <?php foreach ($row as $r) :
        ?>
        <tr>
            <td><?php echo $no++?></td>
            <td><?php echo $r['pelanggan']?></td>
            <td><?php echo $r['tglorder']?></td>
            <td><?php echo $r['menu']?></td>
            <td><?php echo $r['harga']?></td>
            <td><?php echo $r['jumlah']?></td>
            <td><?php echo $r['jumlah']*$r['harga']?></td>
            <td><?php echo $r['alamat']?></td>
            <?php 
            $total=$total +($r['jumlah']*$r['harga'])
            ?>
        </tr>
        <?php endforeach?>
        <?php }?>
        <tr>
            <td colspan="6">
              <h3>Grandtotal :</h3>
            </td>
            <td colspan="2">
              <h4>Rp.<?php echo $total?></h4>
            </td>
        </tr>
  </tbody>
</table>

<?php
       for ($i=1; $i <= $halaman ; $i++) { 
       echo '<a href="?f=OrderDetail&m=select&p='.$i.$id.'">'.$i.'</a>';
     echo '&nbsp&nbsp&nbsp';
       }?>