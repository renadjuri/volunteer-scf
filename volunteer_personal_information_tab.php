<!-- Tab Name -->
<legend> <h1>المعلومات الشخصية</h1></legend>
<?php
$query = 'select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, DateOfBirth, Gender, residence, nationality, Qualification, WorkStatus, WorkType, Sector,  Email, password from volunteer, account  where account.Username = volunteer.VolunteerUsername and account.Username = "' . $username . '"';
$result = mysqli_query($con, $query);


while ($row = mysqli_fetch_array($result)) {
    foreach ($row as $id => $val) {
        $VolunteerID = $row['VolunteerID'];
        $FirstName = $row['FirstName'];
        $MiddleName = $row['MiddleName'];
        $LastName = $row['LastName'];
        $MobileNumber = $row['MobileNumber'];
        $DateOfBirth = $row['DateOfBirth'];
        $Gender = $row['Gender'];
        $residence = $row['residence'];
        $nationality = $row['nationality'];
        $Qualification = $row['Qualification'];
        $WorkStatus = $row['WorkStatus'];
        $WorkType = $row['WorkType'];
        $Sector = $row['Sector'];
        $Email = $row['Email'];
        $Password = $row['password'];
    }
}
?>


<?php
//Check form method is post
// echo "<script type='text/javascript'>alert('before submitted successfully!')</script>";
if (isset($_POST['update'])) {

    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $LastName = $_POST['LastName'];
    $mobile = $_POST["mobile"];
    $bdate = $_POST["bdate"];
    $gender = $_POST["gender"];
    $residence = $_POST["residence"];
    $nationality = $_POST["nationality"];
    $Qualification = $_POST["Qualification"];
    $WorkStatus = $_POST["WorkStatus"];
    $WorkType = $_POST["WorkType"];
    $Sector = $_POST['Sector'];
    $Email = $_POST["email"];
    $Password = $_POST['repassword'];



    //Check if all fields are empty if true show error message 
    if (empty($_POST["FirstName"]) && empty($_POST["mobile"]) &&
            empty($_POST["bdate"]) && empty($_POST["gender"]) && empty($_POST["residence"]) &&
            empty($_POST["nationality"]) && empty($_POST["Qualification"]) &&
            empty($_POST["WorkStatus"]) && empty($_POST["email"])) {
        echo "<p class='error'>
						تأكد من تعبئة البيانات المطلوبة 	
						 </p>";
    } else {
        //Email validation  
        if (empty($Email)) {
            $EmailErr = "تأكد من تعبئة البيانات المطلوبة.";
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $EmailErr = "البريد الإلكتروني غير صحيح";
        }
        //First Name validation 
        if (empty($_POST["name"])) {
            $FnameErr = "تأكد من تعبئة البيانات المطلوبة.";
        } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["name"])) {
            $FnameErr = "الإسم المدخل غير صحيح";
        }
    }


    if ((!empty($FirstName)) && (!empty($mobile)) && (!empty($bdate)) &&
            (!empty($gender)) && (!empty($residence)) && (!empty($nationality)) && (!empty($Qualification)) && (!empty($WorkStatus)) && (!empty($Email))) {

        $query = "UPDATE volunteer SET FirstName='$FirstName' , MiddleName = '$MiddleName' ,LastName='$LastName', MobileNumber = '$mobile', DateOfBirth = '$bdate', Gender = '$gender', nationality = '$nationality', residence = '$residence', WorkStatus = '$WorkStatus', WorkType = '$WorkType', Sector = '$Sector' WHERE volunteer.VolunteerUsername = '$username'";
        $result = mysqli_query($con, $query);
        $password = md5($Password);

        $query = "UPDATE account SET Email='$Email',password =' $password' WHERE account.Username='$username'";
        $result = mysqli_query($con, $query);
        //  echo "<script type='text/javascript'>alert(' after  submitted successfully!')</script>";
        echo ' <div class="alert alert-success alert-dismissible" >تم تحديث البيانات بنجاح  &ensp;<span class= "glyphicon glyphicon-send" ></span></div>';
        //  echo' <div runat="server" id="div_warning" visible="false" class="alert alert-danger alert-dismissible" style="width: 100%">';
        echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
//header('location:volunteerprofile.php');
    }
}
?>
<br>
<div class="row">
    <div class="[ col-sm-8 col-sm-offset-3 col-md-12 ]">

        <form method="post" action="volunteerprofile.php" style="  text-align: right;">
            <div class="form-group">
                <table class='table-striped'>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="FirstName" value="<?php print ($FirstName); ?>" required></td>
                        <td><label>الاسم الأول </label></td>

                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="MiddleName" value="<?php print ( $MiddleName); ?>" required></td>
                        <td><label>اسم الاب </label></td>

                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="LastName" value="<?php print ( $LastName); ?>" required></td>
                        <td><label>اسم العائلة</label></td>

                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="date" name="bdate" value="<?php print ($DateOfBirth); ?>" required></td>
                        <td> <label>تاريخ الميلاد</label></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if ($Gender == 'F') {
                                echo "ذكر<input type='radio' name='gender' value='M' checked>";
                                echo "أنثى<input type='radio' name='gender' value='F' >";
                            } else {
                                echo "ذكر<input type='radio' name='gender' value='M' >";
                                echo "أنثى<input type='radio' name='gender' value='F' checked>";
                            }
                            ?>

                        </td>
                        <td><label> الجنس</label></td>	
                    </tr>
                    <tr> 
                        <td><input class='form-control' style="  text-align: right;" type="text"  name="nationality"  value="<?php print ($nationality); ?>" required> 

                        </td>
                        <td><label>الجنسية</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="Nid" value=" <?php print ($VolunteerID); ?>" readonly></td> 
                        <td><label> السجل المدني/الإقامة</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="residence" value="<?php print ($residence); ?>" required></td>	
                        <td><label>مكان الإقامة</label></td>	
                    </tr>

                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="email" name="email" value="<?php print ($Email); ?>" required> </td>
                        <td><label>البريد الإلكتروني</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="tel" name="mobile" value="<?php print ($MobileNumber); ?>" required> </td>
                        <td><label>رقم الجوال</label></td>
                    </tr>

                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="Qualification" value="<?php print ($Qualification); ?>" required> 

                        </td>
                        <td><label>المؤهل العلمي</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text"  name="WorkStatus"  value="<?php print ($WorkStatus); ?>" required>  
                        </td>
                        <td><label>الوظيفة</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="WorkType" value="<?php print ($WorkType); ?>" > </td>
                        <td><label>المسمى الوظيفي</label></td>
                    </tr>
                    <tr>
                        <td><input class='form-control' style="  text-align: right;" type="text" name="Sector" value="<?php print ($Sector); ?>" > </td>
                        <td><label>جهة العمل</label></td>
                    </tr>

                    <tr>
                        <td><input type="password" name="password" id ="password" value="<?php print ($Password); ?>" readonly required> </td>
                        <td><label>كلمة المرور</label></td>
                    </tr>
                    

                    <tr>
                        <td><button class="btn btn-danger" name="cancel" value="cancel" type="reset">إلغاء</button></td>
                        <td><button class="btn btn-success" name="update" value="update" type="submit">حفظ التعديل</button></td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>