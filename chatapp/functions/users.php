<?php
session_start();
require_once("config.php");
$unique_id = $_SESSION['unique_id'];
$getusers = $conn->query("SELECT * FROM users WHERE NOT unique_id = '$unique_id'");
$output = "";
if(mysqli_num_rows($getusers) == 0) {
    $output .= "No users are available to chat";
}elseif(mysqli_num_rows($getusers) > 0) {
    include_once('user.php');
}

echo $output;

?>