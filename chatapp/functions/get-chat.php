<?php 
    session_start();
    if(isset($_SESSION['unique_id'])) {
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['receiver']);
        $output = "";

        $messages = $conn->query("SELECT * FROM messages
                    LEFT JOIN users ON users.unique_id = messages.incoming_msg_id
                    WHERE (outgoing_msg_id = '$outgoing_id' AND incoming_msg_id = '$incoming_id') 
                    OR (outgoing_msg_id = '$incoming_id' AND incoming_msg_id = '$outgoing_id') ORDER BY msg_id ASC");
        if(mysqli_num_rows($messages) > 0) {
            while($row = mysqli_fetch_assoc($messages)) {
                $img = !empty($row['attachment']) ? '<a download="'.$row['attachment'].'" href="functions/images/'.$row['attachment'].'" title="ImageName">
                                                        <img class="attachment" src="functions/images/'.$row['attachment'].'" alt="attached-image">
                                                    </a>' : '';
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                    <div class="details">
                                        '.$img.'
                                        <p>'.$row['msg'].'</p>
                                    </div>
                                </div>';
                } else {
                    $output .= '<div class="chat incoming">
                                    <img src="'. ($row['img'] ? 'functions/images/'.$row['img'] : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png') .'" alt="profile-pic">
                                    <div class="details">
                                        '.$img.'
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