<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>:WHATSDADILLY:</title>
        <link rel="stylesheet" href="css/reset-min.css" type="text/css" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <script type="text/javascript" src="js/jquery-latest.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery.crypt.js"></script>        
        <script type="text/javascript">
            $(document).ready(function() {
                $("#AuthForm").validate({
                    rules: {
                        firstname:{
                            required:true
                        },
                        lastname:{
                            required: true
                        },
                        email:{
                            required:true,
                            email:true,
                            validusername:true
                        },
                        retypeemail:{
                             required:true,
                            email: 'required',
                            equalTo: '#email'
                        },
                        password:{
                            required:true
                        },
                        gender:{
                            required:true
                        },
                        dmonth:{
                            required:true
                        },
                        dday:{
                            required:true
                        },
                        dyear:{
                            required:true
                        }
                    },
                    messages: {
                        firstname:{
                            required: ""
                        },
                        lastname:{
                            required: ""
                        },
                        email:{
                            required:"",
                            validusername:"Email already exist"
                        },
                        retypeemail:{
                            required:"",
                            required : "",
                            equalTo : "Email not matched"
                        },
                        password:{
                            required:""

                        },
                        gender:{
                            required:""
                        },
                        dmonth:{
                            required:""
                        },
                        dday:{
                            required:""
                        },
                        dyear:{
                            required:""
                        }
                    }
                });                               
            });
            $.validator.addMethod('validusername',function(value){
                var getURL = "validusername.php";
                var email = $("#email").val();
                var result;
                $.ajax({
                    cache:      false,
                    async:      false,
                    type:       'post',
                    data:       'email='+email,
                    url:        getURL,
                    success:    function(msg){
                        var data = $.parseJSON(msg);
                        if(data.success == 1)
                        {
                            result = false;
                        }
                        else if(data.success == 0)
                        {
                            result = true;
                        }
                    }
                });
                return result;
            }, '');
        </script>
    </head>
    <body>
<?php include 'header.php'; ?>
<div id="logincontainer">
    <div class="logleft">
        <h1>Find out what’s happening, right now,</h1>
        <h2>with all your social netwroks, all-in-on.</h2>
        <div id="sicons">            
            <ul>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Tweeter</a></li>
                <li><a href="#">LIn</a></li>
                <li><a href="#">Gplus</a></li>
                <li><a href="#">Facebook</a></li>
                <li><a href="#">Tweeter</a></li>
                <li><a href="#">LIn</a></li>
                <li class="nomargR"><a href="#">Gplus</a></li>
            </ul>
        </div>
        <div class="orngtxt orngmarg">Mix all your social networks in one</div>
        <div class="orngtxt">Share what’s new in your life on your Timeline</div>
        <div class="orngtxt">See all updates from friends in one News Feed</div>
    </div>
    <div class="signbgwrap">
        <form id="AuthForm" class="Form FancyForm AuthForm" action="signup.php" method="POST" accept-charset="utf-8">
        <div class="signbg">
            <h3>- Sign up for Free</h3>
            <input type="text" name="firstname" id="firstname" value="" class="locinput" placeholder="First Name">
            <input type="text" name="lastname" id="lastname" value="" class="locinput nomargR" placeholder="Last Name">
                <input type="text" name="email" id="email"  value="" class="locinput2" placeholder="Your Email">
            <input type="text"  name="retypeemail" id="retypeemail" value="" class="locinput2" placeholder="Re-enter Email">
            <input type="text" name="password" id="password" value="" class="locinput2" placeholder="New Password">
            <h4>Birthday</h4>
            <select name="dmonth" id="dmonth" class="locinput3">
                <option value="">Month</option>
                <option value="01">Jan</option>
                <option value="02">Feb</option>
                <option value="03">Mar</option>
                <option value="04">Apr</option>
                <option value="05">May</option>
                <option value="06">Jun</option>
                <option value="07">Jul</option>
                <option value="08">Aug</option>
                <option value="09">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dec</option>
            </select>

            <select name="dday" id="dday" class="locinput3">
                <option value="">Date</option>
                <?php for($i=01;$i<=31;$i++) { ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php } ?>
            </select>
            <select name="dyear" id="dyear" class="locinput3">
                <option value="">Year</option>
                <?php for($i=1950;$i<=2013;$i++) { ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php } ?>
            </select>
            <div class="gender">
                <label><input type="radio" name="gender" id="gender" value="Female"/> Female</label>
                <label><input type="radio" name="gender" id="gender" value="Male"/> Male</label>
            </div>
            <p>By clicking Sign Up, you agree to our Terms and
                that you have read our Data Use Policy.</p>
            <input type="submit" value="SIGN UP" class="btn_signup" />
        </div>
        </form>
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