<h3>Registrasi Pelanggan</h3>
<div class="form-group">
<form action="" method="post">
                    <div class="form-group w-50">
                        <label for="">Nama Pelanggan</label>
                        <input type="text" name="pelanggan" required placeholder="isi Pelanggan" class="form-control">
                    </div>
                    <div class="form-group w-50">
                        <label for="">Alamat</label>
                        <input type="text" name="alamat" required placeholder="isi Alamat" class="form-control">
                    </div>
                    <div class="form-group w-50">
                        <label for="">No.Telp</label>
                        <input type="text" name="telp" required placeholder="Isi Nomor Anda" class="form-control">
                    </div>
                    <div class="form-group w-50">
                        <label for="">Email</label>
                        <input type="email" name="email" required placeholder="Masukkan Email" class="form-control">
                    </div>
                    <div class="form-group w-50">
                        <label for="">Password</label>
                        <input type="password" name="password" required placeholder="Masukkan Password" class="form-control">
                    </div>
                    <div class="form-group w-50">
                        <label for="">Konfirmasi Password</label>
                        <input type="password" name="password" required placeholder="Masukkan Pasword Kembali" class="form-control">
                    </div>

                    <div>
                        <input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
                    </div>
                </form>

</div>

<?php

if (isset($_POST['simpan'])) {
    $pelanggan=$_POST['pelanggan'];
    $alamat=$_POST['alamat'];
    $telp=$_POST['telp'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $konfirmasi=$_POST['konfirmasi'];

    if ($password == $konfirmasi) {
        $sql="INSERT INTO tblpelanggan VALUES ('',$pelanggan,$alamat,$telp,$email,$password,1)";
        $db->runSQL($sql);
        header('location:?f=Home&m=info');
    }else{
       echo '<h2>Password tidak sama</h2>';
    }
}

?>