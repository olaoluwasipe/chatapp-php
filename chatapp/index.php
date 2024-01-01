<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat App</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>
                Realtime Chat App
            </header>
            <form action="#">
                <div class="error-txt">This is an error message!</div>
                <div class="name-details">
                    <div class="field input">
                        <label for="">First Name</label>
                        <input type="text" name="fname" required placeholder="First Name">
                    </div>
                    <div class="field input">
                        <label for="">Last Name</label>
                        <input type="text" name="lname" required placeholder="Last Name">
                    </div>
                </div>
                <div class="field input">
                    <label for="">Email Address</label>
                    <input type="email" name="email" required placeholder="Enter Your Email Address">
                </div>
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" required placeholder="Enter New Password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label for="">Select Image</label>
                    <input type="file" required name="image">
                </div>
                <div class="field btn">
                    <input type="button" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Already signed up? <a href="login.html">Login now</a></div>

            <script src="js/pass-show-hide.js" defer></script>
            <script src="js/sigin.js" defer></script>
        </section>
    </div>
</body>
</html>