<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <link rel="stylesheet" href="css/marcel.css" type="text/css" />
        <link rel="stylesheet" href="css/wall.css" type="text/css" />
        <link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
        <script type="text/javascript" src="js/wall.js"></script>
        <link href='css/nprogress.css' rel='stylesheet' />
        <script type="text/javascript" src='js/nprogress.js'></script>        
        <link rel="stylesheet" href="js/colorbox/colorbox.css" />        
        <script src="js/colorbox/jquery.colorbox.js"></script>        
    </head>
    <style>
        .jspVerticalBar
{	
        background-color: black;
}
    </style>
    <body  class="nobg">
        <div class="main_content">
            <script type="text/javascript">
                var ajaxUrl = 'wall.php';
            </script>
            <?php include 'header.php'; ?>           
            <div class="midwht">
                <div class="homlft">
                    <?php include 'profilepic.php'; ?>
                </div>
                <div class="hommid">
                    <?php include 'socialmenu.php'; ?>
                    <form action="" id="upload_photos" enctype="multipart/form-data" method="post" >
                        <textarea name="status" class="grybord">Whats in your head?</textarea>
                        <div id="link_info"></div>
                        <div class="clear"></div>
                        <div id="picture">
                            <h3>Use the form below to add photos.</h3>
                            <div class="one-photo">
                                <input class="fileUpload" type="file" name="photo_0" />
                                <div class="removePhoto">remove</div>
                                <div class="preview"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </form>
                    <div class="dgry">
                        <div class="picon"><a href="#"> <img src="images/photoicon.png" alt="" /></a> </div>
                        <input type="submit" class="postbutton" value="post" />
                    </div>
                    <div class="bluebg">Twitter</div>
                    <div class="tabgray">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr valign="middle">
                                <td class="homtit" width="55" height="25">Home</td>
                                <td class="homtit" width="40">52587 Twitter</td>
                                <td class="homtit" width="62">1125 Following</td>
                                <td class="homtit" width="62">525 Followers</td>
                                <td class="homtit" width="52">Favorites</td>
                                <td class="homtit" width="52">Mentions</td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </div>
                    <div class="postbg">6 new posts</div>
                    <div class="peoplebx">
                        <div class="jessicatxt"><?php
                    $part = Friends::getFriendsTumbnail($entityManager, $session->getSession('userid'), 8);
                    echo Friends::getFriendsTumbnailText($entityManager, $session->getSession('userid'), 8)
                    ?></div>
                        <div class="peopwrap"> <?php echo $part; ?></div>
                    </div>
                    <script type="text/javascript">
                        <!--//
                        function sizeFrame() {
                            var F = document.getElementById("wall-iframe");
                            if (F.contentDocument) {
                                F.height = F.contentDocument.documentElement.scrollHeight + 30; //FF 3.0.11, Opera 9.63, and Chrome
                            } else {



                                F.height = F.contentWindow.document.body.scrollHeight + 30; //IE6, IE7 and Chrome

                            }

                        }

                        window.onload = sizeFrame;
                        setInterval(function(){sizeFrame()},100);

                        //-->
                    </script>

                    <iframe id="wall-iframe" scrolling="no" frameborder="0" src="wall-itself.php"></iframe>
                </div>
            </div>
            <div class="friendright">
<?php $result = $messages->getFriends($entityManager, $session->getSession("userid"), 8); ?>
                <a href="friend_list.php" ><h3 class="">Friends(<font class="totalfriends"><?php echo $messages->getNumber(); ?></font>)</h3></a>
                <div class="friendwrap">
<?php echo $result; ?>
                </div>
            </div>
            <div class="logfoot">
                <div class="fmenu">
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Status</a></li>
                        <li><a href="#">Terms</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Advertisers</a></li>
                        <li><a href="#">Businesses</a></li>
                        <li><a href="#">Directory</a></li>
                    </ul>
                </div>
                <span class="toimg"><img src="images/tobg.png" alt="" /></span>
                <p>Copyright 2013 whatsdadilly. All Rights Reserved.</p>
            </div>

        </div>
    </body>
</html>
<script>
<?php if ($_GET['msg'] == 'success') { ?>
        alert("Account added successfully!!!");
        opener.location.reload();
        window.close();
        $('body').show();
        $('.version').text(NProgress.version);
        NProgress.start();
        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
<?php } else if ($_GET['msg'] == 'error') { ?>
        alert("Oops Already acount availablle!!!");
        opener.location.reload();
        window.close();
        $('body').show();
        $('.version').text(NProgress.version);
        NProgress.start();
        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
<?php } ?>
</script>
<script>
    $('body').show();
    $('.version').text(NProgress.version);
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);

</script>
