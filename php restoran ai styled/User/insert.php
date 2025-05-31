
<h3>Insert User</h3>
<div class="form-group">

<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Nama USER</label>
     <input type="text" name="user" require placeholder="ISI USER" class="form-control">
    </div>
<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Email</label>
     <input type="email" name="email" require placeholder="ISI EMAIL" class="form-control">
    </div>
<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Password</label>
     <input type="password" name="password" require placeholder="ISI PASSWORD" class="form-control">
    </div>
<form action="" method="post">
    <div class="form-group w-50">
     <label for="">Konfrimasi Password</label>
     <input type="password" name="konfirmasi" require placeholder="MASUKKAN PASSWORD LAGI" class="form-control">
    </div>
    <div class="form-group w-50">
        <label for="">Level</label><br>
        <select name="level" id="">
            <option value="admin">Admin</option>
            <option value="koki">Koki</option>
            <option value="kasir">Kasir</option>
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
    $password=hash('p123',$_POST['password']);
    $konfirmasi=hash('p123',$_POST['konfrimasi']);
    $level=$_POST['level'];

    if ($password == $konfirmasi) {
        $sql="INSERT INTO tbluser VALUES ('',$user,$email,$password,$level,1)";
        $db->runSQL($sql);
        header('location:?f=User&m=select');
    }else{
       echo '<h2>Password tidak sama</h2>';
    }
}

?>