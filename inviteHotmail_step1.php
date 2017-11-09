
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<link href="css/registration-process.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>
<script src="js/invites.js"></script>
<script src="js/jquery-1.9.1.js"></script>
<?php
require 'bootstrap.php';



//include_once("live_connect.inc.php");
////if ($_GET['code']) {
////initiate class
//$cnt_live = new MocrosoftLiveCnt(array(
//            'client_id' => '0000000048111FBA',
//            'client_secret' => 'GGlhrSUWZn4-DVbQ4aJUkb2cyAitIF-B',
//            'client_scope' => 'wl.basic',
//            'redirect_url' => 'http://www.whatsdilly.local:81/whatsdadilly/inviteHotmail.php'
//        ));

//***************************************MSN START********************************
$client_id = '000000004C11050F';
$client_secret = 'QUgoABVSZ55Kuhzy3B8O45ljnOmC0fOd';
$redirect_uri = 'http://www.whatsdilly.com/inviteHotmail.php';
$urls_ = 'https://login.live.com/oauth20_authorize.srf?client_id='.$client_id.'&scope=wl.basic&response_type=code&redirect_uri='.$redirect_uri;
//$urls_ = 'https://login.live.com/oauth20_authorize.srf?client_id='.$client_id.'&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri='.$redirect_uri;
$msn_link =  '<a href="'.$urls_.'" >MSN Contacts</a>';
echo $msn_link;
//***************************************MSN ENDS********************************
?>

