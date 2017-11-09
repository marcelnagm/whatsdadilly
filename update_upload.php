<?php

require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
// Set the upload folder path
$target_path = "uploads/";
//$target_path = $target_path . basename( $_FILES['myfile']['name']);
$nam = uniqid();
$extension = end(explode('.', $_FILES['myfile']['name']));
$image_name = $nam . '.' . $extension;
$path = $target_path . $image_name;
if (move_uploaded_file($_FILES['myfile']['tmp_name'], $path)) {
    echo $path;
    $session = new Session();
        $data = array("image" => $image_name,
            "sign_uid" => $session->getSession("userid")
        );

        $result = Signup::signup3($data, $entityManager);
        $session->setSession("profile_pic", $image_name);
    } else {
        echo "default.jpg";
    }
?>