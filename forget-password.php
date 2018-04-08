<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = " إستعادة كلمة المرور"; //page title to pass it to the header
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
                            <div class="col-xs-12">
                                <a  class="active" id="login-form-link" >استعادة كلمة المرور</a>
                            </div>

                        </div>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <p> فضلا قم بإدخال بريدك الإلكتروني و سوف يتم إرسال تعليمات كلمة المرور الخاصة بك من خلال البريد الإلكتروني  </p> 
                                <form action="/action_page.php">

                                    <div style="margin-bottom: 25px" class="input-group"> 
                                        <input type="text" name="Email" id="username" tabindex="1" class="form-control" placeholder="البريد الإلكتروني" value="" required> 
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="forgetpassword-submit"  tabindex="4" class="form-control btn  btn-register" value="إرسال">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </form>

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