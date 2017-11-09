<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$video_id = $_POST['vine_id'];
echo "<iframe src='https://vine.co/v/" . $video_id . "/card?mute=1' width='300px' height='300px' frameborder='0'></iframe>"
?>