<?php
if (isset($_GET['id'])) {

    $id=$_GET['id'];
    
    $row=$db->getALL("SELECT * FROM tbluser WHERE iduser=$id ");

    if ($r['aktif']==1) {
        $aktif =1;
     }else {
        $aktif=0;
     }
    
    }
    $sql="UPDATE tbluser SET aktif=$aktif WHERE iduser=$id";
    $db=$db->runSQL($sql);

    header('location:?f=user&m=select');
?> 