<?php

if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $sql="SELECT * FROM tbluser WHERE iduser=$id ";   
    $row=$db->getALL($sql);
}
?>
<h3>Update User</h3>
<div class="form-group">

<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Nama USER</label>
     <input type="text" name="user" require placeholder="<?php echo $r['user']?>" class="form-control">
    </div>
<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Email</label>
     <input type="email" name="email" require placeholder="<?php echo $r['email']?>" class="form-control">
    </div>
<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Password</label>
     <input type="password" name="password" require placeholder="<?php echo $r['password']?>" class="form-control">
    </div>
<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Konfrimasi Password</label>
     <input type="password" name="konfirmasi" require placeholder="<?php echo $r['password']?>" class="form-control">
    </div>
    <div class="form-group w-50">
        <label for="">Level</label><br>
        <select name="level" id="">
            <option value="admin" <?php ($row['level'] ==="admin") echo "selected" ?>>Admin</option>
            <option value="koki" <?php ($row['level'] ==="koki") echo "selected" ?>>Koki</option>
            <option value="kasir" <?php ($row['level'] ==="kasir") echo "selected" ?>>Kasir</option>
        </select>

    </div>
    <div>
        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
    </div>
</form>
<?php
if (isset($_POST['simpan'])) {
    $user=$_POST['user'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $konfirmasi=$_POST['konfrimasi'];
    $level=$_POST['level'];

    if ($password == $konfirmasi) {
        $sql="UPDATE tbluser SET user='$user',email='$email',password='$password',level='$level' WHERE iduser=$id";
        $db->runSQL($sql);
        header('location:?f=User&m=select');
    }else{
       echo '<h2>Password tidak sama</h2>';
    }
}

?>