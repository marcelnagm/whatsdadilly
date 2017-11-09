    <?php

session_start();
require_once "bootstrap.php";
require_once 'model/Albums.php';
require_once 'model/Wall.php';
require_once 'entities/Album.php';
require_once 'classes/Session.class.php';
require_once 'classes/Albums.class.php';


$session = new Session();

$_SESSION['debug'] = 0;

if ($_POST['func'] == "listPhotos") {
    $params = array(
        'id_album' => $_POST['qtd']
    );


    $friends = Friends::getFriendsList($entityManager, $session->getSession('userid'), 5000);

    $text = '';
    $paths = $session->getSession('send_photos_path');

    $count = 0;
    foreach ($paths as $path) {
        if ($count == 3)
            break;
        $text .= '<div class="notificationimg"><a href="photo_detail.php?id=' . $path['id'] . '"><img src="' . $path['path'] . '" class="notificationimg"></a></div>';
        $count++;
    }
    $text .= 'Posted ' . count($paths) . ' photos';


    $album = $session->getSession('album_title'); //        
    foreach ($friends as $friend) {

        $params = array(
            'id_friend' => $friend['user_id'],
            'id_user' => '' . $session->getSession('userid'),
            'message' => $text . '<a href="album_detail.php?id=' . $_POST['qtd'] . '"><img src="images/camera-image-uplaod.png"> </a> on album ' . $album,
            'type' => '3',
        );
        NotificationModel::addNotification($entityManager, $params);
    }


    $text = 'Posted ' . count($paths) . ' photo';
    if (count($paths) > 1)
        $text.='s';
    if(count($paths)==2){
        var_dump($paths);
        $text.='<div class="mid3wal">
                    <a href="photo_detail.php?id=' . $paths[0]['id'] . '"><img style="width:120px;height120px;" src="' . $paths[0]['path'] . '" ></a>
                </div>                
                <div class="mid3wal">
                    <a href="photo_detail.php?id=' . $paths[1]['id'] . '"><img style="width:120px;height120px;" src="' . $paths[1]['path'] . '" ></a>
                </div> 
                ';
    }
    if(count($paths)>=3){
         $text.='<div class="mid2wal">
                    <a href="photo_detail.php?id=' . $paths[0]['id'] . '>< img  src="' . $paths[1]['path'] . '" ></a>
                </div>
                <div class="mid2wal">
                       <a href="photo_detail.php?id=' . $paths[1]['id'] . '"><img style="max-width:100%; max-height:100%;" src="' . $paths[2]['path'] .'" ></a>
                </div>
                <div class="mid3wal">
                       <a href="photo_detail.php?id=' . $paths[2]['id'].'"><img style="max-width:100%; max-height:100%;" src="' . $paths[2]['path'] .' " ></a>
                </div>
                ';
    }
        
    
    $params = array(
        'owner_id' => '' . $session->getSession('userid'),
        'author_id' => '' . $session->getSession('userid'),
        'text' => $text,
        'link' => './album_detail.php?id=' . $_POST['qtd'],
//        'link_photo' => str_replace('.jpg', '', $paths[0]['path']),
        'date' => date('Y-m-d H:i:s'),
    );


    $id = WallModel::addWallEntry($entityManager, $params);

    unset($_SESSION['send_photos']);
    unset($_SESSION['send_photos_path']);
    
    $album = new Album();
    $album = $entityManager->getRepository('Album')->find($_POST['qtd']);
    $album->setIdWall($id);
    $entityManager->persist($album);
    $entityManager->flush();
    
    unset($params);
    $params = array(
        'id_album' => $_POST['qtd'],
        'other' => true
    );
    $result = Albums::getPhotos($entityManager, $params);
    echo $result;
}

if ($_POST['func'] == "listAlbum") {
    $params = array(
        'id_owner' => $_SESSION['userid']
    );
    $result = Albums::listAlbum($entityManager, $params);
    echo $result;
}


if ($_POST['func'] == "remove_album") {
    $params = array();
    $params['id_album'] = $_POST['id_album'];
    Albums::removeAlbum($entityManager, $params);
    unset($params);
    $params = array(
        'id_owner' => $_SESSION['userid']
    );
}

//this if will check if when the popup were open he send some photo
//if not he removes the album.
// the album must have at leat one picture
if ($_POST['func'] == "remove_open") {
    $params = array();
    //id_album its the album thats were uploading or seeing the photos.

    $params['id_album'] = isset($_SESSION['open_album']) ? $_SESSION['open_album'] : $_SESSION['id_album'];
    $album = Albums::removeIfEmpty($entityManager, $params);
    //if were uploaded some photo the function will return a Album instance else he remove that entry
    if ($album instanceof Album) {
        $friends = Friends::getFriendsList($entityManager, $session->getSession('userid'), 5000);

        $text = '';
        $paths = $session->getSession('send_photos_path');

        $count = 0;
        foreach ($paths as $path) {
            if ($count == 3)
                break;
            $text .= '<div class="notificationimg"><a href="album_detail.php?id=' . $album->getIdAlbum() . '"><img src="' . $path['path'] . '" class="notificationimg"></a></div>';
            $count++;
        }



        foreach ($friends as $friend) {
            $params = array(
                'id_friend' => $friend['user_id'],
                'id_user' => '' . $session->getSession('userid'),
                'message' => $text . '<a href="album_detail.php?id=' . $album->getIdAlbum() . '"><img src="images/camera-image-uplaod.png"> </a>Created an album ' . $album->getTitle(),
                'type' => '5',
            );

            NotificationModel::addNotification($entityManager, $params);
        }
        $text = 'Created an album ' . $album->getTitle();
        $params = array(
            'owner_id' => '' . $session->getSession('userid'),
            'author_id' => '' . $session->getSession('userid'),
            'text' => $text,
            'link' => './album_detail.php?id=' . $album->getIdAlbum(),
            'link_photo' => str_replace('.jpg', '', AlbumUtil::getFirstPhotoAlbum($album->getIdAlbum())),
            'date' => date('Y-m-d H:i:s'),
        );

        $id = WallModel::addWallEntry($entityManager, $params);
        $album->setIdWall($id);
        $entityManager->persist($album);
        $entityManager->flush();
        
//        $entityManager = new Doctrine\ORM\EntityManager;
        $sql = 'update photo_album set id_wall ='.$id.' where id_album ='.$album->getIdAlbum();
         
        $entityManager->getConnection()->executeQuery($sql);
        
        
    }
    unset($_SESSION['send_photos_path']);
    unset($_SESSION['send_photos']);
    unset($params);
    $params = array(
        'id_owner' => $_SESSION['userid']
    );
    $result = Albums::listAlbum($entityManager, $params);
    echo $result;
}

if ($_POST['func'] == "alter_title") {
    $album = new Album();
    $album = $entityManager->getRepository('Album')->find($_SESSION['id_album']);
    $album->setTitle($_POST['title']);
    $entityManager->persist($album);
    $entityManager->flush();
}

if ($_POST['func'] == "alter_title_photo") {
    $album = new Album();
    $album = $entityManager->getRepository('PhotoAlbum')->find($_SESSION['photo_open']);
    $album->setTitle($_POST['title']);
    $entityManager->persist($album);
    $entityManager->flush();
}



if ($_POST['func'] == "remove_photo") {

    $params = array();
    $params['id_photo'] = $_POST['id_photo'];
    $params = Albums::removePhoto($entityManager, $params);
    unset($params['id_photo']);
    $params['other'] = true;
    $result = Albums::getPhotos($entityManager, $params);
    echo $result;
}

//var_dump(AlbumUtil::userHaveFolder()); 