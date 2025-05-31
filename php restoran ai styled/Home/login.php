<?php
// Pindahkan kode PHP ke bagian atas file
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // First query to check if user exists
    $sql = "SELECT * FROM tblpelanggan WHERE email='$email' AND password='$password' AND aktif=1";
    $count = $db->rowCOUNT($sql);

    if ($count == 0) {
        $error = '<h3 style="text-align:center">email / password salah</h3>';
    } else {
        // If user exists, get their data
        $sql = "SELECT * FROM tblpelanggan WHERE email='$email' AND password='$password'";
        $row = $db->getITEM($sql);
        
                        // Periksa apakah $row adalah array dan tidak kosong
        if (is_array($row) && !empty($row)) {
            // Set session jika data valid
            $_SESSION['pelanggan'] = $row['email'];
            $_SESSION['idpelanggan'] = $row['idpelanggan'];
            
            echo "<script>alert('Login Berhasil')</script>";
            echo "<script>window.location.href='index.php';</script>";
            exit; // Penting: hentikan eksekusi script setelah redirect
        } else {
            $error = '<h3 style="text-align:center">Error: Data pengguna tidak ditemukan</h3>';
        }
    }
}
?>

<div class="row">
 <div class="col-4 mx-auto mt-4 ">
        
    <div class="form-group">
        <form action="" method="post">
            <div>
            <h3>Login Pelanggan</h3>
            </div>
            
            <?php if (isset($error)) echo $error; ?>
            
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" required placeholder="Masukkan email" class="form-control">
            </div>

            <div class="form-group">
                <label for="">password</label>
                <input type="password" name="password" required placeholder="Masukkan password" class="form-control">
            </div>

            <div>
                <input type="submit" name="login" value="login" class="btn btn-primary">
            </div>
        </form>
    </div>
 </div>
</div>