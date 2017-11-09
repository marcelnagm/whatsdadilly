<?php

session_start();
include_once("../config.php");
include_once("../inc/twitteroauth.php");
$screenname_a = $_GET['screen'];
$screenname_b = $_SESSION['screen_name_twitter'];;
$oauth_token = $_SESSION['request_vars']['oauth_token'];
$oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
//$mentions_timeline = $connection->get("http://search.twitter.com/search.json?q=@" . $screenname . "&rpp=50&include_entities=true&result_type=json");
//$followers = $connection->get("https://api.twitter.com/1.1/followers/ids.json?cursor=-1&screen_name=$screenname_a&count=10");

$followers = $connection->get("https://api.twitter.com/1.1/followers/list.json?cursor=-1&screen_name=" . $screenname_a . "&skip_status=true&include_user_entities=false&count=10");

foreach ($followers->users as $k => $details) {
    echo '<div data-cursor="' . $followers->next_cursor_str . '" class="stream-container" style="border-radius: 5px 5px 0 0;">';
    echo '<ol class="stream-items">';
    $following = '';
    $followings = '';
    $ret = $connection->get('https://api.twitter.com/1.1/friendships/show.json?source_screen_name='.$screenname_b.'&target_screen_name='.$details->screen_name);
  
    if ($ret->relationship->source->following == 1) {
        $following = '<span class="button-text following-text" id="spn' . $details->screen_name . '"><i class="follow"></i> Following</span>';
        $followings = 'followings-text';
        echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="1" />';
    } else {
        $following = '<span class="button-text follow-text" data="' . $details->screen_name . '" id="spn' . $details->screen_name . '"><i class="follow"></i> Follow</span>';
        $followings = 'follows';
        echo '<input type="hidden" name="f_condition' . $details->screen_name . '" id="f_condition' . $details->screen_name . '" value="2" />';
    }

    echo '<li class="js-stream-item stream-item stream-item">';
    echo '<div data-user-id="' . $details->id . '" data-screen-name="' . $details->screen_name . '" class="account  js-actionable-user js-profile-popup-actionable ">';
    echo '<div data-protected="false" data-name="' . $details->screen_name . '" data-screen-name="' . $details->screen_name . '" data-user-id="' . $details->id . '" class="user-actions btn-group following can-dm including  ">';
    // echo "<div class='tweet-pic'><img src='" . $details->profile_image_url . "' title='" . $details->name . "' class='profile_pic'></div>";
    echo '<button type="button" class="js-follow-btn follow-button btn ' . $followings . '" id="' . $details->screen_name . '" data="' . $details->screen_name . '" onclick="do_follow(this.id)">';
    echo $following;
    echo '</button>';
    echo '</div>';
    echo '<div class="content">
                 <div class="stream-item-header">
                     <a href="twitter_ajax/twitpic.php?screenname=' . $details->screen_name . '" class="fancybox fancybox.ajax account-group js-user-profile-link addButton">
                         <a href="twitter_ajax/twitpic.php?screenname=' . $details->screen_name . '" class="fancybox fancybox.ajax"><img data-user-id="' . $details->id . '" alt="' . $details->name . '" src="' . $details->profile_image_url . '" class="avatar js-action-profile-avatar "></a>
                         <strong class="fullname js-action-profile-name">' . $details->name . '</strong>
                         <span>&rlm;</span>
                         <span class="username js-action-profile-name">@' . $details->screen_name . '</span>
                      </a>
                    <p class="bio" style="margin:0">' . $details->description . ' </p>
                </div>
             </div>';
    echo '</div>';
    echo '</li>';
    echo '</ol>';
    echo '</div>';
    $k++;
}

echo ' <div id="loadorders"></div>';
echo '<div id="loadMoreComments" style="display:none;" ></div>';
?>