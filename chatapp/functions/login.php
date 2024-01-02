<?php
session_start();
require_once("config.php");
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($email) && !empty($password)) {
    $checkuser = $conn->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    if(mysqli_num_rows($checkuser) > 0){
        $row = mysqli_fetch_assoc($checkuser);
        
        $status = "Active now";
        $que = $conn->query("UPDATE users SET status = '{$status}' WHERE unique_id = '{$row['unique_id']}'");
        if($que) {
            $_SESSION['unique_id'] = $row['unique_id'];
            echo "Success";
        }
    }else {
        echo "This user doesn't exist, please sign up";
    }
} else {
    echo "All fields are required!";
}

?>