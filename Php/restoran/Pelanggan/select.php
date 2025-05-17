<?php

$jumlahdata=$db->rowCOUNT("SELECT idpelanggan FROM tblpelanggan $where");

$banyak=3;

$halaman=ceil($jumlahdata/$banyak);

if (isset ($_GET['p'])) {
    $p=$_GET['p'];
    $mulai=($p*$banyak)-$banyak;

}
else {
    $mulai=0;
}

$sql="SELECT * FROM tblpelanggan ORDER BY status,idorder ASC LIMIT $mulai,$banyak";
$row=$db->getALL($sql);

$no=1+$mulai;
?>
<h3>Pelanggan</h3>
<table class="table table-ordered w-70">
  <thead>
    <tr>
        <td>No</td>
        <td>Pelanggan</td>
        <td>ALamat</td>
        <td>Telepon</td>
        <td>Email</td>
        <td>Status</td>
        <td>Status</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($row as $r) :
     if ($r['aktif']==1) {
        $status = 'AKTIF';
     }else {
        $status='TIDAK AKTIF';
     }
        ?>
        <tr>
            <td><?php echo $no++?></td>
            <td><?php echo $r['pelanggan']?></td>
            <td><?php echo $r['alamat']?></td>
            <td><?php echo $r['telp']?></td>
            <td><a href="?f=Pelanggan&m=delete&id=<?php echo $r['idpelanggan']?>">DELETE</a> </td>
            <td><a href="?f=Pelanggan&m=update&id=<?php echo $r['idpelanggan']?>"><?php echo $status?></a> </td>
        </tr>
        <?php endforeach?>
  </tbody>
</table>

<?php
       for ($i=1; $i <= $halaman ; $i++) { 
       echo '<a href="?f=Pelanggan&m=select&p='.$i.$id.'">'.$i.'</a>';
     echo '&nbsp&nbsp&nbsp';
       }?>