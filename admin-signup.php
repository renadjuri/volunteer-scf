
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

<?php
require 'includes/connection.php'; //connecting to the database
mysqli_set_charset($con, "utf8");
$errName = $errMiddleName = $errLastName = $errID = $erremail = $errUsername = $errPassword = $errConfirm = $errorUser = $errUser = $msg = "";
if (isset($_POST['register-submit'])) {
    $nationalID = $_POST['nationalID'];
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
// Signup validation
    if (empty($_POST["FirstName"])) {
        $errName = 'الرجاء ادخال الاسم ';
    } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["FirstName"])) {
        $errName = "الإسم المدخل غير صحيح";
    }
    if (empty($_POST["MiddleName"])) {
        $errMiddleName = "الرجاء ادخال الاسم ";
    } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["MiddleName"])) {
        $errMiddleName = "الإسم المدخل غير صحيح";
    }
    if (empty($_POST["LastName"])) {
        $errLastName = "الرجاء ادخال الاسم ";
    } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["LastName"])) {
        $errLastName = "الإسم المدخل غير صحيح";
    }
    if (empty($_POST["nationalID"])) {
        $errID = "الرجاء ادخال السجل المدني";
    } else if (!preg_match("/[ 0-9  ]/", $_POST["nationalID"])) {
        $errID = "الرقم المدخل غير صحيح";
    }

    if (empty($_POST["email"])) {
        $erremail = "الرجاء ادخال البريد الإلكتروني";
    } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $erremail = "البريد الإلكتروني غير صحيح";
    }
    if (empty($_POST["username"])) {
        $errUsername = "الرجاء ادخال اسم المستخدم";
    } else if (!preg_match("/[ 0-9 a-z A-Z]/", $_POST["username"])) {
        $errUsername = "اسم المستخدم يتكون من ارقام او حروف انجليزية";
    }
    if (empty($_POST["password"])) {
        $errPassword = "الرجاء ادخال كلمة المرور";
    } else if (!preg_match("/[ 0-9 a-z A-Z ا-ي ]/", $_POST["password"])) {
        $errPassword = "كلمة المرور تتكون من أرقام أو حروف ";
    }
    if ($password != $confirm_password) {
        $errConfirm = "كلمة المرور غير متطابقة";
    }
    if (!$errName && !$errMiddleName && !$errLastName && !$errID &&
            !$erremail && !$errUsername && !$errPassword && !$errConfirm) {
        // first check the database to make sure 
        // a user does not already exist with the same nationalID and/or email
        $user_check_query1 = "SELECT * FROM account WHERE Email='$Email' OR Username='$username' LIMIT 1";
        $result1 = mysqli_query($con, $user_check_query1);
        $user = mysqli_fetch_assoc($result1);
        if ($user) { // if user exists
            if ($user['Email'] === $Email) {
                $errorUser = "البريد الإلكتروني موجود مسبقاً";
            }
            if ($user['Username'] === $username) {
                $errorUser = "اسم المستخدم موجود مسبقاً";
            }
        }
        $user_check_query = "SELECT * FROM Admin WHERE  AdminID='$nationalID' LIMIT 1";
        $result = mysqli_query($con, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if user exists
            if ($user['AdminID'] === $nationalID) {
                $errUser = "رقم السجل الوطني موجود مسبقاً";
            }
        }
        // Finally, register user if there are no errors in the form
        if (!$errUser && !$errorUser) {
            $password1 = md5($password); //encrypt the password before saving in the database
            $query1 = "INSERT INTO account (UserName, password, Email)
                 VALUES ('" . $username . "', '" . $password1 . "', '" . $Email . "' );";
            $query = "INSERT INTO admin (AdminID, FirstName, MiddleName, LastName, AdminUsername)
                VALUES ('" . $nationalID . "', '" . $FirstName . "', '" . $MiddleName . "', '" . $LastName . "', '" . $username . "' );";

            mysqli_query($con, $query1);
            $result = mysqli_query($con, $query);
            if ($result) {
                //msg successfuly registered

                $msg = '<div class="alert alert-success">تم حفظ بياناتك بنجاح&ensp;<span class= "glyphicon glyphicon-send"></span></div>';
                echo "<script>window.open('login.php','_self')</script>";
            } else {
                $msg = '<div class="alert alert-danger">عذرا حدث خطأ أثناء التسجيل&ensp;<span class= "glyphicon glyphicon-send"></span> ، حاول مجددا لاحقاً</div>';
            }
        }
    } else {
        $msg = '<div class="alert alert-danger">تأكد من تعبئة البيانات &ensp;<span class= "glyphicon glyphicon-send"></span></div>';
    }
}
?>

