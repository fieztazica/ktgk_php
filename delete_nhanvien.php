<?php
require_once (__DIR__ . "/entities/nhanvien.class.php");
require_once (__DIR__ . "/entities/user.class.php");
User::auth();

$ma_nv = $_GET['ma_nv'];
if (NhanVien::delete($ma_nv) === TRUE) {
    header("Location: list_nhanvien.php");
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}
