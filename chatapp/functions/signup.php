<?php 

require_once "../Classes/Auth.php";

session_start();
require_once("config.php");

$auth = new Auth($conn);
$register = $auth->register($_POST);

echo $register;
?>