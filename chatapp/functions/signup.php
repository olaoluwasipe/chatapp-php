<?php 
require_once("config.php");

function cleanString(array $posts, $conn) {
    return array_map(function($post) use ($conn) {
        return mysqli_real_escape_string($conn, $post);
    }, $posts);
}

function validateRequest(array $posts) {
    $errors = array_reduce(array_keys($posts), function($carry, $key) use ($posts) {
        if ($key === 'email') {
            if (!filter_var($posts[$key], FILTER_VALIDATE_EMAIL)) {
                $carry[] = "Please input a correct email";
            }
        } elseif ($posts[$key] == "" || empty($posts[$key])) {
            $carry[] = "Please fill the " . ucwords($key) . " field";
        }
        return $carry;
    }, []);

    return empty($errors) ? true : ["reason" => $errors[0], "return" => false];
}

echo validateRequest($_POST)['reason'];
if(validateRequest($_POST)['return']){

}
?>