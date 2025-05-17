<?php

$jumlahdata=$db->rowCOUNT('SELECT iduser FROM tbluser');

$banyak=4;

$halaman=ceil($jumlahdata/$banyak);

if (isset ($_GET['p'])) {
    $p=$_GET['p'];
    $mulai=($p*$banyak)-$banyak;

}
else {
    $mulai=0;
}

$sql="SELECT * FROM tbluser ORDER BY user ASC LIMIT $mulai,$banyak";

$row=$db->getALL($sql);

$no=1+$mulai;

?>

<div class="float-left mr-4">
    <a class="btn btn-primary" href="?f=Kategori&m=insert" role="button">Tambah Data</a>
</div>
<h3>Kategori</h3>
<table class="table table-bordered w-50">
<thead>
    <tr>
        <td>No</td>
        <td>User</td>
        <td>Email</td>
        <td>Level</td>
        <td>Delete</td>
        <td>Status</td>
    </tr>
</thead>
<tbody>
    <?php foreach ($row as $r):?>
    <?php if ($r['aktif'===1]) {
        $status="AKTIF";
    }else {
        $status="BANNED";
    }?>
        
    <tr>
        <td><?php echo $no++?></td>
        <td><?php echo $r['user']?></td>
        <td><?php echo $r['email']?></td>
        <td><?php echo $r['level']?></td>
        <td><a href="?f=Kategori&m=delete&id=<?php echo $r['iduser']?>">Delete</a></td>
        <td><a href="?f=Kategori&m=update&id=<?php echo $r['iduser']?>"><?php echo $status; ?></a></td>
    </tr>

    <?php endforeach ?>
</tbody>
</table>

<?php
       for ($i=1; $i <= $halaman ; $i++) { 
       echo '<a href="?f=User&m=select&p='.$i.'">'.$i.'</a>';
     echo '&nbsp&nbsp&nbsp';
       }?>