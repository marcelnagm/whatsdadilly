<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
require_once 'model/Signup.php';
require_once 'classes/Session.class.php';
$session = new Session();
if ($_POST['segment'] === 'basicinfo') {
    $data = array(
        "firstname" => $_POST['firstname'],
        "lastname" => $_POST['lastname'],
        "current_city_id" => $_POST['current_city_id'],
        "home_city_id" => $_POST['home_city_id'],
        "interested" => $_POST['interested'],
        "relationship" => $_POST['relationship'],
        "politicalview" => $_POST['politicalview'],
        "religion" => $_POST['religion'],
        "language" => $_POST['language'],
        "userid" => $session->getSession("userid")
    );
    $user = Signup::profileEditBasicinfo($data, $entityManager);
    if ($user == 1) {
        $success = array("success" => 1);
    } else {
        $success = array("success" => 0);
    }
    echo json_encode($success);
} else if ($_POST['segment'] === 'aboutyou') {
    $data = array(
        "aboutyou_p" => $_POST['aboutyou_p'],
        "listinterest" => $_POST['list_interest'],
        "userid" => $session->getSession("userid")
    );
    $user = Signup::profileEditAboutyou($data, $entityManager);
    if ($user == 1) {
        $success = array("success" => 1);
    } else {
        $success = array("success" => 0);
    }
    echo json_encode($success);
} else if ($_POST['segment'] === 'contact') {
    $data = array(
        "phonenumber" => $_POST['phonenumber'],
        "userid" => $session->getSession("userid")
    );
    $user = Signup::profileEditContact($data, $entityManager);
    if ($user == 1) {
        $success = array("success" => 1);
    } else {
        $success = array("success" => 0);
    }
    echo json_encode($success);
}else if ($_POST['segment'] === 'work') {
    $data = array(
        "work" => $_POST['work'],
        "education" => $_POST['education'],
        "userid" => $session->getSession("userid")
    );
    $user = Signup::profileEditwork($data, $entityManager);
    if ($user == 1) {
        $success = array("success" => 1);
    } else {
        $success = array("success" => 0);
    }
    echo json_encode($success);
}else if ($_POST['segment'] === 'cover') {
    $data = array(
        "cover_photo" => $_POST['cover_ph'],
        "userid" => $session->getSession("userid")
    );
    $user = Signup::profileEditcover($data, $entityManager);
    if ($user == 1) {
        $success = array("success" => 1);
    } else {
        $success = array("success" => 0);
    }
    echo json_encode($success);
}
?>
