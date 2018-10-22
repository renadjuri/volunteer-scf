
<!DOCTYPE html>

<?php
$page_title = "تسجيل الدخول"; //page title to pass it to the header
include("includes/Header2.php"); // the header of the page
?>
  <header class="masthead inner" style="background-image: url('images/header-7.jpg')">
          <div class="overlay"></div>
          <div class="container-fluid p-r-l-51 p-t-160 ">
            <div class="row">
              <div class="col-lg-12 col-md-12 mx-auto">
                <div class="">
                  <h2 class="yellow-text">تسجيل الدخول</h2>
                  <h4 class="subheading white-text">قم بإدخال اسم المسخدم وكلمة المرور</h4>
                </div>
              </div>
            </div>
          </div>
        </header>
        

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
        $password1 = md5($password); //decrept the password before sending it to the database

        if (empty($username) || empty($password)) {
            //$msg = "Username or Password is empty";
            $loginmsg = '<div class="alert alert-danger">تأكد من إدخال إسم المستخدم و كلمة المرور  &ensp;<span class= "glyphicon glyphicon-send"></span></div>';
        } else {
            $query = "SELECT * FROM `account` WHERE username='$username' AND password='$password1'";
            $run = mysqli_query($con, $query);
            $numRows = mysqli_num_rows($run);
            if ($numRows <= 0) {
                $loginmsg = '<div class="alert alert-danger"><strong>إنتبه! </strong>الإسم المدخل أو كلمة المرور غير صحيحة  &ensp;<span class= "glyphicon glyphicon-send"></span></div>';
            } else {

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
            }
        }
    }
    ?>


    <div class="container">
      
                <div class="panel panel-login">
                        <div class="row">
                            <div class="col-lg-12">
                                             <h3 class="sub-heading">بيانات الدخول</h3>
                            </div>

                        </div>
                   
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if (empty($_SESSION['id'])) { ?>
                                    <form method="post" id="login-form"  role="form" style="display: block;">

<div class="row">
	<div class="col-md-6">
                                            <input type="text" name="username" id="username" tabindex="1" class="form-control text-right input-group w-full" placeholder="اسم المستخدم"  
                                                   value="<?php
                                    if (isset($_POST['username'])) {
                                        echo $_POST['username'];
                                    }
                                    ?>"  > 
                                            
	</div>
	<div class="col-md-6">
<input type="password" name="password" id="password" tabindex="2" class="form-control text-right input-group w-full" placeholder="********"
value="<?php if (isset($_POST['password'])) { echo $_POST['password'];} ?>">



	</div>

</div>
                                       


                                     
                                        <div class="row p-t-10">
<div class="col-md-12">
                                           إظهار كلمة المرور   <input type="checkbox" onclick="myFunction()">
                                       </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                            	  <div class="col-sm-4 col-sm-offset-4">
                                            	  	 <input id="submit" name="login-submit" type="submit" value="تسجيل دخول" tabindex="4" class="btn btn-block btn-success">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row p-t-10">
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

<!--Footer of the page -->
<?php include('includes/footer.php');
?>

