<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'bootstrap.php';
require_once 'classes/Session.class.php';
require_once 'model/Signup.php';
if (isset($_POST['login_username']) && $_POST['login_username'] != "") {
   $data = array(
        "login_username" => $_POST['login_username'],
        "login_password" => md5($_POST['login_password'])
    );
    $result = Signup::login($data, $entityManager);
        if (count($result) != 0) {
        $datas = array("userid" => $result[0]['user_id']);
        $credientials = Signup::getTokens($datas,$entityManager);
        
        $session = new Session();
        foreach($credientials as $tokens){
        $session->setSession($tokens['networkname'], 1);
        $session->setSession("screen_name_".$tokens['networkname'], $tokens['screen_name']);
        $session->setSession("screen_id_".$tokens['networkname'], $tokens['screen_id']);
        $session->setSession("auth_token_".$tokens['networkname'], $tokens['auth_token']);
        $session->setSession("auth_secret_".$tokens['networkname'], $tokens['auth_secret']);
        }
        $session->setSession("userid", $result[0]['user_id']);
        $session->setSession("email", $result[0]['email']);
        $session->setSession("firstname", $result[0]['firstname']);
        $session->setSession("lastname", $result[0]['lastname']);
        $session->setSession("dob", $result[0]['dob']);
        $session->setSession("current_city", $result[0]['current_city']);
        $session->setSession("home_city", $result[0]['home_city']);
        $session->setSession("profile_pic", $result[0]['profile_pic']);
        $success = array("success" => 1);
        $redirect = 'home.php';
        header("location:$redirect");
    } else {
        $success = array("success" => 0);
        $redirect = 'index.php';
        header("location:$redirect");
    }
//    echo json_encode($success);
}
?>
