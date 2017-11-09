<?php

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Mapping as ORM;

/**
 * @Entity(repositoryClass="PhotoAlbumRepository")  @Table(name="photo_comments")
 */
class PhotoComment {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id_comment;

    /** @Column(type="integer") */
    protected $id_photo;

    /** @Column(type="integer") */
    protected $id_user;

    /** @Column(type="string") */
    protected $comment;

    /** @Column(type="string") */
    protected $datetime;

    public function __construct() {
        $this->setDatetime();
    }
    
    public function __toString() {
        return $this->comment;
    }

        public function getIdComment() {
        return $this->id_comment;
    }

    public function setIdComment($id_comment) {
        $this->id_comment = $id_comment;
    }

    public function getIdPhoto() {
        return $this->id_photo;
    }

    public function setIdPhoto($id_photo) {
        $this->id_photo = $id_photo;
    }

    public function getIdUser() {
        return $this->id_user;
    }

    public function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    
    public function getDatetime() {
        return $this->datetime;
    }

    public function setDatetime() {
        $this->datetime = date('Y-m-d H:i:s');
    }

    
}