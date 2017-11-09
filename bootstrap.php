<?php

// bootstrap.php
require_once "entities/UserRegister.php";
require_once "entities/Wall.php";
require_once "entities/Comments.php";
require_once "entities/Notification.php";
require_once "entities/User.php";
require_once "entities/Photo.php";
require_once "entities/Photos.php";
require_once "entities/Album.php";
require_once "entities/PhotoAlbum.php";
require_once "entities/Location.php";
require_once "entities/Product.php";
require_once "entities/Bug.php";
require_once "entities/AddToken.php";
require_once 'entities/PhotoComment.php';
require_once 'entities/Friend.php';
require_once "entities/LastLogin.php";
require_once 'model/Notification.php';
require_once 'model/SendMail.php';
require_once 'model/PhotoComments.php';
require_once 'model/Wall.php';
require_once 'model/Friends.php';
require_once "model/Albums.php";
require_once "model/Comments.php";

if (!class_exists("Doctrine\Common\Version.php", false)) {
    require_once "bootstrap_doctrine.php";
}

require_once "repositories/BugRepository.php";
$messages = new Friends();
$notifications = new NotificationModel();

if (isset($_GET['debug'])) {
    $_SESSION['debug'] = $_GET['debug'];
}

if (session_status() == PHP_SESSION_ACTIVE) {
    if ($_SESSION['debug'] == 1) {
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
        error_reporting(E_ALL);
        error_reporting(E_ALL);
        }
    }