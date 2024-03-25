<?php
require_once (__DIR__ . "/entities/nhanvien.class.php");
require_once (__DIR__ . "/entities/phongban.class.php");
require_once (__DIR__ . "/entities/user.class.php");
User::auth();

if (isset ($_POST["btnsubmit"])) {
    $ma_nv = $_POST["txtMaNv"];
    $ten_nv = $_POST["txtTenNV"];
    $phai = $_POST["txtPhai"];
    $noi_sinh = $_POST["txtNoiSinh"];
    $ma_phong = $_POST["txtMaPhong"];
    $luong = $_POST["txtLuong"];
    $result = NhanVien::update($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);
    if (!$result) {
        header("location: list_nhanvien.php?message=Da co loi xay ra");
    } else {
        header("location: add_nhanvien.php?message=Da sua thong tin thanh cong!");
    }
}

$ma_nv = $_GET['ma_nv'];
$nhanvien = NhanVien::find_nv_from_ma_nv($ma_nv);
if (!$nhanvien) {
    header('location:list_nhanvien.php');
}
?>

<?php include_once ("header.php"); ?>

<?php include_once ("nav.php"); ?>

<?php
if (isset ($_GET["inserted"])) {
    echo "<h2>Sua nhan vien thanh cong!</h2>";
}
?>

<form method="post">
    <div class="row">
        <div class="lbltitle">
            <label>Ma Nhan Vien</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtMaNv" value="<?php echo $nhanvien['Ma_NV']; ?>" disabled></input>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Ten Nhan Vien</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtTenNV" value="<?php echo $nhanvien['Ten_NV']; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Gioi tinh</label>
        </div>
        <div class="lblinput">
            <select id="txtPhai" name="txtPhai">
                <option value="NAM" <?php echo $nhanvien['Ma_NV'] == "NAM" ? "selected" : ""; ?>>Nam</option>
                <option <?php echo $nhanvien['Ma_NV'] == "NU" ? "selected" : ""; ?> value="NU">Nu</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Noi sinh</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtNoiSinh" value="<?php echo $nhanvien['Noi_Sinh']; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Phong Ban</label>
        </div>
        <div class="lblinput">
            <select id="txtMaPhong" name="txtMaPhong">
                <?php
                $cates = PhongBan::list();

                foreach ($cates as $item) {
                    $option =
                        '<option value="' . $item["Ma_Phong"];
                    if ($nhanvien["Ma_Phong"] == $item["Ma_Phong"]) {
                        $option .= " selected ";
                    }
                    $option .= '">' . $item["Ten_Phong"];
                    $option .= "</option>";
                    echo $option;
                }
                ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Luong</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtLuong" value="<?php echo $nhanvien['Luong']; ?>" />
        </div>
    </div>
    <div class="row">
        <div class="submit">
            <input type="submit" name="btnsubmit" value="Sua nhan vien" />
        </div>
    </div>
</form>

<?php include_once ("footer.php"); ?>
