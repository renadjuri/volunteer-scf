<?php
ob_start();
session_start(); // Starting Session
include("includes/database.php");
if (is_login()) {
    $CID = $get_user_data("ID");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css\style13.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery.min.js"></script>
        <style>

            body{
                background-size:cover;
                background-attachment:fixed;
            }
            a{color:white;}

        </style>
    </head>
    <body>

        <script>
            // Function take the username and password and send them to the login page then
            // show a feedback message (written in ajax)
            $(document).ready(function () {
                var msg_login = $("#msg_login");
                $("#login_ajax").click(function () {
                    $.ajax({
                        url: 'login1.php',
                        type: 'post',
                        data: $("form").serialize(),
                        success: function (data) {
                            switch (data) {
                                case "empty":
                                    alert(111);
                                    msg_login.html("<font color='red'>Username or Password is empty</font>");
                                    break;
                                case "invalid":
                                    msg_login.html("<font color='red'>Username or Password is invalid</font>");
                                    break;
                                case "login":
                                    msg_login.html("<font color='#50be4c'>Login successfully</font>");
                                    location.reload();
                                    break;
                            }
                        }
                    });

                });
            });
        </script>

        <!--Navigation menu-->
    <center><img src="images/logo.png" id="logo" ></center>

    <ul>
        <li><a href="index.php">الرئيسية </a></li>
        <li><a href="events.php">الفعاليات</a></li>
        <li><a href="includes/CharterofVolunteerism.pdf">ميثاق  التطوع</a></li>
        <li><a href="Contact_us.php">اتصل بنا</a></li>

    </ul>


    <br>
    <br>

    <center>
        <div id="form-container" >
            <div id="form-topcontainer">
                <img id="logo-form" src="images/logo.png" alt="logo" width="100"/>
                <h2> التسجيل </h2>
            </div>
            <center>
                <?php if (!is_login()) { ?>
                    <div class="login">
                        <div id="msg_login">
                        </div>
                        <form method="post">
                            <br><br>
                            
                            <input id="username" name="username" placeholder="إسم المستخدم" type="text">
                            <label style="color:#FCFBF9;
                                  font-size: 18px;">إسم المستخدم&nbsp;</label>
                            <br>
                           
                            <input id="password" name="password" placeholder="*********" type="password">
                           
                             <label style="color:#FCFBF9;
                                   font-size: 18px;">كلمة المرور &nbsp;</label>
                                    <br>
                                    <a id="link" href="forget-password.php">نسيت كلمة المرور؟</a>
                           
                            <div style="margin-left: 100px; margin-top: 5px ; padding: 5px">
                                <a style="padding: 15px" class="s_button" id="login_ajax">تسجيل الدخول</a>
                                <a style="padding: 15px" class="s_button" href="register.php">تسجيل مستخدم جديد</a>
                            </div>



                            </span>   
                            <br>
                            <br>
                        </form>


                    </div>
                <?php } ?>



        </div>
    </center>
    <!--Footer of the page -->
    <div class="footer">
        <footer>             
            <?php include('includes/footer.php'); ?>
        </footer>
    </div>
</body>
</html>
