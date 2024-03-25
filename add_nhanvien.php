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

    $newNhanVien = new NhanVien($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong);
    $result = $newNhanVien->save();
    if (!$result) {
        header("location: add_nhanvien.php?failure");
    } else {
        header("location: add_nhanvien.php?inserted");
    }
}
?>

<?php include_once ("header.php"); ?>

<?php include_once ("nav.php"); ?>

<?php
if (isset ($_GET["inserted"])) {
    echo "<h2>Them nhan vien thanh cong!</h2>";
}
?>

<form method="post">
    <div class="row">
        <div class="lbltitle">
            <label>Ma Nhan Vien</label>
        </div>
        <div class="lblinput">
            <input name="txtMaNv" type='text'
                value="<?php echo isset ($_POST["txtMaNv"]) ? $_POST["txtMaNv"] : ""; ?>"></input>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Ten Nhan Vien</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtTenNV"
                value="<?php echo isset ($_POST["txtTenNV"]) ? $_POST["txtTenNV"] : "" ?>" />
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Phai</label>
        </div>
        <div class="lblinput">
            <select id="txtPhai" name="txtPhai">
                <option value="NAM" <?php echo isset ($_POST["txtPhai"]) ? "selected" : "" ?>>Nam</option>
                <option <?php echo isset ($_POST["txtPhai"]) ? "selected" : "" ?> value="NU">Nu</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="lbltitle">
            <label>Noi sinh</label>
        </div>
        <div class="lblinput">
            <input type="text" name="txtNoiSinh"
                value="<?php echo isset ($_POST["txtNoiSinh"]) ? $_POST["txtNoiSinh"] : "" ?>" />
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
                    echo '<option value="' . $item["Ma_Phong"] . '">' . $item["Ten_Phong"] . "</option>";
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
            <input type="text" name="txtLuong"
                value="<?php echo isset ($_POST["txtLuong"]) ? $_POST["txtLuong"] : "" ?>" />
        </div>
    </div>
    <div class="row">
        <div class="submit">
            <input type="submit" name="btnsubmit" value="Thêm nhan vien" />
        </div>
    </div>
</form>

<?php include_once ("footer.php"); ?>
