<?php
include("includes/Header.php"); // the header of the page
//$_SESSION['admin'] = "true"; //000
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");
$page = 'admin_personal_information_tab'; //page title to pass it to admin profile tabs
include("includes/admin_tabs.php"); // Admin profile tabs
?>
<style type="text/css">
    body{

        background-size:cover;
        background-attachment:fixed;
    }
    a:hover{
        text-decoration: none;
    }
</style>
<body>

<?php
$query = 'select AdminID, FirstName, MiddleName, LastName, AdminUsername, Email, password from admin, account where account.Username = admin.AdminUsername and account.Username = "' . $_SESSION["username"] . '"';
$result = mysqli_query($con, $query);

$FnameError = $MnameError = $LnameError = $EmailError = "";

$numRows = mysqli_num_rows($result);
if ($numRows <= 0) {
    echo "<br> نعتذر لقد حدث خلل، نرجو الخروج و محاولة الدخول للنظام مرة أخرى";  //0000
} else {
    while ($row = mysqli_fetch_array($result)) {
        foreach ($row as $id => $val) {
            $AdminID = $row['AdminID'];
            $FirstName = $row['FirstName'];
            $MiddleName = $row['MiddleName'];
            $LastName = $row['LastName'];
            $AdminUsername = $row['AdminUsername'];
            $Email = $row['Email'];
            $password = $row['password'];
            $password = md5($password);
        }
    }
}

if (isset($_POST['update'])) {

    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST["email"];

    //Check if all fields are empty if true show error message 
    if (empty($_POST["FirstName"]) && empty($_POST["MiddleName"]) &&
            empty($_POST["LastName"]) && empty($_POST["email"])) {
        echo "<p class='error'>تأكد من تعبئة البيانات المطلوبة 	</p>";
    } else {
        //Email validation  
        if (empty($Email)) {
            $EmailError = "تأكد من تعبئة البيانات المطلوبة.";
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $EmailError = "البريد الإلكتروني غير صحيح";
        }
        //First Name validation 
        if (empty($_POST["FirstName"])) {
            $FnameError = "تأكد من تعبئة البيانات المطلوبة.";
        } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["FirstName"])) {
            $FnameError = "الإسم المدخل غير صحيح";
        }
        //Middle Name validation 
        if (empty($_POST["MiddleName"])) {
            $MnameError = "تأكد من تعبئة البيانات المطلوبة.";
        } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["MiddleName"])) {
            $MnameError = "اسم الأب المدخل غير صحيح";
        }
        //Last Name validation 
        if (empty($_POST["LastName"])) {
            $LnameError = "تأكد من تعبئة البيانات المطلوبة.";
        }else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["LastName"])) {
                $LnameError = "اسم العائلة المدخل غير صحيح";
            }


        if (!$FnameError && !$MnameError && !$LnameError && !$EmailError) {
            $query = "UPDATE admin, account SET FirstName='$FirstName' , MiddleName = '$MiddleName' ,LastName='$LastName', Email='$Email' WHERE account.Username=admin.AdminUsername and admin.AdminUsername = '" . $_SESSION["username"] . "'";
            $result = mysqli_query($con, $query);

           
            //update admin id
            //update admin set AdminID='2130009111' where AdminUsername='admin'
            //  echo "<script type='text/javascript'>alert(' after  submitted successfully!')</script>";
            //echo ' <div class="alert alert-success alert-dismissible" >تم تحديث البيانات بنجاح  &ensp;<span class= "glyphicon glyphicon-send" ></span></div>';
            //  echo' <div runat="server" id="div_warning" visible="false" class="alert alert-danger alert-dismissible" style="width: 100%">';
            //echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
            //header('location:volunteerprofile.php');
        }
    }
}
?>
<!-- Tab Name -->
<legend> <h1>المعلومات الشخصية</h1></legend>
<div class='row'>
    <div class='[ col-sm-9 col-sm-offset-2 col-md-9 ]'> 
  
        <form method="post" action="admin_personal_information_tab.php" style="  text-align: right;">
            <div class="form-group">
                <table class='table-striped'>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="AdminID" value="<?php print ($AdminID); ?>" readonly></td>
                        <td> <label>السجل المدني/الإقامة</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;"  type="text" name="AdminUsername" value="<?php print ($AdminUsername); ?>" readonly></td>
                        <td> <label>اسم المستخدم</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="FirstName" value="<?php print ($FirstName); ?>" required>
                            <div>  <?php echo "<p class = 'text-danger'>$FnameError</p>"; ?> </div></td>
                        <td><label>  الاسم الأول</label></td>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="MiddleName" value="<?php print ($MiddleName); ?>" required>
                            <div>  <?php echo "<p class = 'text-danger'>$MnameError</p>"; ?> </div></td><td><label> اسم الأب</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="LastName" value="<?php print ($LastName); ?>" required>
                            <div>  <?php echo "<p class = 'text-danger'>$LnameError</p>"; ?> </div></td><td><label> اسم العائلة</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;"  type="email" name="email" value="<?php print ($Email); ?>" required>
                            <div>  <?php echo "<p class = 'text-danger'>$EmailError</p>"; ?> </div></td><td><label> البريد الإلكتروني </label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="password" name="password" value="<?php print ($password); ?>" readonly required></td>
                        <td><label>كلمة المرور</label></td>
                    </tr>
                   <!-- <tr>
                        <td><button class="btn" style="margin-right:20px;" name="changePassword" type="">تغيير كلمة المرور</button></td>
                        <td></td>
                    </tr>-->
                </table>
                <br><br>
                <center>
                    <button style="margin-right:10px;" class="btn btn-danger" name="cancel" type="reset">إلغاء</button>&nbsp;   <button style="margin-right:50%;" class="btn btn-success" name="update" type="submit">حفظ التعديلات</button>		
                </center>
            </div>
        </form>
    </div>
</div>

