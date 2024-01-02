<?php
session_start();
if(isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['receiver']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if(!empty($message)) {
        $insertmessage = $conn->query("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES ('$incoming_id', '$outgoing_id', '$message')") or die(mysqli_error($conn));
    }
} else {
    header("Location: ../login.php");
}

?>