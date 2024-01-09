<?php
require_once "../Classes/Auth.php";
session_start();
if(isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $auth = new Auth($conn);
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['receiver']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if(!empty($message)) {
        if (isset($_FILES['attachment'])) {
            $imgName = $_FILES['attachment']['name'];
            $imgType = $_FILES['attachment']['type'];
            $tmpName = $_FILES['attachment']['tmp_name'];

            $newimgName = $auth->uploadImage($imgName, $imgType, $tmpName);

            if($newimgName === 'You can only upload an image file of jpeg, jpg, png!'){
                $newimgName = NULL;
            }

            if ($newimgName !== false) {
                $insertmessage = $conn->query("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, attachment) VALUES ('$incoming_id', '$outgoing_id', '$message', '$newimgName')") or die(mysqli_error($conn));
            } else {
                return 'Please try uploading the image again';
            }
        } else {
            return 'Please select a user image file';
        }
    }
} else {
    header("Location: ../login.php");
}

?>