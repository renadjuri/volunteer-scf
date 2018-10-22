<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = " إنشاء حساب جديد"; //page title to pass it to the header
include("includes/Header2.php"); // the header of the page
?>

<!-- Page Header -->
<header class="masthead inner" style="background-image: url('images/header-7.jpg')">
	<div class="overlay"></div>
	<div class="container-fluid p-r-l-51 p-t-160 ">
	  <div class="row">
	    <div class="col-lg-12 col-md-12 mx-auto">
	      <div class="">
	        <h2 class="yellow-text">إنشاء حساب جديد</h2>
                              <h4 class="subheading white-text">قم بإدخال البيانات المطلوبة</h4>

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

<link href="css\style-login.css" rel="stylesheet" type="text/css" />
<body>
    <?php
    require 'includes/connection.php'; //connecting to the database
    mysqli_set_charset($con, "utf8");
    $errName = $errMiddleName = $errLastName = $errID = $errnationality = $errCity = $errPhone = $erremail = $errUsername = $errPassword = $errConfirm = $errorUser = $errUser = $msg = $gender = $errwork = $errsector= "";
    if (isset($_POST['register-submit'])) {
        $nationalID = $_POST['nationalID'];
        $FirstName = $_POST['FirstName'];
        $MiddleName = $_POST['MiddleName'];
        $LastName = $_POST['LastName'];
        $gender = $_POST['gender'];
        $nationality = $_POST['nationality'];
        $city = $_POST['city'];
        $birthdate = $_POST['birthdate'];
        $degree = $_POST['degree'];
        $workstatus = $_POST['workstatus'];
        $worktype = $_POST['worktype'];
        $sector = $_POST['sector'];
        $MobileNumber = $_POST['phone'];
        $Email = $_POST['email'];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];
