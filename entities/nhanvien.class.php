<?php
require_once (__DIR__ . "/../config/db.class.php");

class NhanVien
{
    public $Ma_NV;
    public $Ten_NV;
    public $Phai;
    public $Noi_Sinh;
    public $Ma_Phong;
    public $Luong;

    public function __construct($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)
    {
        $this->Ma_NV = $ma_nv;
        $this->Ten_NV = $ten_nv;
        $this->Phai = $phai;
        $this->Noi_Sinh = $noi_sinh;
        $this->Ma_Phong = $ma_phong;
        $this->Luong = $luong;
    }



    public static function extract($input)
    {
        $user = new NhanVien($input['Ma_NV'], $input['Ten_NV'], $input['Phai'], $input['Noi_Sinh'], $input['Ma_Phong'], $input['Luong']);
        return $user;
    }

    public static function find_nv_from_ma_nv($ma_nv)
    {
        $db = new Db();
        $sql = "SELECT * FROM nhanvien INNER JOIN phongban ON nhanvien.Ma_Phong = phongban.Ma_Phong WHERE Ma_NV = '$ma_nv'";
        $result = $db->select_to_array($sql);
        if (count($result) > 0) {
            return $result[0];
        } else
            return null;
    }

    public function save()
    {
        $db = new Db();
        $sql = "INSERT INTO nhanvien (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) VALUES( '$this->Ma_NV' , '$this->Ten_NV' ,
        '$this->Phai' ,
       '$this->Noi_Sinh',
        '$this->Ma_Phong' ,
       '$this->Luong' )";

        $result = $db->query_execute($sql);
        return $result;
    }
    public static function update($ma_nv, $ten_nv, $phai, $noi_sinh, $ma_phong, $luong)
    {
        $db = new Db();
        $sql = "UPDATE nhanvien SET Ten_NV='$ten_nv', Phai='$phai', Noi_Sinh='$noi_sinh', Ma_Phong='$ma_phong', Luong='$luong' WHERE Ma_NV='$ma_nv'";
        return $db->query_execute($sql);
    }
    public static function delete($ma_nv)
    {
        $db = new Db();
        $sql = "DELETE FROM nhanvien WHERE Ma_NV='$ma_nv'";
        return $db->query_execute($sql);
    }
    public static function list()
    {
        $db = new Db();
        $sql = "SELECT * FROM nhanvien INNER JOIN phongban ON nhanvien.Ma_Phong = phongban.Ma_Phong";
        $result = $db->select_to_array($sql);
        return $result;
    }

    public static function list_phongban()
    {
        $db = new Db();
        $sql = "SELECT * FROM phongban";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
