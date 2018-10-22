<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = " إستعادة كلمة المرور"; //page title to pass it to the header
include("includes/Header2.php"); // the header of the page
?>
 <header class="masthead inner" style="background-image: url('images/header-7.jpg')">
          <div class="overlay"></div>
          <div class="container-fluid p-r-l-51 p-t-160 ">
            <div class="row">
              <div class="col-lg-12 col-md-12 mx-auto">
                <div class="">
                  <h2 class="yellow-text">استعادة كلمة المرور</h2>
                  <h4 class="subheading white-text">قم بإدخال بريدك الالكتروني</h4>
                </div>
              </div>
            </div>
          </div>
        </header>

<?php

if (isset($_POST["forgetpassword-submit"])) {
    $email = "";
    $email = $_POST['Email'];
    require 'includes/connection.php';
    $DB = "SELECT Username FROM account WHERE email='$email'";
    $res = mysqli_query($con, $DB);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $generated_password = substr(rand(999, 999999), 0, 8);
        $generated_password1 = md5($generated_password);
        $r = mysqli_fetch_assoc($res);
        $username = $r['Username'];
        $q = " UPDATE `account` SET `password`='$generated_password1' WHERE `Email`='$email'";
        mysqli_query($con, $q);
        
        $headers = 'From: admin@volunteer-scf.org';
        $to = $email;
        $subject = 'كلمة المرور الخاصة بك ';
        $message = "مرحبا" . $username ."\n". "تم تغيير كلمة المرور الخاصة بك الى\n " ."\n". $generated_password ."\n". "نرجوا الدخول و تغييرها \n شكرا لك";
        if (mail($to, $subject, $message, $headers)) {

            $result = '<div class="alert alert-success">تم ارسال كلمة المرور إلى البريد الإلكتروني الخاص بك</div>';
        } else {
            $result = '<div class="alert alert-danger">حدث خطأ اثناء استعادة كلمة المرور , حاول مجددا</div>';
        }
    } else {
        $result = '<div class="alert alert-danger">البريد الالكتروني غير موجود</div>';
    }
} else {
        $result = '';
    }
?>
<!-- Style CSS -->

<link href="css/style-login.css" rel="stylesheet" type="text/css" />
<body>
    <div class="container">
        <div class="row">
                <div class="panel panel-login">
                  
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="sub-heading">تهيئة كلمة المرور</h3>
                            </div>

                        </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <p> فضلا قم بإدخال بريدك الإلكتروني و سوف يتم إرسال تعليمات كلمة المرور الخاصة بك من خلال البريد الإلكتروني  </p> 
                            </div>
                             <div class="col-sm-4 col-sm-offset-4">
                                <form  method="post" class="p-t-20" >

                                    <div style="margin-bottom: 25px" class=""> 
                                        <input type="text" name="Email" id="username" tabindex="1" class="form-control text-right input-group w-full" placeholder="البريد الإلكتروني" value="" required> 
                                    </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="forgetpassword-submit"  tabindex="4" class="btn btn-block btn-success" value="إرسال">
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <?php echo $result; ?>	
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!--Footer of the page -->

    <?php include('includes/footer.php'); ?>