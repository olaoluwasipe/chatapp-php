<?php 
session_start();
if(isset($_SESSION['unique_id'])) {
    require_once "config.php";
    $user_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
    if(isset($user_id)) {
        $status = "Offline now";
        $que = $conn->query("UPDATE users SET status = '{$status}' WHERE unique_id = '$user_id'");
        if($que) {
            session_unset();
            session_destroy();
            header("Location: ../login.php");
        }
    } else {
        header("location: ../users.php");
    }
} else {
    header("Location: ../login.php");
}

?>