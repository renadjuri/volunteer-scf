<!DOCTYPE html>

<?php
$page_title = "تسجيل الدخول"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>
<!-- Style CSS -->

<link href="css/style-login.css" rel="stylesheet" type="text/css" />
<body>


    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="#" class="active" id="login-form-link">تسجيل دخول</a>
                            </div>
                            <div class="col-xs-6">
                                <a href="#" id="register-form-link">إنشاء حساب</a>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if (empty($_SESSION['id'])) { ?>
                                    <form method="post" id="login-form" action="login-signup.php"  role="form" style="display: block;">

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
                                                    <input type="submit" name="login-submit" tabindex="4" class="form-control btn btn-login" value="تسجيل دخول">
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
                                    </form>
                                
                                <?php } ?>
                                <form id="register-form" action="#" method="post" role="form" style="display: none;">
                                    <div class="form-group">
                                        <div class="radio">
                                            <center> <label><input type="radio" name="optradio">أنثى</label>

                                                <label><input type="radio" name="optradio">ذكر</label>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <input type="text" name="FirstName" id="username" tabindex="1" class="form-control" placeholder="الاسم الأول" value="" required>
                                    </div>

                                    <div class="form-group">

                                        <input type="text" name="MiddleName" id="username" tabindex="1" class="form-control" placeholder="اسم الأب" value="" required>
                                    </div>
                                    <div class="form-group">

                                        <input type="text" name="LastName" id="username" tabindex="1" class="form-control" placeholder="العائلة" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nationalID" id="nationalID" tabindex="1" class="form-control" placeholder="الرقم السجل المدني/الإقامة" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="nationality" id="nationality" tabindex="1" class="form-control" placeholder="الجنسية" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="city" id="city" tabindex="1" class="form-control" placeholder="مكان الإقامة" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="phone" name="phone" id="email" tabindex="1" class="form-control" placeholder="رقم الهاتف/الجوال" value="" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="البريد الإلكتروني" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <span class="input-group-addon">المؤهل العلمي </span>

                                        <select class="form-control" id="degree">
                                            <option>ثانوي</option>
                                            <option>بكالوريوس</option>
                                            <option>ماجستير</option>
                                            <option>أخرى</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <span class="input-group-addon">تاريخ  الميلاد </span>
                                        <input type="date" name="nationalID" id="nationalID" tabindex="1" class="form-control" placeholder="تاريخ الميلاد" value="">
                                    </div>


                                    <div class="form-group">

                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="إسم المستخدم" value=""  required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="كلمة المرور" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="أعد كلمة المرور" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="سجل الآن">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>


    <!-- LOGIN -->  
    <?php
    include("includes/database.php");
    mysqli_set_charset($con, "utf8");

    if (isset($_POST['login-submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (empty($username) || empty($password)) {
            //$msg = "Username or Password is empty";
            echo '<div class="alert alert-warning"><strong>إنتبه! </strong>تأكد من إدخال إسم المستخدم و كلمة المرور </div>';
        } else {
            $query = "select * from account where password='$password' AND username='$username'";
            $run = mysqli_query($con, $query);

            if (mysqli_num_rows($run)) {



                $query = "select * from account INNER JOIN volunteer ON (account.Username = volunteer.VolunteerUsername) where account.Username = '$username' ";

                $result = mysqli_query($con, $query);

                $admin_query = "select * from account INNER JOIN admin ON (account.Username = admin.AdminUsername) where account.Username = '$username' ";
                $admin_result = mysqli_query($con, $admin_query);

                if ($admin_result && $result) {
                    if ($result) {

                        $row = mysqli_fetch_array($result);
                        $_SESSION['id'] = $row['VolunteerID']; //here session is used and value of volunter id store in $_SESSION.
                        $_SESSION["username"] = $row['Username'];
                        $_SESSION['admin'] = "false";
                    } else {

                        $row = mysqli_fetch_array($admin_result);
                        $_SESSION["username"] = $row['Username'];

                        $_SESSION['admin'] = "true";
                    }
                    echo '<div class="alert alert-success">تم تسجيل الدخول</div>';
                    echo "<script>window.open('index.php','_self')</script>";
                } else {

                    echo '<div class="alert alert-danger">بياناتك غير مسجلة لدينا ، قم بئنشاء حساب جديد</div>';
                }
            } else {

                //$msg = "Username or Password is invalid";
                echo '<div class="alert alert-danger"><strong>إنتبه! </strong>الإسم المدخل أو كلمة المرور غير صحيحة </div>';
            }
        }
    }
    ?>
    <!--Footer of the page -->

    <?php include('includes/footer.php'); ?>
    <script>
        $(function () {

            $('#login-form-link').click(function (e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#register-form-link').click(function (e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });

        });
    </script>

</script>
