<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="text-primary">Registrasi Pelanggan</h3>
                        <p class="text-muted">Silakan lengkapi data diri Anda</p>
                    </div>
                    <div class="form-group">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="pelanggan" class="form-label">Nama Pelanggan</label>
                                        <input type="text" name="pelanggan" id="pelanggan" required placeholder="Isi Nama Pelanggan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="telp" class="form-label">No. Telp</label>
                                        <input type="text" name="telp" id="telp" required placeholder="Isi Nomor Telepon" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" required placeholder="Isi Alamat" class="form-control">
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" required placeholder="Masukkan Email" class="form-control">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" required placeholder="Masukkan Password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="konfirmasi" class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="konfirmasi" id="konfirmasi" required placeholder="Masukkan Password Kembali" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <input type="submit" name="simpan" value="simpan" class="btn btn-primary btn-lg">
                            </div>
                            
                            <div class="text-center mt-3">
                                <p>Sudah punya akun? <a href="?f=Home&m=login">Login Sekarang</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if (isset($_POST['simpan'])) {
    $pelanggan=$_POST['pelanggan'];
    $alamat=$_POST['alamat'];
    $telp=$_POST['telp'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $konfirmasi=$_POST['konfirmasi'];

    if ($password === $konfirmasi) {
        // Specify the column names explicitly and skip idpelanggan if it's auto-increment
        $sql="INSERT INTO tblpelanggan (pelanggan, alamat, telp, email, password, aktif) 
        VALUES ('$pelanggan', '$alamat', '$telp', '$email', '$password', 1)";
        $db->runSQL($sql);
        echo "<script>window.location.href='?f=Home&m=info';</script>";
    } else {
       echo '<h2>Password tidak sama</h2>';
    }
}
?>