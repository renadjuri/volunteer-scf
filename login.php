<!DOCTYPE html>
<?php
ob_start();
session_start(); // Starting Session
$page_title = "تسجيل الدخول"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }


</script>
<!-- Style CSS -->

<link href="css/style-login.css" rel="stylesheet" type="text/css" />
<body>

    <br>
    <!-- LOGIN -->  
    <?php
    require 'includes/connection.php'; //connecting to the database
    mysqli_set_charset($con, "utf8");
    $loginmsg = "";
    if (isset($_POST['login-submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password); //encrypt the password before saving in the database

        if (empty($username) || empty($password)) {
            //$msg = "Username or Password is empty";
            $loginmsg = '<div class="alert alert-danger">تأكد من إدخال إسم المستخدم و كلمة المرور  &ensp;<span class= "glyphicon glyphicon-send"></span></div>';
        } else {
            $query = "select * from account where  username='$username' AND password='$password'";
            $run = mysqli_query($con, $query);
            if ($run) {

                $query = "select * from account INNER JOIN volunteer ON (account.Username = volunteer.VolunteerUsername) where account.Username = '$username' ";
                $admin_query = "select * from account INNER JOIN admin ON (account.Username = admin.AdminUsername) where account.Username = '$username' ";

                $admin_result = mysqli_query($con, $admin_query);
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_array($result);
                $row2 = mysqli_fetch_array($admin_result);

                if ($row) {

                    $_SESSION['id'] = $row['VolunteerID']; //here session is used and value of volunter id store in $_SESSION.
                    $_SESSION['username'] = $row['Username'];

                    $loginmsg = '<div class="alert alert-success">تم تسجيل الدخول &ensp;<span class= "glyphicon glyphicon-send"></span></div>';
                    echo "<script>window.open('index.php','_self')</script>";
                } else if ($row2) {

                    $_SESSION['id'] = $row2 ['AdminID']; //here session is used and value of volunter id store in $_SESSION.
                    $_SESSION['username'] = $row2['Username'];
                    $_SESSION['admin'] = "true";

                    $loginmsg = '<div class="alert alert-success">تم تسجيل الدخول &ensp;<span class= "glyphicon glyphicon-send"></span></div>';
                    echo "<script>window.open('index.php','_self')</script>";
                } else {

                    $loginmsg = '<div class="alert alert-danger">بياناتك غير مسجلة لدينا ، قم بإنشاء حساب جديد</div>';
                }
            } else {

                //$msg = "Username or Password is invalid";
                $loginmsg = '<div class="alert alert-danger"><strong>إنتبه! </strong>الإسم المدخل أو كلمة المرور غير صحيحة  &ensp;<span class= "glyphicon glyphicon-send"></span></div>';
            }
        }
    }
    ?>


    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1>تسجيل الدخول</h1>
                            </div>

                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if (empty($_SESSION['id'])) { ?>
                                    <form method="post" id="login-form"  role="form" style="display: block;">

                                        <div style="margin-bottom: 25px" class="input-group"> 
                                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="إسم المستخدم"  
                                                   value="<?php
                                    if (isset($_POST['username'])) {
                                        echo $_POST['username'];
                                    }
                                    ?>"  > 
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group"> 

                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="********"
                                                   value="<?php
                                               if (isset($_POST['password'])) {
                                                   echo $_POST['password'];
                                               }
                                    ?>">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>

                                        </div>
                                        <div>   اظهار كلمة المرور   <input type="checkbox" onclick="myFunction()"
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="login-submit" tabindex="4" class="form-control btn  btn-register" value="تسجيل دخول">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <a href="forget-password.php" tabindex="5" class="forgot-password">نسيت كلمة المرور؟</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-10 col-sm-offset-2">
                                                <?php echo $loginmsg ?>	
                                            </div>
                                        </div>
                                    </form>

                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<!--Footer of the page -->
<?php include('includes/footer.php');
ob_end_flush();
?>

