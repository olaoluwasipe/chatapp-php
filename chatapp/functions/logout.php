<?php 
session_start();
require_once("config.php");
require_once "../Classes/Auth.php";
$auth = new Auth($conn);
$logout = $auth->logout($_GET);

echo $logout;

?>