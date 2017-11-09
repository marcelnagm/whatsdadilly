<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


require 'bootstrap.php';

require_once 'entities/PhotoComment.php';
require_once 'model/PhotoComments.php';
require_once 'classes/Session.class.php';
$session = new Session();

if ($_POST['func'] == "get_comments") {
    $params = array();
    $params['id_photo'] = $_POST['id_photo'];
    echo PhotoComments::getPhotoComments($entityManager, $params);
}

if ($_POST['func'] == "send_comment") {
    $params = array();
    $params['id_photo'] = $_POST['id_photo'];
    $params['comment'] = $_POST['comment'];
    PhotoComments::addComment($entityManager, $params);
    
    $params = array();
    $params['id_photo'] = $_POST['id_photo'];
    echo PhotoComments::getPhotoComments($entityManager, $params);

    $photo = $entityManager->getRepository('PhotoAlbum')->find($_POST['id_photo']);

    if ($photo->getIdOwner() != $session->getSession('userid')) {

        $user = new \UserRegister();
        $user = $entityManager->getRepository('UserRegister')->find($session->getSession('userid'));
        
        $params = array(
            'id_friend' => '' . $photo->getIdOwner(),
            'id_user' => '' . $session->getSession('userid'),
            'message' => '<div class="notificationimg"><a class="group1" href="photo_detail.php?id='.$photo->getIdPhoto().'"><img class="notificationimg" src="'.$photo->getPath().'"> </a></div>'.  ucfirst($user->getFirstName()).' '.  ucfirst($user->getLastName()).' comment on your    photo - '.$_POST['comment'],
            'type' => '4',
        );
        NotificationModel::addNotification($entityManager, $params);
    
        
        if($photo->getIdWall()==''){
        $text = 'comment on you photo - '.$_POST['comment'];
        $params = array(
                'owner_id' => '' .  $photo->getIdOwner(),
                'author_id' => '' . $session->getSession('userid'),
                'text' => $text,
                'link' => './album_detail.php?id='.$photo->getIdAlbum(),
                'link_photo' => str_replace('.jpg','', $photo->getPath()),
                'date' => date('Y-m-d H:i:s')
            );

           $id=  WallModel::addWallEntry($entityManager, $params);
//           if($photo->getIdWall()==''){
           $photo->setIdWall($id);    
           $entityManager->persist($photo);
           $entityManager->flush();
//           }
        }else{
            $comments = new Comments();
            $comments->setAuthorId($session->getSession('userid'));
            $comments->setPostId($photo->getIdWall());
            $comments->setText($_POST['comment']);
            $comments->setDate( date('Y-m-d H:i:s'));
            $entityManager->persist($comments);
            $entityManager->flush();
        }
           
           
//            $photo = new PhotoAlbum();
        $params = array(
            'comment' => $_POST['comment'],
            'id' => $photo->getIdPhoto()
        );
        if($photo->getIdOwner() !=$session->getSession('userid'))
        SendMail::sendPhotoComment($entityManager,$session->getSession('userid'), $photo->getIdOwner() , $params);
    }
}

if ($_POST['func'] == "delete_comment") {

    $params = array();
    $params['id_comment'] = $_POST['id_comment'];
    $params = PhotoComments::removeComment($entityManager, $params);
    unset($params['comment']);
    echo PhotoComments::getPhotoComments($entityManager, $params);
}
?>