// Signup validation
        if (empty($_POST["FirstName"])) {
            $errName = 'الرجاء إدخال الاسم ';
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
       /* if (empty($_POST["nationality"])) {
            $errnationality = "الرجاء ادخال الجنسية ";
        } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["nationality"])) {
            $errnationality = "الجنسية المدخلة غير صحيحة";
        }*/
        if (empty($_POST["city"])) {
            $errCity = "الرجاء ادخال المدينة ";
        } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["city"])) {
            $errCity = "المدينة المدخلة غير صحيحة";
        }
        if (empty($_POST["worktype"])) {
            $errwork = 'الرجاء ادخال الوظيفة';
        } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["worktype"])) {
            $errwork = "الوظيفة المدخلة غير صحيحة";
        }
        if (empty($_POST["sector"])) {
            $errsector = 'الرجاء ادخال جهة التوظيف';
        } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["sector"])) {
            $errsector = "جهة التوظيف المدخلة غير صحيحة";
        }
           
        if (empty($_POST["phone"])) {
            $errPhone = "الرجاء ادخال رقم الجوال";
        } else if (!preg_match("/[ 0-9 ]/", $_POST["phone"])) {
            $errPhone = "رقم الجوال المدخل غير صحيح";
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
        if (!$errName && !$errMiddleName && !$errLastName && !$errID && !$errnationality && !$errCity && !$errPhone &&
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
            $user_check_query = "SELECT * FROM Volunteer WHERE  VolunteerID='$nationalID' LIMIT 1";
            $result = mysqli_query($con, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            if ($user) { // if user exists
                if ($user['VolunteerID'] === $nationalID) {
                    $errUser = "رقم السجل الوطني موجود مسبقاً";
                }
            }
            // Finally, register user if there are no errors in the form
            if (!$errUser && !$errorUser) {
                $password1 = md5($password); //encrypt the password before saving in the database
                $query1 = "INSERT INTO account (UserName, password, Email)
                 VALUES ('" . $username . "', '" . $password1 . "', '" . $Email . "' );";
                $query = "INSERT INTO volunteer (VolunteerID, FirstName, MiddleName, LastName, MobileNumber, DateOfBirth, Gender, nationality, residence, Qualification, WorkStatus, WorkType, Sector ,VolunteerUsername)
                VALUES ('" . $nationalID . "', '" . $FirstName . "', '" . $MiddleName . "', '" . $LastName . "', '" . $MobileNumber . "', '" .
                        $birthdate . "', '" . $gender . "', '" . $nationality . "', '" . $city . "', '" . $degree . "', '" . $workstatus . "', '" . $worktype . "', '" . $sector . "', '" . $username . "' );";

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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="panel panel-login">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12"> 
                                <form method="post" id="register-form"  role="form" style="display: block;"
                                      autocomplete="on">
                                    <fieldset>
                                                 <h3 class="sub-heading">المعلومات الشخصية</h3>

<div class="row">
     <div class="form-group col-lg-4">

                                                    <input class='form-control' style="  text-align: right;" type="text" name="FirstName" id="username" tabindex="1" class="form-control" placeholder="الاسم الأول" 
                                                           value="<?php
                                                           if (isset($_POST['FirstName'])) {
                                                               echo $_POST['FirstName'];
                                                           }
                                                           ?>"
                                                           data-toggle="tooltip" data-placement="bottom" title="اسمك كما تريد أن يظهر في الشهادة">
                                                    <div>  <?php echo "<p class = 'text-danger'>$errName</p>"; ?> </div>

                                                </div>
                                           

                                                <div class="form-group col-lg-4">

                                                    <input class='form-control' style="  text-align: right;" type="text" name="MiddleName" id="username" tabindex="1" class="form-control" placeholder="اسم الأب"
                                                           value="<?php
                                                           if (isset($_POST['MiddleName'])) {
                                                               echo $_POST['MiddleName'];
                                                           }
                                                           ?>"
                                                           data-toggle="tooltip" data-placement="bottom" title="اسمك كما تريد أن يظهر في الشهادة">
                                                    <div>  <?php echo "<p class = 'text-danger'>$errMiddleName</p>"; ?> </div>
                                                </div>

                                                 <div class="form-group col-lg-4 ">

                                                <input class='form-control' style="  text-align: right;" type="text" name="LastName" id="username" tabindex="1" class="form-control" placeholder="العائلة" 
                                                       value="<?php
                                                       if (isset($_POST['LastName'])) {
                                                           echo $_POST['LastName'];
                                                       }
                                                       ?>">
                                                <div>  <?php echo "<p class = 'text-danger'>$errLastName</p>"; ?> </div>
                                            </div>

                                               
                                        <div class="form-group col-lg-4">
                                            <input  type="text" name="nationalID"  style="  text-align: right;" id="nationalID" maxlength="10" tabindex="1" class="form-control" 
                                                   placeholder="رقم السجل المدني/الإقامة" 
                                                   value="<?php
                                                   if (isset($_POST['nationalID'])) {
                                                       echo $_POST['nationalID'];
                                                   }
                                                   ?>" 
                                                   data-toggle="tooltip" data-placement="bottom" title="السجل المدني">
                                            <div>  <?php echo "<p class = 'text-danger'>$errID</p>"; ?> </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <div class="radio " >


                                                    <label><input type="radio" name="gender" value="F" checked>أنثى</label>

                                                    <label><input type="radio" name="gender" value="M">ذكر</label>
                                                    <label>الجنس</label>
                                            </div>
                                        </div>
                                  
                                       
                                        <div class="form-group col-lg-4">
                                            <input type="text" name="city" style="  text-align: right;" id="city" tabindex="1" class="form-control" placeholder="مكان الإقامة" 
                                                   value="<?php
                                                   if (isset($_POST['city'])) {
                                                       echo $_POST['city'];
                                                   }
                                                   ?>" 
                                                   data-toggle="tooltip" data-placement="bottom" title="مكان الإقامة">
                                            <div>  <?php echo "<p class = 'text-danger'>$errCity</p>"; ?> </div>
                                        </div>
                                        <div class="form-group col-lg-4">
                                         

                                            <input type="date" name="birthdate" style="  text-align: right;" id="bithdate" tabindex="1" class="form-control" placeholder="تاريخ الميلاد" 
                                                   value="<?php
                                                   if (isset($_POST['birthdate'])) {
                                                       echo $_POST['birthdate'];
                                                   }
                                                   ?>"  >

                                        </div></div>


                                        <fieldset>
                                            <h3 class="sub-heading">معلومات الدراسة / الوظيفة</h3>
<div class="row">
                                            <div class="form-group col-lg-4">
                                             

                                                <select class="form-control" name="degree" id="degree">
                                                    <option selected disabled="">المؤهل العلمي</option>
                                                    <option value="متوسط">متوسط</option>
                                                    <option value="ثانوي">ثانوي</option>
                                                    <option value ="بكالوريوس">بكالوريوس</option>
                                                    <option value="ماجستير">ماجستير</option>
                                                    <option value="دكتوراه">دكتوراه</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group col-lg-4">
                                           

                                                <select class="form-control" name="nationality" id="nationality">
                                                    <option selected disabled="">الجنسية</option>
                                                    <option value="السعودية">السعودية</option>
                                                    <option value="السودان">السودان</option>
                                                    <option value ="الجزائر">الجزائر</option>
                                                    <option value="المغرب">المغرب</option>
                                                    <option value="تونس">تونس</option>
                                                    <option value="سوريا">سوريا</option>
                                                    <option value="فلسطين">فلسطين</option>
                                                    <option value ="العراق">العراق</option>
                                                    <option value="اليمن">اليمن</option>
                                                    <option value="الإمارات">الإمارات</option>
                                                    <option value="عمان">عمان</option>
                                                    <option value="قطر">قطر</option>
                                                    <option value ="الكويت">الكويت</option>
                                                    <option value="البحرين">البحرين</option>
                                                    <option value="الأردن">الأردن</option>
                                                    <option value="لبنان">لبنان</option>
                                                    <option value="ليبيا">ليبيا</option>
                                                    <option value ="موريتانيا">موريتانيا</option>
                                                    <option value="الصومال">الصومال</option>
                                                    <option value="جيبوتي">جيبوتي</option>
                                                    <option value="تركيا">تركيا</option>
                                                    <option value="ماليزيا">ماليزيا</option>
                                                    <option value ="اندونيسيا">اندونيسيا</option>
                                                    <option value="باكستان">باكستان</option>
                                                    <option value="الهند">الهند</option>
                                                    <option value="تشاد">تشاد</option>
                                                    <option value="إريتريا">إريتريا</option>
                                                    <option value ="أثيوبيا">أثيوبيا</option>
                                                    <option value="نيجيريا">نيجيريا</option>
                                                    <option value="مالي">مالي</option>
                                                    <option value="بريطانيا">بريطانيا</option>
                                                    <option value="فرنسا">فرنسا</option>
                                                    <option value ="أيطاليا">إيطاليا</option>
                                                    <option value="روسيا">روسيا</option>
                                                    <option value="الولايات المتحدة">الولايات المتحدة</option>
                                                    <option value="كندا">كندا</option>
                                                    <option value="استراليا">استراليا</option>
                                                    <option value ="دولة أفريقية أخرى">دولة أفريقية أخرى</option>
                                                    <option value="دولة آسيوية أخرى">دولة آسيوية أخرى</option>
                                                    <option value="دولة أوروبية أخرى">دولة أوروبية أخرى</option>
                                                    <option value="دولة أمريكية أخرى">دولة أمريكية أخرى</option>
                                                   
                                                </select>
                                            </div>

                                            <div class="form-group col-lg-4">

                                                <select class="form-control" name="workstatus" id="degree">
                                                    <option selected disabled="">الوظيفة</option>
                                                    <option value="طالب">طالب</option>
                                                    <option value ="موظف">موظف</option>
                                                    <option value="لا أعمل">لا أعمل</option>

                                                </select>
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <input type="text" name="worktype" style="  text-align: right;" id="workstation" tabindex="1" class="form-control" placeholder="المسمى الوظيفي" 
                                                       value="<?php
                                                       if (isset($_POST['worktype'])) {
                                                           echo $_POST['worktype'];
                                                       }
                                                       ?>" 
                                                       data-toggle="tooltip" data-placement="bottom" title="اسم الوظيفة">
                                                <div>  <?php echo "<p class = 'text-danger'> $errwork</p>"; ?> </div>
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <input type="text" name="sector" style="  text-align: right;" id="workstation" tabindex="1" class="form-control" placeholder="جهه العمل" 
                                                       value="<?php
                                                       if (isset($_POST['sector'])) {
                                                           echo $_POST['sector'];
                                                       }
                                                       ?>" 
                                                       data-toggle="tooltip" style="  text-align: right;" data-placement="bottom" title="اسم مكان العمل">
                                                <div>  <?php echo "<p class = 'text-danger'> $errsector</p>"; ?> </div>
                                            </div>

</div>
                                        </fieldset>
                                        <fieldset>
                                               <h3 class="sub-heading">معلومات التواصل</h3>

<div class="row">
                                            <div class="form-group col-lg-4">
                                                <input type="phone" name="phone" style="  text-align: right;" id="phone" tabindex="1" class="form-control" placeholder="رقم الهاتف/الجوال" 
                                                       value="<?php
                                                       if (isset($_POST['phone'])) {
                                                           echo $_POST['phone'];
                                                       }
                                                       ?>" 
                                                       data-toggle="tooltip" data-placement="bottom" title="رقم الهاتف" maxlength="10">
                                                <div>  <?php echo "<p class = 'text-danger'>$errPhone</p>"; ?> </div>
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <input type="email" name="email" style="  text-align: right;" id="email" tabindex="1" class="form-control" placeholder="البريد الإلكتروني"
                                                       value="<?php
                                                       if (isset($_POST['email'])) {
                                                           echo $_POST['email'];
                                                       }
                                                       ?>"  
                                                       data-toggle="tooltip" data-placement="bottom" title="البريد الإلكتروني">
                                                <div>  <?php echo "<p class = 'text-danger'>$erremail</p>"; ?> </div>
                                            </div>
                                        </div>
                                        </fieldset>

                                        <fieldset>
                                                                                           <h3 class="sub-heading">معلومات الحساب</h3>
<div class="row">

                                            <div class="form-group col-lg-4">
                                                <input type="text" name="username" style="  text-align: right;" id="username" tabindex="1" class="form-control" placeholder="إسم المستخدم" 
                                                       value="<?php
                                                       if (isset($_POST['username'])) {
                                                           echo $_POST['username'];
                                                       }
                                                       ?>" 
                                                       data-toggle="tooltip" data-placement="bottom" title="اسم المستخدم">
                                                <div>  <?php echo "<p class = 'text-danger'>$errUsername</p>"; ?> </div>
                                            </div>

                                            <div class="form-group col-lg-4">
                                                <input type="password" name="password" style="  text-align: right;" id="password" tabindex="2" class="form-control" placeholder="كلمة المرور" 
                                                       data-toggle="tooltip" data-placement="bottom" title="كلمة المرور"
                                                       value="<?php
                                                       if (isset($_POST['password'])) {
                                                           echo $_POST['password'];
                                                       }
                                                       ?>" >
                                                <br>
                                                اظهار كلمة المرور   <input type="checkbox" onclick="myFunction()"> 
                                                <div>  <?php echo "<p class = 'text-danger'>$errPassword</p>"; ?> </div>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <input type="password" name="confirm-password" style="  text-align: right;" id="confirm-password" tabindex="2" class="form-control" placeholder="اعادة كلمة المرور" 
                                                       data-toggle="tooltip" data-placement="bottom" title="اعد كتابة كلمة المرور">
                                                <div>  <?php echo "<p class = 'text-danger'>$errConfirm</p>"; ?> </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                             <h3 class="sub-heading">الإقرار</h3>
<div class="row">
                                            <div class="form-group col-lg-12">
                                                <a href="includes/CharterofVolunteerism.pdf" target="_blank" data-toggle="tooltip" data-placement="bottom" title="اقرأ الشروط" required>
                                                    <b>أقر أني اطلعت على ميثاق التطوع</b> 
                                                </a> 
                                                <input type="checkbox" name="check" value="ok" required >  

                                                </input>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <a href="includes/Terms_and_Conditions.pdf" target="_blank" data-toggle="tooltip" data-placement="bottom" title="اقرأ الشروط" required> 
                                                    <b>أتعهد بالإلتزام بشروط و أحكام التطوع في الجمعية السعودية للسرطان</b> </a> 
                                                <input type="checkbox" name="check2" value="ok" required> 

                                                </input>
                                            </div>
                                        </div>
                                        </fieldset>
                                        

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-4 col-sm-offset-4">
                                                                                                             <input type="submit" name="register-submit" id="register-submit" tabindex="4" value="سجل الآن" class="btn btn-block btn-success">


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
    </div>


    <!--Footer of the page -->

    <?php include('includes/footer.php'); ?>
