<?php

session_start();

require 'functions.php';

if( isset($_COOKIE["key"]) && isset($_COOKIE["key2"]) ) {
    $key = $_COOKIE["key"];
    $key2 = $_COOKIE["key2"];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $key");
    $account = mysqli_fetch_assoc($result);

    if( $key2 === hash("sha256", $account["username"]) ) {
        $_SESSION["login"] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}


if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $check = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    if (mysqli_num_rows($check) === 1) {

        $account = mysqli_fetch_assoc($check);

        if (password_verify($password, $account["password"])) {

            $_SESSION["login"] = true;

            if( isset($_POST["remember"]) ) {
                setcookie("key", $account["id"], time() + 60);
                setcookie("key2", hash("sha256", $account["username"]), time() + 60);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color:red; font-style:italic;">username/password salah</p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username: </label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">password: </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me</label>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>

    <br><br>
    <h3>Belum Punya Akun?</h3>
    <h3><a href="register.php">Registrasi</a></h3>
</body>

</html>