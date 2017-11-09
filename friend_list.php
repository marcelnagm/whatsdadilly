<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
include_once("config.php");
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';
require_once 'model/Friends.php';
require_once 'entities/Friend.php';
require_once 'model/Signup.php';
$session = new Session();



if($_SESSION['profileid']!= $_SESSION['userid']){
     $userid= $session->getSession("profileid");
}else $userid= $session->getSession("userid");
$img_p = $session->getSession("profile_pic");
$messages = new Friends();

 $data = array(
            "userid" => $userid
        );
 $user_det = Signup::profileView($data, $entityManager);
    if (count($user_det) != 0) {
        if ($user_det[0]['cover_photo'] != '') {
            $cover_photo = $user_det[0]['cover_photo'];
        } else {
            $cover_photo = 'images/banner.jpg';
        }
    }



include 'html/friend_list.php';
