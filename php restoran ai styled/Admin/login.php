<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once("../dbcontroller.php");
$db = new DB;

$error_message = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);

    $conn = $db->koneksiDB();

    $stmt = $conn->prepare("SELECT * FROM tbluser WHERE email = ? AND password = ? AND aktif = 1");
    if ($stmt) {
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $error_message = "Email atau password salah, atau akun belum aktif!";
        } else {
            $row = $result->fetch_assoc();

            $_SESSION['user'] = $row['email'];
            $_SESSION['level'] = $row['level'];
            $_SESSION['iduser'] = $row['iduser'];

            header("Location: index.php");
            exit;
        }

        $stmt->close();
    } else {
        $error_message = "Error pada query login.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Admin Restoran</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-4 mx-auto mt-4">
            <h3>Login Restoran</h3>
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" required class="form-control" />
                </div>
                <div class="form-group mb-3">
                    <label>Password</label>
                    <input type="password" name="password" required class="form-control" />
                </div>
                <div>
                    <input type="submit" name="login" value="Login" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
