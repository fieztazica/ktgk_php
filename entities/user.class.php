<?php
require_once (__DIR__ . "/../config/db.class.php");

class User
{
    public $Id;
    public $Username;
    public $Password;
    public $Fullname;
    public $Email;
    public $Role;

    public function __construct()
    {
    }

    public static function get_user($username, $password)
    {
        $db = new Db();
        $sql = "SELECT * FROM User WHERE username = '$username' AND password = '$password'";
        $result = $db->select_to_array($sql);
        if (count($result) > 0) {
            return $result[0];
        } else
            return null;
    }

    public static function login($username, $password)
    {
        $db = new Db();
        $sql = "SELECT * FROM User WHERE username = '$username' AND password = '$password'";
        $result = $db->select_to_array($sql);
        return count($result) == 1;
    }

    public static function auth($redirect = null)
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $userName = $_SESSION['userName'];
        $password = $_SESSION['password'];
        $role = $_SESSION['role'];
        $login_url = 'login.php';
        if (!$userName || !$password || !$role) {
            header('Location: ' . $login_url);
        }
        if ($redirect != null) {
            header('Location: ' . $redirect);
        }
    }

    public static function isAdmin(): bool
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        $userName = $_SESSION['userName'];
        $password = $_SESSION['password'];
        $role = $_SESSION['role'];
        if (!$role) {
            $user = User::get_user($userName, $password);
            $role = $user["role"];
        }
        return $role == 'admin';
    }
}
