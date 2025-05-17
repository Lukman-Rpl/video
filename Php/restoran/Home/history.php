<?php
$email = $_SESSION['pelanggan'];
$jumlahdata=$db->rowCOUNT("SELECT idorder FROM tblorder WHERE email='$email'");

$banyak=2;

$halaman=ceil($jumlahdata/$banyak);

if (isset($_GET['p'])) {
    $p=$_GET['p'];
    $mulai=($p * $banyak) -$banyak;
}else{
    $mulai=0;
}

$sql="SELECT * FROM tblorder WHERE email='$email' ORDER BY tglorder DESC LIMIT $mulai,$banyak";
$row=$db->getALL($sql);

$no= 1+$mulai;
?>
<h3>history</h3>

<h3>detail pembelian</h3>
<table class="table table-bordered w-50 ">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Order</th>
            <th>Detail</th>
            <th>Total</th>
        </tr>
    </thead>
     <tbody>
        <?php if (!empty($row)); {?>
            <?php foreach($row as $r) :?>
            <tr>
               <td><?php echo $no++?></td>
               <td><?php echo $r['tglorder']?></td>
               <td><?php echo $r['total']?></td>
               <td><a href="?f=Home&m=detail&id=<?php echo $r['idorder'];?>">Detail</a></td>
            </tr>
            <?php endforeach ?>
            <?php } ?>
            </tbody>
</table>

<?php
for ($i=1; $i <= $halaman ; $i++) { 
    echo '<a href="?f=Home&m=history&p='.$i.'">'.$i.'</a>';
    echo '&nbsp&nbsp&nbsp';
}
?>