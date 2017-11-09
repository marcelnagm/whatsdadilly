<html>
    <head>
        <?php require 'bootstrap.php'; ?>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        
    </head>
    <body class="nobg">

        <?php
//        
//        $album = new Album();
//        $album->setIdOwner(74);
//        $album->setTitle('Haaaaaa');
//        $album->setPrivate(1);
//        $album->setCover(1);
//        $album->setDatetime();
//        $entityManager->persist($album);
//        $entityManager->flush();
//        
//        
        
        echo __DIR__;
SendMail::sendFriendshipRequest($entityManager, 59, 74);
        ?>
    </body>
</html>