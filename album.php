<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
include_once("config.php");
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';
$session = new Session();
$img_p = $session->getSession("profile_pic");
unset($_SESSION['id_album']);
unset($_SESSION['send_photos']);
    $other = false;
if(isset($_SESSION['profileid']) && $_SESSION['profileid'] != '' && $_SESSION['profileid'] != $_SESSION['userid']){
    $other = true;
    $params = array('id_owner' => $_SESSION['profileid']);
} else $params = array('id_owner' => $_SESSION['userid']);
include 'html/albums.php';
