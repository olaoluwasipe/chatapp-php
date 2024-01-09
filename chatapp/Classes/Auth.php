<?php

class Auth {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function sanitizeInput($input) {
        return mysqli_real_escape_string($this->conn, $input);
    }

    public function checkExistingEmail($email) {
        $checkemail = $this->conn->query("SELECT email FROM users WHERE email = '{$email}'");
        return mysqli_num_rows($checkemail) > 0;
    }

    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function uploadImage($imgName, $imgType, $tmpName) {
        $img_explode = explode('.', $imgName);
        $imgExt = end($img_explode);

        $extensions = ['png', 'jpg', 'jpeg'];
        if (in_array($imgExt, $extensions) === true) {
            $time = time();
            $newimgName = $time . $imgName;

            if (move_uploaded_file($tmpName, "images/" . $newimgName)) {
                return $newimgName;
            } else {
                return false;
            }
        } else {
            return 'You can only upload an image file of jpeg, jpg, png!';
        }
    }

    public function registerUser($fname, $lname, $email, $password, $newimgName) {
        $status = "Active now";
        $randomId = rand(time(), 100000000);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $insertUser = $this->conn->query("INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES ('{$randomId}', '{$fname}', '{$lname}', '{$email}', '{$password}', '{$newimgName}', '{$status}')");

        if ($insertUser) {
            $checkUser = $this->conn->query("SELECT * FROM users WHERE email = '{$email}'");

            if (mysqli_num_rows($checkUser) > 0) {
                $row = mysqli_fetch_assoc($checkUser);
                $_SESSION['unique_id'] = $row['unique_id'];
                return 'Success';
            }
        } else {
            return 'Something went wrong';
        }
    } 

    public function register($post) {
        $fname = $this->sanitizeInput($post['fname']);
        $lname = $this->sanitizeInput($post['lname']);
        $email = $this->sanitizeInput($post['email']);
        $password = $this->sanitizeInput($post['password']);

        if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
            if ($this->validateEmail($email)) {
                if (!$this->checkExistingEmail($email)) {
                    if (isset($_FILES['image'])) {
                        $imgName = $_FILES['image']['name'];
                        $imgType = $_FILES['image']['type'];
                        $tmpName = $_FILES['image']['tmp_name'];

                        $newimgName = $this->uploadImage($imgName, $imgType, $tmpName);

                        if ($newimgName !== false) {
                            return $this->registerUser($fname, $lname, $email, $password, $newimgName);
                        } else {
                            return 'Please try uploading the image again';
                        }
                    } else {
                        return 'Please select a user image file';
                    }
                } else {
                    return $email . ' already exists, please login';
                }
            } else {
                return $email . ' is not an accurate email address';
            }
        } else {
            return 'All input fields are required!';
        }
    }

    public function login($post) {
        $email = $this->sanitizeInput($post['email']);
        $password = $this->sanitizeInput($post['password']);

        if (!empty($email) && !empty($password)) {
            $checkUser = $this->conn->query("SELECT * FROM users WHERE email = '$email'");
            
            if (mysqli_num_rows($checkUser) > 0) {
                $row = mysqli_fetch_assoc($checkUser);

                if(password_verify($password, $row['password'])) {
                    $status = "Active now";
                    $updateStatus = $this->conn->query("UPDATE users SET status = '{$status}' WHERE unique_id = '{$row['unique_id']}'");
                }

                if ($updateStatus) {
                    $_SESSION['unique_id'] = $row['unique_id'];
                    return 'Success';
                }
            } else {
                return "This user doesn't exist, please sign up";
            }
        } else {
            return "All fields are required!";
        }
    }

    public function logout ($post) {
        session_start();
        if(isset($_SESSION['unique_id'])) {
            require_once "config.php";
            $user_id = $this->sanitizeInput($post['logout_id']);
            if(isset($user_id)) {
                $status = "Offline now";
                $que = $this->conn->query("UPDATE users SET status = '{$status}' WHERE unique_id = '$user_id'");
                if($que) {
                    session_unset();
                    session_destroy();
                    header("Location: ../login.php");
                }
            } else {
                header("location: ../users.php");
            }
        } else {
            header("Location: ../login.php");
        }
    }
}

// Example usage
?>
