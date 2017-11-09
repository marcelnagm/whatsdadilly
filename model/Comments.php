<?php

require_once "bootstrap.php";

class CommentsModel {

    /**
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @param type $params
     * @throws Exception
     */
    public static function addComment($entityManager, $params) {
        $entry = new Comments();
        $entry->setAuthorId($params['author_id']);
        $entry->setPostId($params['post_id']);
        $entry->setText($params['text']);
        $entry->setDate($params['date']);

        $entityManager->getConnection()->beginTransaction();
        try {
            $res = $entityManager->persist($entry);

            $session = new Session();

            $photo = $entityManager->getRepository('PhotoAlbum')->findOneBy(array('id_wall' => $entry->getPostId()));

            if ($photo->getIdWall() != '') {
                $comment = new PhotoComment();
                $comment->setIdPhoto($photo->getIdPhoto());
                $comment->setIdUser($session->getSession('userid'));
                $comment->setComment($entry->getText());
                $entityManager->persist($comment);
                unset($params);
                if ($photo->getIdOwner() != $session->getSession('userid')) {

                    $params = array(
                        'id_friend' => '' . $photo->getIdOwner(),
                        'id_user' => '' . $session->getSession('userid'),
                        'message' => '<div class="notificationimg"><a class="group1" href="photo_detail.php?id=' . $photo->getIdPhoto() . '"><img class="notificationimg" src="' . $photo->getPath() . '"> </a></div>' . ucfirst($session->getSession('firstname')) . ' ' . ucfirst($session->getSession('lastname')) . ' comment on your    photo - ' . $entry->getText(),
                        'type' => '4',
                    );
                    $entry = new Notification();
                    $entry->setIdFriend($params['id_user']);
                    $entry->setIdUser($params['id_friend']);
                    $entry->setMessage($params['message']);
                    $entry->setType($params['type']);
                    $entityManager->persist($entry);
                }
            }

            $entityManager->flush();
            $entityManager->getConnection()->commit();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            throw $e;
        }
    }

    public static function getComments($post_id, $entityManager) {

        $entityManager->getConnection()->beginTransaction();
        try {
            $dql = "SELECT c.text, c.date, u.firstname, u.lastname 
                FROM Wall w,Comments c,UserRegister u
                WHERE u.user_id=w.author_id and w.id=c.post_id and c.post_id =:post order by c.date desc";
            $query = $entityManager->createQuery($dql);
            $query->setParameters(array(
                'post' => $post_id
            ));
            return $query->getArrayResult();
        } catch (Exception $e) {
            $entityManager->getConnection()->rollback();
            $entityManager->close();
            var_dump($e->getMessage());
            throw $e;
        }
    }

}
