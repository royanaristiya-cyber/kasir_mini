<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = md5($_POST['password']);

    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($q) > 0) {
        $_SESSION['login'] = true;
        header("Location: kasir.php");
    } else {
        echo "Login gagal";
    }
}
?>

<form method="post">
    Username <input type="text" name="username"><br>
    Password <input type="password" name="password"><br>
    <button name="login">Login</button>
</form>
