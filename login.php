<!DOCTYPE html>

<?php
$page_title = "تسجيل الدخول"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>
<!-- Style CSS -->

<link href="css/style-login.css" rel="stylesheet" type="text/css" />
<body>


    <!-- LOGIN -->  
    <?php
    require 'includes/connection.php'; //connecting to the database
    mysqli_set_charset($con, "utf8");
    $loginmsg = "";
    if (isset($_POST['login-submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($username) || empty($password)) {
            //$msg = "Username or Password is empty";
            $loginmsg = '<div class="alert alert-danger">تأكد من إدخال إسم المستخدم و كلمة المرور  &ensp;<span class= "glyphicon glyphicon-send"></span></div>';
        } else {
            $query = "select * from account where password='$password' AND username='$username'";
            $run = mysqli_query($con, $query);
            if ($run) {
                if (mysqli_num_rows($run)) {

                    $query = "select * from account INNER JOIN volunteer ON (account.Username = volunteer.VolunteerUsername) where account.Username = '$username' ";
                    $admin_query = "select * from account INNER JOIN admin ON (account.Username = admin.AdminUsername) where account.Username = '$username' ";


                    $admin_result = mysqli_query($con, $admin_query);
                    $result = mysqli_query($con, $query);


                    if ($admin_result) {

                        $row = mysqli_fetch_array($admin_result);
                        $_SESSION['id'] = $row['AdminID']; //here session is used and value of volunter id store in $_SESSION.
                        $_SESSION['username'] = $row['Username'];
                        $_SESSION['admin'] = 'true';
                    } else if ($result) {

                        $row = mysqli_fetch_array($result);
                        $_SESSION['id'] = $row['VolunteerID']; //here session is used and value of volunter id store in $_SESSION.
                        $_SESSION['username'] = $row['Username'];
                        $_SESSION['admin'] = 'false';
                    } else
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
                                <a  class="active" id="login-form-link">تسجيل دخول</a>
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
                                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="إسم المستخدم" value="" > 
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        </div>
                                        <div style="margin-bottom: 25px" class="input-group"> 

                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="********">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
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
    <br>




    <!--Footer of the page -->

    <?php include('includes/footer.php'); ?>

