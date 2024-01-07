<?php 
session_start();
require_once "../Classes/Auth.php";
$auth = new Auth($conn);
$logout = $auth->login($_GET);

echo $logout;

?>