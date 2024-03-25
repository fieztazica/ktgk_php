<?php
require_once (__DIR__ . "/../config/db.class.php");

class PhongBan
{
    public $Ma_Phong;
    public $Ten_Phong;

    public function __construct($ma_Phong, $ten_Phong)
    {
        $this->Ma_Phong = $ma_Phong;
        $this->Ten_Phong = $ten_Phong;
    }

    public function save()
    {
        $db = new Db();
        $sql = "INSERT INTO PhongBan (Ma_Phong, Ten_Phong) VALUES( '$this->Ma_Phong' , '$this->Ten_Phong' )";

        $result = $db->query_execute($sql);
        return $result;
    }
    public static function list()
    {
        $db = new Db();
        $sql = "SELECT * FROM PhongBan";
        $result = $db->select_to_array($sql);
        return $result;
    }
}
