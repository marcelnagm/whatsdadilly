function readNotification($qtd,$id){
    
    
    $val =parseInt($('.notify').text(), 10)-1;
    if($val == 0) $val = '';                
    $('.notify').html($val);              
    $('#notification_'+$id).attr('class', 'notificationwrap nobg');
    //    console.log('h2');
    $('#read_'+$qtd).hide();        
//    console.log('h3');
    
//    console.log('#notification_'+$qtd);
//    $(".notification").fadeIn(1)
//    getNotifications('readNotification', $qtd, '');    
    
}

var notification = false;                 
var friends = false;
var notificationsRead = false;
var results = false;
var settings = false;
     
 
$(document).ready(function(){
   
    $(".read_icon").click(function(){
        notificationsRead = true;
    });
    $(".first").click(function(){
        //        alert('ine');
        notification = !notification;                
        if(notification){
            $(".notification").fadeIn(1).jScrollPane();           
            $(this).css('background','url("../images/globe-active.png") no-repeat scroll 0 0 transparent');
            $('.notify').fadeOut(1);
        }else{
            if(notificationsRead == false){
                $(this).css('border','');     
                $(".notification").fadeOut(1);
                $(this).css('background','url("../images/globe1.png") no-repeat scroll 0 0 transparent');
                $('.notify').fadeIn(1);
            }
        } 
        if(friends){
            $(".frienddropwrap").fadeOut(1)
            $('.third').css('background','url("../images/friends.png") no-repeat scroll 0 0 transparent');             
            friends = !friends;
        }
        $(".readAll").click(function(){                             
            getNotifications('ClearAll',0,'.notification');                             
        });
        notificationsRead = false;
    });
       
    $(".third").click(function(){                         
        friends = !friends;        
        $(this).css('background','url("../images/friends-active.png") no-repeat scroll 0 0 transparent');
        if(notification){
            $(".notification").fadeOut(1);
            notification = !notification;
            $('.notify').fadeIn(1);            
            $('.first').css('background','url("../images/globe1.png") no-repeat scroll 0 0 transparent');             
        }
        if(friends){
            $(".frienddropwrap").fadeIn(1);                
        }else{
            $('.third').css('background','url("../images/friends.png") no-repeat scroll 0 0 transparent');            
            $(".frienddropwrap").fadeOut(1);    
        }
        $(".friendAll").click(function(){
            var url = "friend_list.php";
            $(location).attr('href',url);  
        });
    });  
        
    $(".ignorebutton,.confirmbutton").mouseover(function (){
        friends = false;
    } );
    $(".ignorebutton,.confirmbutton").mouseout(function (){
        friends = true;
    } );    
    
    
     

    $(".hommid,.midwht,.homlft,.friendright,.topblack").click(function (){    
        console.log('h1');
        $(".notification").fadeOut(1);   
        $(".settings").fadeOut(1);
        $(".frienddropwrap").fadeOut(1); 
        $('.results').fadeOut(1);  
        //        $(".topinner").mouseout(function(){                        
        if(settings){
            $(".settings").fadeOut(1);                             
            settings = false;
        }
        if(friends){
            $(".frienddropwrap").fadeOut(1); 
            $('.third').css('background','url("../images/friends.png") no-repeat scroll 0 0 transparent');            
            friends = false;
        }
        if(notification){
            notificationsRead = false;
            $(".notification").fadeOut(1);                 
            $('.notify').fadeIn(1);
            notification = false;
            $('.first').css('background','url("../images/globe1.png") no-repeat scroll 0 0 transparent');             
        }
        if(results){
            $('.results').fadeOut(1);           
            $('.searchinput').val('');
            results = false;
        }
    });      
      
       
            
               
    $(".setting").click(function(){
        $(".settings").fadeIn(1);
        settings = true;
    });
    //        added by marcel
  
   
    $(".second").click(function(){                                
        $(".messages").slideToggle("slow");                    
    });    
  

   
    
    /**
     * Modified the way that the event are triggered 
     */
    timeout = false;
    $(".searchinput").keypress(function(e){        
        
        if(timeout) {
            clearTimeout(timeout);
            timeout = null;
        }        
        
        lastlength = 0;
        timeout = setTimeout(function(){
            //            alert('hello')
        
            if($(".searchinput").val().length >=2 && lastlength <  $(".searchinput").val().length){            
                $('.results').fadeIn(1);   
                $("#resultdiv").html('<li><image class="loading" src="images/ajax-loader.gif" title="Loading"  > </li>')                 
                sended = search('search', $(".searchinput").val(), '#resultdiv');            
        
            
                results = true;
            }else {
                $('.results').fadeOut(1);           
                results = false;
            }
            lastlength = $(".searchinput").val().length ;    
        },1700);
                      
    });                                
/**
     * --Modified  --
     */   
});


var   timeover = false;
function getMoreNotificaitons(){
    if(timeout) {
        clearTimeout(timeout);
        timeout = null;
    }        
        
    lastlength = 0;
    timeout = setTimeout(function(){
        //            alert('hello')
        getNotifications('raiseLimit', 0, 0);
    },2000);
    
    getNotifications('raiseLimit', 0, 0);
}