<br>

<div class='row'>
    <div class='[ col-sm-12 col-sm-offset-1 col-md-9 ]'> 
        <div class="panel panel-login">
            <div class="panel-heading">
                <div class="row">       
                    <div class="col-lg-12">
                        <legend>   <h1>إنشاء حساب خاص بالادمن</h1>  </legend>
                    </div>
                </div>

            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12"> 
                        <form method="post" id="register-form"  role="form"
                              autocomplete="on">

                            <br>
                            <fieldset>
                                <br>
                                <legend>المعلومات الشخصية</legend>
                                <div class="col-lg-12">

                                    <div class="form-group col-lg-4 ">
                                        <input type="text" name="LastName" id="username" tabindex="1" class="form-control" placeholder="العائلة" 
                                               value="<?php
                                               if (isset($_POST['LastName'])) {
                                                   echo $_POST['LastName'];
                                               }
                                               ?>" 
                                               ata-toggle="tooltip" data-placement="bottom" title="العائلة">
                                        <div>  <?php echo "<p class = 'text-danger'>$errLastName</p>"; ?> </div>
                                    </div>
                                    <div class="form-group col-lg-4 ">
                                        <input type="text" name="MiddleName" id="username" tabindex="1" class="form-control" placeholder="اسم الأب"
                                               value="<?php
                                               if (isset($_POST['MiddleName'])) {
                                                   echo $_POST['MiddleName'];
                                               }
                                               ?>"
                                               ata-toggle="tooltip" data-placement="bottom" title="اسم الاب">
                                        <div>  <?php echo "<p class = 'text-danger'>$errMiddleName</p>"; ?> </div>
                                    </div>


                                    <div class="form-group col-lg-4 ">
                                        <input type="text" name="FirstName" id="username" tabindex="1" class="form-control" placeholder="الاسم الأول" 
                                               value="<?php
                                               if (isset($_POST['FirstName'])) {
                                                   echo $_POST['FirstName'];
                                               }
                                               ?>"
                                               ata-toggle="tooltip" data-placement="bottom" title="اسمك الاول">
                                        <div>  <?php echo "<p class = 'text-danger'>$errName</p>"; ?> </div>

                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="nationalID" id="nationalID" maxlength="10" tabindex="1" class="form-control" 
                                               placeholder="رقم السجل المدني/الإقامة" 
                                               value="<?php
                                               if (isset($_POST['nationalID'])) {
                                                   echo $_POST['nationalID'];
                                               }
                                               ?>" 
                                               ata-toggle="tooltip" data-placement="bottom" title="السجل المدني">
                                        <div>  <?php echo "<p class = 'text-danger'>$errID</p>"; ?> </div>
                                    </div>
                                </div>
                            </fieldset>
                            <br> 
                            <fieldset>

                                <legend>معلومات التواصل</legend>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="البريد الإلكتروني"
                                           value="<?php
                                           if (isset($_POST['email'])) {
                                               echo $_POST['email'];
                                           }
                                           ?>"  
                                           ata-toggle="tooltip" data-placement="bottom" title="البريد الإلكتروني">
                                    <div>  <?php echo "<p class = 'text-danger'>$erremail</p>"; ?> </div>
                                </div>
                            </fieldset>
                            <br>
                            <fieldset>

                                <legend>معلومات الحساب</legend>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="إسم المستخدم" 
                                           value="<?php
                                           if (isset($_POST['username'])) {
                                               echo $_POST['username'];
                                           }
                                           ?>" 
                                           ata-toggle="tooltip" data-placement="bottom" title="اسم المستخدم">
                                    <div>  <?php echo "<p class = 'text-danger'>$errUsername</p>"; ?> </div>
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="كلمة المرور" 
                                           ata-toggle="tooltip" data-placement="bottom" title="كلمة المرور"
                                           value="<?php
                                           if (isset($_POST['password'])) {
                                               echo $_POST['password'];
                                           }
                                           ?>" >
                                    اظهار كلمة المرور   <input type="checkbox" onclick="myFunction()"> 
                                    <div>  <?php echo "<p class = 'text-danger'>$errPassword</p>"; ?> </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="أعادة كلمة المرور" 
                                           ata-toggle="tooltip" data-placement="bottom" title="اعد كتابة كلمة المرور">
                                    <div>  <?php echo "<p class = 'text-danger'>$errConfirm</p>"; ?> </div>
                                </div>
                            </fieldset>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <input type="submit" name="register-submit" id="register-submit" tabindex="4"
                                               class="form-control btn btn-register" value="سجل الآن">

                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <?php echo $msg ?>	
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<br>


