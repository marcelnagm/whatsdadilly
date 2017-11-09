<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
//include_once("../model/Twitter.php");
$screenname = $_SESSION['screen_name_twitter']; //$_GET['screenname'];
$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];
$twitterid = $_SESSION['screen_id_twitter'];
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
$view_summary = $connection->get("https://api.twitter.com/1.1/statuses/show.json?id=" . $_POST['retweet_id']);
$svid = explode('?', $view_summary->entities->urls[0]->expanded_url);
echo '<iframe width="100%" height="250" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.$svid[0].'&amp;auto_play=false&hide_related=true&visual=true">';
?>
