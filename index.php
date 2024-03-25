<?php
require_once (__DIR__ . "/entities/user.class.php");

User::auth();
?>

<?php include_once ("header.php"); ?>

<?php include_once ("nav.php"); ?>

<?php include_once ("footer.php"); ?>
