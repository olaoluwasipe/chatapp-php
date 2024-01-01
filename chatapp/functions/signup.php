<?php 
session_start();
require_once("config.php");

// function cleanString(array $posts, $conn) {
//     return array_map(function($post) use ($conn) {
//         return mysqli_real_escape_string($conn, $post);
//     }, $posts);
// }

// function validateRequest(array $posts) {
//     $errors = array_reduce(array_keys($posts), function($carry, $key) use ($posts) {
//         if ($key === 'email') {
//             if (!filter_var($posts[$key], FILTER_VALIDATE_EMAIL)) {
//                 $carry[] = "Please input a correct email";
//             }
//         } elseif ($posts[$key] == "" || empty($posts[$key])) {
//             $carry[] = "Please fill the " . ucwords($key) . " field";
//         }
//         return $carry;
//     }, []);

//     return empty($errors) ? true : ["reason" => $errors[0], "return" => false];
// }

// echo validateRequest($_POST)['reason'];
// if(validateRequest($_POST)['return']){

// }

$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $checkemail = $conn->query("SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($checkemail) > 0){
            echo `$email already exists, please login `;
        }else{
            if(isset($_FILES['image'])) {
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode);

                $extensions = ['png', 'jpg', 'jpeg'];
                if(in_array($img_ext, $extensions) === true){
                    $time = time();

                    $newimg_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name, "images/".$newimg_name)){
                        $status = "Active now";
                        $random_id = rand(time(), 100000000);

                        $insertuser = $conn->query("INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ('{$random_id}', '{$fname}', '{$lname}', '{$email}', '{$password}', '{$newimg_name}', '{$status}')");
                        if($insertuser) {
                            $checkuser = $conn->query("SELECT * FROM users WHERE email = '{$email}'");
                            if(mysqli_num_rows($checkuser) > 0) {
                                $row = mysqli_fetch_assoc($checkuser);
                                $_SESSION['unique_id'] = $row['unique_id']; 
                                echo "Success";
                            }
                        } else {
                            echo "Something went wrong";
                        }
                    } else {
                        echo "Please try uploading the image again";
                    }

                } else {
                    echo "You can only upload an image file of jpeg, jpg, png!";
                }
            }else{
                echo "Please select a user image file";
            }
        }
    }else {
        echo $email.' is not an accurate email address';
    }
}else {
    echo "All input fields are required!";
}
?>