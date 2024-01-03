<?php 
while($row = mysqli_fetch_assoc($getusers)) {
    $userimg = $row['img'];
    $username = $row['fname'] . " " . $row['lname'];
    $status = $row['status'];
    $lastmessage = "SELECT * FROM messages WHERE (incoming_msg_id = '{$row['unique_id']}' OR outgoing_msg_id = '{$row['unique_id']}') AND (outgoing_msg_id = '{$unique_id}' OR incoming_msg_id = '{$unique_id}') ORDER BY msg_id DESC LIMIT 1";
    $query = $conn->query($lastmessage);
    $roww = mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query) > 0) {
        $result = $roww['msg'];
    } else {
        $result = "No message available";
    }

    // Trimming messages if the characters are more than 26 
    (strlen($result) > 26 ) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
    // Adding a You: text before messages belonging to the current users
    if($result !== "No message available")
    {
        ($unique_id == $roww['outgoing_msg_id']) ? $you = 'You: ' : $you = "";
    }else{
        $you = "";
    }
    // Check if users are offline or online.
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";

    $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                    <div class="content">
                        <img src="'. ($userimg ? 'functions/images/'.$userimg : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png') .'" alt="profile-pic">
                        <div class="details">
                            <span>'.$username.'</span>
                            <p>'.$you.$msg.'</p>
                        </div>
                    </div>
                    <div class="status-dot '.($status == "Active now" ? '' : 'offline').'"><i class="fas fa-circle"></i></div>
                </a>';
}

?>