<?php 
while($row = mysqli_fetch_assoc($getusers)) {
    $userimg = $row['img'];
    $username = $row['fname'] . " " . $row['lname'];
    $status = $row['status'];
    $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
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

?>