<!DOCTYPE html>
<?php
$page_title = "تسجيل دخول"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
if (is_login()) {
    $CID = $get_user_data("ID");
}
?>


<style>


    #form-container {

        width: 500px;
        height: 400px;}


</style>

<body>

<center>
    <div>
        <div class="container text-center" >
            <h1>تسجيل الدخول</h1>
        </div>


        <div id="form-container" >

            <center>
                <?php if (!is_login()) { ?>

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
                        <a class="text-success" href="forget-password.php">نسيت كلمة المرور؟</a>

                        <div style="margin-left: 5px; margin-top: 5px ; padding: 5px">
                            <a style="padding: 15px; text-decoration:none" class="s_button" href="register2.php">تسجيل مستخدم جديد</a>
                            <a style="padding: 15px;" class="s_button" id="login_ajax">تسجيل الدخول</a>
                        </div>
                        </span>   
                        <br>
                        <div id="msg_login">
                        </div>
                        <br>
                    </form>

                <?php } ?>
        </div>
</center>
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
                            msg_login.html("<font color='red'>كلمة المرور أو أسم المستخدم فارغة</font>");
                            break;
                        case "invalid":
                            msg_login.html("<font color='red'>كلمة المرور أو اسم المستخدم غير صحيحة</font>");
                            break;
                        case "login":
                        {
                            msg_login.html("<font color='#50be4c'>تم تسجيل الدخول</font>");
                            window.location = "index.php";
                            break;
                        }
                    }
                }
            });

        });
    });
</script>
<!--Footer of the page -->

<?php include('includes/footer.php'); ?>
