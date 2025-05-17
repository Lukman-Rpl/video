<?php

$jumlahdata=$db->rowCOUNT("SELECT idorder FROM tblorder $where");

$banyak=2;

$halaman=ceil($jumlahdata/$banyak);

if (isset ($_GET['p'])) {
    $p=$_GET['p'];
    $mulai=($p*$banyak)-$banyak;

}
else {
    $mulai=0;
}

$sql="SELECT * FROM tblorder $where ORDER BY status,idorder ASC LIMIT $mulai,$banyak";
$row=$db->getALL($sql);

$no=1+$mulai;
?>
<h3>Order Pembelian</h3>
<table class="table table-ordered w-70">
  <thead>
    <tr>
        <td>No</td>
        <td>Pelanggan</td>
        <td>Tanggal</td>
        <td>Total</td>
        <td>Bayar</td>
        <td>Kembali</td>
        <td>Status</td>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($row)) {?>
    <?php foreach ($row as $r) :
     if ($r['status']===0) {
        $status = '<td><a href="?f=Order&m=bayar&id=' . $r['idorder'] . '">Bayar</a></td>';
     }else {
        $status='<td>Lunas</td>';
     }
        ?>
        <tr>
            <td><?php echo $no++?></td>
            <td><?php echo $r['pelanggan']?></td>
            <td><?php echo $r['tglorder']?></td>
            <td>Rp.<?php echo $r['total']?></td>
            <td>Rp.<?php echo $r['bayar']?></td>
            <td>Rp.<?php echo $r['kembali']?></td>
        </tr>
        <?php endforeach?>
        <?php }?>
  </tbody>
</table>

<?php
       for ($i=1; $i <= $halaman ; $i++) { 
       echo '<a href="?f=Order&m=select&p='.$i.$id.'">'.$i.'</a>';
     echo '&nbsp&nbsp&nbsp';
       }?>