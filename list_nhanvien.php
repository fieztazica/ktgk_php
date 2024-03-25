<?php
require_once (__DIR__ . "/entities/nhanvien.class.php");
require_once (__DIR__ . "/entities/user.class.php");
User::auth();

include_once ("header.php"); ?>

<?php
if (isset ($_GET["message"])) {
    echo "<h2>" . $_GET["message"] . "</h2>";
}
?>

<?php include_once ("nav.php"); ?>

<table>
    <tr>
        <th>Ma NV</th>
        <th>Ten NV</th>
        <th>Gioi tinh</th>
        <th>Noi sinh</th>
        <th>Ten phong</th>
        <th>Luong</th>
        <?php if (User::isAdmin()) {
            echo "<th></th>";
        } ?>
    </tr>
    <?php
    $list = NhanVien::list();

    foreach ($list as $item) {
        $ma_nv = $item["Ma_NV"];
        $row = "<tr>" .
            "<th>" . $ma_nv . "</th>" .
            "<th>" . $item["Ten_NV"] . "</th>";
        if ($item["Phai"] == "NAM") {
            $row .= "<th>" . "<img src='images/man.png' alt='Man' width='50px'>" . "</th>";
        } else {
            $row .= "<th>" . "<img src='images/woman.png' alt='Woman' width='50px'>" . "</th>";
        }
        $row .=
            "<th>" . $item["Noi_Sinh"] . "</th>" .
            "<th>" . $item["Ten_Phong"] . "</th>" .
            "<th>" . $item["Luong"] . "</th>";
        if (User::isAdmin()) {
            $row = $row . "<th>" . "<a href=\"/ktgk/edit_nhanvien.php?ma_nv=$ma_nv\">Edit</a>" . "<span> </span>" . "<a href=\"/ktgk/delete_nhanvien.php?ma_nv=$ma_nv\"\">Delete</a>" . "</th>";
        }
        $row = $row .
            "</tr>";
        echo $row;
    }
    ?>
</table>
<?php



include_once ("footer.php");
