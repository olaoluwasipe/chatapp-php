<?php include_once("includes/header.php") ?>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img src="<?php echo $userimg ? 'functions/images/'.$userimg : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png'; ?>" alt="Profile image">
                    <div class="details">
                        <span><?php echo $username; ?></span>
                        <p><?php echo ucwords($status); ?></p>
                    </div>
                </div>
                <a href="" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select a user to start chatting</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                
            </div>
        </section>
    </div>

    <script src="js/users.js"></script>
</body>
</html>