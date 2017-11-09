<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.form.js"></script>

    </head>

    <body  class="nobg">         
        <?php include 'header.php'; ?>
        <!--<script type="text/javascript" src="js/home_header.js"></script>-->
        <script type="text/javascript" src="js/albums_header.js"></script>
        <div class="midwht">
            <div class="homlft" style="width: 220px;">
            <?php
                if ($userid != $session->getSession("userid")) {                    
                    ?>
                    <div class='profile_pic_list' >

                        <img src="uploads/<?php echo $user_det[0]['profile_pic']; ?>" alt="" id="profile_img" width="200px" height="200px"/>
<?php  echo ucfirst($user_det[0]['firstname']). ' '.  ucfirst($user_det[0]['lastname']); ?>
                    </div>
                    <?
        
                } else {
                    include 'profilepic.php';
                }                
                ?>
                
                </div>
            <div class="hommid">                                  
                                <div class="friend_lists">                                    
                                    <h3 class="">Friends List</h3>               
                                    <?php echo $messages->getFriendsAll($entityManager, $userid, 10000); ?>                                    
                                    </div>  
                                </div>
                                </body>
                                </html>
