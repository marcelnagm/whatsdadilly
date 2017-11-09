<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once "bootstrap.php";
include_once("config.php");
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';
require_once 'entities/PhotoAlbum.php';
$session = new Session();
$userid = $session->getSession('userid');
$img_p = $session->getSession("profile_pic");
$params= array(
        'id_photo' => $_GET['id']
    );
$photo = new PhotoAlbum();

$photo = AlbumUtil::getPhoto($entityManager, $params);

$session->setSession('photo_open', $photo->getIdPhoto());
    
if($photo->getIdOwner()==$_SESSION['userid']){
    $other = true;    
} else  $other = false;    

include 'html/photo_detail.php';
?>
