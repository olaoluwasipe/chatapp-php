<?php session_start(); ?>
<?php include_once("functions/config.php");
if(isset($_SESSION['unique_id'])){
    $unq = $_SESSION['unique_id'];
    $checkuser = $conn->query("SELECT * FROM users WHERE unique_id = '$unq'");
    if(mysqli_num_rows($checkuser) > 0){
        $row = mysqli_fetch_assoc($checkuser);
        $username = $row['fname'] . ' ' . $row['lname'];
        $status = $row['status'];
        $userimg = $row['img'];
    }
}else {
    header("location: login.php");
}

?>

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