<?php
session_start();
require_once("../dbcontroller.php");
$db=new DB;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
         <div class="col-4 mx-auto mt-4 ">
            <div>
                <h3>Login Restoran</h3>
            </div>
            <div class="form-group">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">password</label>
                        <input type="password" name="password" required class="form-control">
                    </div>

                    <div>
                        <input type="submit" name="login" value="login" class="btn btn-primary">
                    </div>
                </form>

            </div>
         </div>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['login'])) {
    $email=$_POST['email'];
    $password=hash('sha256',$_POST['password']);

    $sql="SELECT * FROM tbluser WHERE email=$email AND passwowrd=$password";

    $count=$db->rowCOUNT($sql);


if ($count == 0) {
    echo '<h3 style="text-align:center">email / password salah</h3>';
} else {
    $sql="SELECT * FROM tbluser WHERE email=$email AND passwowrd=$password";
    $count=$db->getITEM($sql);
   
    $_SESSION['user']=$row['email'];
    $_SESSION['level']=$row['level'];
    $_SESSION['iduser']=$row['iduser'];

    header("location:index.php");
}
}
?>