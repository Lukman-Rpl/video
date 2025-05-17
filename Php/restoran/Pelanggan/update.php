<?php
if (isset($_GET['id'])) {

    $id=$_GET['id'];
    
    $row=$db->getALL("SELECT * FROM tblpelanggan ORDER BY kategori ASC");

    if ($r['aktif']==1) {
        $status = 'AKTIF';
     }else {
        $status='TIDAK AKTIF';
     }
    
    }
    $sql="SELECT * FROM tblpelanggan WHERE idpelanggan=$id";
    $db=$db->runSQL($sql);

    header('location:?f=Pelanggan&m=select');
?>