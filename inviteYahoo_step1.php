
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<link href="css/registration-process.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="js/invites.js"></script>
<script src="js/jquery-1.9.1.js"></script>
<?php
require 'bootstrap.php';

require_once('yahoo_api/globals.php');
require_once('yahoo_api/oauth_helper.php');
$callback    =    "http://www.whatsdilly.com/inviteYahoo.php";
/* Get the request token using HTTP GET and HMAC-SHA1 signature*/
$retarr = get_request_token(OAUTH_CONSUMER_KEY, OAUTH_CONSUMER_SECRET,
$callback, false, true, true);

if (! empty($retarr)){
list($info, $headers, $body, $body_parsed) = $retarr;
if ($info['http_code'] == 200 && !empty($body)) {
/* print "Have the user go to xoauth_request_auth_url to authorize your app\n" .
rfc3986_decode($body_parsed['xoauth_request_auth_url']) . "\n";
echo "<pre/>";
print_r($retarr);*/
$_SESSION['request_token']  = $body_parsed['oauth_token'];
$_SESSION['request_token_secret']  = $body_parsed['oauth_token_secret']; $_SESSION['oauth_verifier'] = $body_parsed['oauth_token'];
echo $yahoo_link =  '<a href="'.urldecode($body_parsed['xoauth_request_auth_url']).'" >Yahoo Contact list</a>';
}
}

?>
