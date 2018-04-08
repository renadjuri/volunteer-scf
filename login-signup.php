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
                                    </form>

                                <?php } ?>
                                <form method="post" id="register-form"  role="form" style="display: none;">
                                    <div class="form-group">
                                        <div class="radio" name="gender">
                                            <center> <label><input type="radio" name="female">أنثى</label>

                                                <label><input type="radio" name="male">ذكر</label>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <input type="text" name="FirstName" id="username" tabindex="1" class="form-control" placeholder="الاسم الأول" 
                                               value="" ata-toggle="tooltip" data-placement="bottom" title="اسمك كما تريد أن يظهر في الشهادة">
                                    </div>

                                    <div class="form-group">

                                        <input type="text" name="MiddleName" id="username" tabindex="1" class="form-control" placeholder="اسم الأب"
                                               value=""  ata-toggle="tooltip" data-placement="bottom" title="اسمك كما تريد أن يظهر في الشهادة">
                                    </div>
                                    <div class="form-group">

                                        <input type="text" name="LastName" id="username" tabindex="1" class="form-control" placeholder="العائلة" 
                                               value=""  ata-toggle="tooltip" data-placement="bottom" title="اسمك كما تريد أن يظهر في الشهادة">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nationalID" id="nationalID" tabindex="1" class="form-control" 
                                               placeholder="رقم السجل المدني/الإقامة" value=""  ata-toggle="tooltip" data-placement="bottom" title="السجل المدني">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="nationality" id="nationality" tabindex="1" class="form-control"
                                               placeholder="الجنسية" value=""  ata-toggle="tooltip" data-placement="bottom" title="الجنسية">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="city" id="city" tabindex="1" class="form-control" placeholder="مكان الإقامة" 
                                               value=""  ata-toggle="tooltip" data-placement="bottom" title="مكان الإقامة">
                                    </div>

                                    <div class="form-group">
                                        <input type="phone" name="phone" id="phone" tabindex="1" class="form-control" placeholder="رقم الهاتف/الجوال" 
                                               value=""  ata-toggle="tooltip" data-placement="bottom" title="رقم الهاتف">
                                    </div>

                                    <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="البريد الإلكتروني"
                                               value=""  ata-toggle="tooltip" data-placement="bottom" title="البريد الإلكتروني">
                                    </div>
                                    <div class="form-group">
                                        <span class="input-group-addon"ata-toggle="tooltip" data-placement="bottom" title="المؤهل العلمي">المؤهل العلمي </span>

                                        <select class="form-control" name="degree" id="degree">
                                            <option>ثانوي</option>
                                            <option>بكالوريوس</option>
                                            <option>ماجستير</option>
                                            <option>أخرى</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <span class="input-group-addon" ata-toggle="tooltip" data-placement="bottom" title="تاريخ الميلاد">تاريخ  الميلاد </span>
                                        <input type="date" name="birthdate" id="nationalID" tabindex="1" class="form-control" placeholder="تاريخ الميلاد" value="" >
                                    </div>


                                    <div class="form-group">

                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="إسم المستخدم" value="" 
                                               ata-toggle="tooltip" data-placement="bottom" title="اسم المستخدم">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="كلمة المرور" 
                                               ata-toggle="tooltip" data-placement="bottom" title="كلمة المرور">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="أعادة كلمة المرور" 
                                               ata-toggle="tooltip" data-placement="bottom" title="اعد كتابة كلمة المرور">
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="check" value="ok" >  
                                        <a href="includes/CharterofVolunteerism.pdf" target="_blank" ata-toggle="tooltip" data-placement="bottom" title="اقرأ الشروط">
                                            <b>أقر أني اطلعت على ميثاق التطوع</b> 
                                        </a> 
                                        </input>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="check2" value="ok" >  
                                        <a href="includes/Terms_and_Conditions.pdf" target="_blank" ata-toggle="tooltip" data-placement="bottom" title="اقرأ الشروط">
                                            <b>أتعهد بالإلتزام بشروط و أحكام التطوع في الجمعية السعودية للسرطان</b>
                                        </a> 
                                        </input>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit" id="register-submit" tabindex="4"
                                                       class="form-control btn btn-register" value="سجل الآن">

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
            echo '<div class="alert alert-danger"><strong>إنتبه! </strong>تأكد من إدخال إسم المستخدم و كلمة المرور </div>';
        } else {
            $query = "select * from account where password='$password' AND username='$username'";
            $run = mysqli_query($con, $query);
            if ($run) {
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
                } echo '<div class="alert alert-danger"><strong>إنتبه! </strong>الإسم المدخل أو كلمة المرور غير صحيحة </div>';
            } else {

                //$msg = "Username or Password is invalid";
                echo '<div class="alert alert-danger"><strong>إنتبه! </strong>الإسم المدخل أو كلمة المرور غير صحيحة </div>';
            }
        }
    }
    ?>

    <!-- Signup -->  
    <?php
    include("includes/database.php");
    mysqli_set_charset($con, "utf8");
    if (isset($_POST['register-submit'])) {

        $FirstName = $_POST['FirstName'];
        $MiddleName = $_POST['MiddleName'];
        $LastName = $_POST['LastName'];
        $nationalID = $_POST['nationalID'];
        $nationality = $_POST['nationality'];
        $city = $_POST['city'];
        $MobileNumber = $_POST['phone'];
        $Email = $_POST['email'];
        $qualification = $_POST['degree'];
        $birthdate = $_POST['birthdate'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        if (empty($FirstName) || empty($MiddleName) || empty($LastName) || empty($nationalID) || empty($nationality) || empty($city) || empty($MobileNumber) || empty($Email) || empty($qualification) || empty($birthdate) || empty($username) || empty($password) || empty($confirm_password)
        ) {
            //msg if one of the fields is empty";
            echo '<div class="alert alert-danger"><strong>إنتبه! </strong>تأكد من إدخال جميع البيانات </div>';
        } else {
            $query = "INSERT INTO volunteer (VolunteerID, FirstName, MiddleName, LastName, MobileNumber, DateOfBirth, Gender, nationality, residence, Qualification) 
                VALUES ('" . $VolunteerID . "', '" . $FirstName . "', '" . $MiddleName . "', '" . $LastName . "', '" . $MobileNumber . "', '" .
                    $birthdate . "', '" . $gender . "', '" . $nationality . "', '" . $residence . "', '" . $qualification . "' );";

            $result = mysqli_query($con, $query);
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
