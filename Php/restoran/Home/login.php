
        <div class="row">
         <div class="col-4 mx-auto mt-4 ">
                
            <div class="form-group">
                <form action="" method="post">
                    <div>
                    <h3>Login Pelanggan</h3>
                    </div>
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

        
<?php
if (isset($_POST['login'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="SELECT * FROM tbluser WHERE email=$email AND passwowrd=$password AND aktif=1";

    $count=$db->rowCOUNT($sql);


if ($count == 0) {
    echo '<h3 style="text-align:center">email / password salah</h3>';
} else {
    $sql="SELECT * FROM tblpelanggan WHERE email=$email AND passwowrd=$password";
    $count=$db->getITEM($sql);
   
    $_SESSION['pelanggan']=$row['email'];
    $_SESSION['idpelanggan']=$row['idpelanggan'];

    header("location:index.php");
}
}
?>