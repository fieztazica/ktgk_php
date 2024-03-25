<!DOCTYPE html>
<?php
require_once (__DIR__ . "/entities/user.class.php");
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h1>Đăng nhập</h1>
        <div>
            <label>Tài khoản: </label>
            <input type="text" name="userName" id="userName" value="<?php echo isset($_SESSION['userName']) ? $_SESSION['userName'] : ''; ?>"><br><br>
        </div>
        <div>
            <label>Mật khẩu: </label>
            <input type="password" name="password" id="password" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>"><br><br>
        </div>
        <input type="submit" value="Đăng nhập" />
        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['userName']) && isset($_POST['password'])) {
            $userName = $_POST['userName'];
            $password = $_POST['password'];

            $user = User::get_user($userName, $password);

            if ($user != null) {
                $_SESSION['userName'] = $user["username"];
                $_SESSION['password'] = $user["password"];
                $_SESSION['fullName'] = $user["fullname"];
                $_SESSION['role'] = $user["role"];

                $url = "list_nhanvien.php";
                header('Location: ' . $url);
                die();
            } else {
                echo "Sai username/password. Kiểm tra lại!";
            }
        }
        ?>

    </form>
</body>
</html>
