<?php 
    session_start();
    if(isset($_SESSION['unique_id'])) {
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['receiver']);
        $nus = $conn->query("SELECT * FROM users WHERE unique_id='$incoming_id'");
        if(mysqli_num_rows($nus) > 0) {
            $row = mysqli_fetch_assoc($nus);
            $nuimg = $row['img'];
        }
        $output = "";

        $messages = $conn->query("SELECT * FROM messages WHERE (outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = '$incoming_id') 
                    OR (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = '$outgoing_id') ORDER BY msg_id ASC");
        if(mysqli_num_rows($messages) > 0) {
            while($row = mysqli_fetch_assoc($messages)) {
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';
                } else {
                    $output .= '<div class="chat incoming">
                                    <img src="'. ($nuimg ? 'functions/images/'.$nuimg : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png') .'" alt="profile-pic">
                                    <div class="details">
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';
                }
            }
        }

    } else {
        header("Location: ../login.php");
    }

    echo $output;
?>