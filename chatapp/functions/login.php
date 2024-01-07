<?php
session_start();
require_once("config.php");
require_once "../Classes/Auth.php";

$auth = new Auth($conn);
$login = $auth->login($_POST);

echo $login;

?>