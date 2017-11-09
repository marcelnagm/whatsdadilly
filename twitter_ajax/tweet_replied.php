<?php
session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");

$oauth_token = $_SESSION['auth_token_twitter'];
$oauth_token_secret = $_SESSION['auth_secret_twitter'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);

function getTreeTweet($tweetId) {
    $oauth_token = $_SESSION['request_vars']['oauth_token'];
    $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
    $connections = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
    $res_reply = $connections->get("statuses/show/" . $tweetId);
    $text = htmlentities($res_reply->text, ENT_QUOTES, 'utf-8');
    $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
    $text = preg_replace('/@(\w+)/', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $text);
    $text = preg_replace('/\s#(\w+)/', ' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);
    $Tmdata = '<div class="tweet-outer" id="tweet-outer' . $k . '">';
    $Tmdata .= "<div class='tweet-pic'><img src='" . $res_reply->user->profile_image_url . "' title='" . $res_reply->user->name . "' class='profile_pic'></div>";
    $Tmdata .= '<div class="tweet-content">' . $text . ' <br />-<i>' . $res_reply->created_at . '</i></div>';
    $Tmdata .= '<div class="tweet-counts">' . ($res_reply->retweet_count != 0 ? $res_reply->retweet_count . 'Retweets' : false);
    $Tmdata .= '</div>';
    $Tmdata .= '</div>';
    if ($res_reply->in_reply_to_status_id_str != '') {
        $pMdata = getTreeTweet($res_reply->in_reply_to_status_id_str);
        return $Tmdata . $pMdata;
    } else {
        return $Tmdata;
    }
}

if (isset($_POST["reply_id"])) {

    $id = $_POST["reply_id"];
    $my_retweet = $connection->get("statuses/show/" . $id);

    $text = htmlentities($my_retweet->text, ENT_QUOTES, 'utf-8');
    $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
    $text = preg_replace('/@(\w+)/', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $text);
    $text = preg_replace('/\s#(\w+)/', ' <a href="http://search.twitter.com/search?q=%23$1" target="_blank">#$1</a>', $text);
    $mdata = '<div class="tweet-outer" id="tweet-outer' . $k . '">';
    $mdata .= "<div class='tweet-pic'><img src='" . $my_retweet->user->profile_image_url . "' title='" . $my_retweet->user->name . "' class='profile_pic'></div>";
    $mdata .= '<div class="tweet-content">' . $text . ' <br />-<i>' . $my_retweet->created_at . '</i></div>';
    $mdata .= '<div class="tweet-counts">' . ($my_retweet->retweet_count != 0 ? $my_retweet->retweet_count . 'Retweets' : false);
    $mdata .= '</div>';
    $mdata .= '</div>';
    if ($my_retweet->in_reply_to_status_id_str != '') {
        $data = getTreeTweet($my_retweet->in_reply_to_status_id_str);
    }
    echo $mdata . $data;
}
?>