<?php
session_start();
require_once("config.php");
$unique_id = $_SESSION['unique_id'];
$getusers = $conn->query("SELECT * FROM users WHERE unique_id='$unique_id'");
$output = "";
if(mysqli_num_rows($getusers) == 0) {
    $output .= "No users are available to chat";
}elseif(mysqli_num_rows($getusers) > 0) {
    while($row = mysqli_fetch_assoc($getusers)) {
        $userimg = $row['img'];
        $username = $row['fname'] . " " . $row['lname'];
        $status = $row['status'];
        $output .= '<a href="#">
                        <div class="content">
                            <img src="'. ($userimg ? 'functions/images/'.$userimg : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png') .'" alt="profile-pic">
                            <div class="details">
                                <span>'.$username.'</span>
                                <p>This is a test message</p>
                            </div>
                        </div>
                        <div class="status-dot '.($status == "Active now" ? '' : 'offline').'"><i class="fas fa-circle"></i></div>
                    </a>';
    }
}

echo $output;

?>