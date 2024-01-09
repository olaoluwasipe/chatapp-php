<?php include_once("includes/header.php") ?>
    <div class="wrapper">
        <?php
        if(!empty($_GET['user_id'])) {
            $uns = $_GET['user_id'];
            $getuserinfo = $conn->query("SELECT * FROM users WHERE unique_id = '$uns'");
            if(mysqli_num_rows($getuserinfo) > 0) {
                $row = mysqli_fetch_assoc($getuserinfo);
                $nusername = $row['fname'] . ' ' . $row['lname'];
                $nstatus = $row['status'];
                $nuimg = $row['img'];
            }else {
                header("Location: users.php");
            }
        }else{
            header("Location: users.php");
        }
        ?>
        <section class="chat-area">
            <header>
                <a href="users.php" class="backBtn"><i class="fas fa-arrow-left"></i></a>
                <img src="<?php echo $nuimg ? 'functions/images/'.$nuimg : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'; ?>" alt="Profile image">
                <div class="details">
                    <span><?php echo $nusername; ?></span>
                    <p><?php echo ucwords($nstatus); ?></p>
                </div>
            </header>
            <div class="chat-box">
                
            </div>
            <form action="#" class="typing-area">
                <input type="hidden" name="user_id" value="<?php echo $unq; ?>">
                <input type="hidden" name="receiver" value="<?php echo $uns; ?>">
                <input type="file" style="display: none;" name="attachment" id="attachedFile">
                <input type="text" class="input-field" name="message" placeholder="Type a message here...">
                <button id="attachBtn"><ion-icon name="attach-outline"></ion-icon></button>
                <button id="sendBtn"><i class="fab fa-telegram-plane"></i></button>
            </form>
            <div class="attach">
                <div class="img-box">
                    <img src="https://cpworldgroup.com/wp-content/uploads/2021/01/placeholder.png" alt="attached-image">
                </div>
            </div>
        </section>
    </div>


    <script src="js/chat.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>