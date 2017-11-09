<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<table>
    <tbody>            
        <?php
        $i = 0;
        foreach ($testArray as $item) {
            ?>
            <tr style="text-align: center;">
                <td>
                    <input type="checkbox" value="" id="contact_<?php echo $i;?>">
                </td>
                <td>                    
                    <?php echo $item['name'] ?> 
                </td>
                <td style="margin-left: 4px; padding: 4px;" id="contact_<?php echo $i;?>">
                    
                    <?php
                    echo Invites::checkIfHave($entityManager, array('email' => $item['email'],'name' => $item['name'])) . '<br>';
                    $i++;
//}else{            
                    ?>
                    
                </td></tr>
        <?php } ?>
    </tbody>
</table>
<br>

<input class="btn btn-success" type="button" value="Send invites/request All" onclick="sendInviteAll('', '', '');">
