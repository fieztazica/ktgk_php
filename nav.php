<?php
require_once (__DIR__ . "/entities/user.class.php");
?>

<ul class="menu">
    <li>
        <a href="/ktgk">Home</a>
    </li>
    <li>
        <a href="/ktgk/list_nhanvien.php">Danh sach nhan vien</a>
    </li>
    <?php
    if (User::isAdmin()) {
        echo "<li>
            <a href=\"/ktgk/add_nhanvien.php\">Them nhan vien</a>
        </li>";
    }
    ?>
    <li>
        <a href="/ktgk/logout.php">Logout</a>
    </li>
</ul>
