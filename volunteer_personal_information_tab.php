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
    $Password = $_POST['password'];



    //Check if all fields are empty if true show error message 
    if (empty($_POST["FirstName"]) && empty($_POST["mobile"]) &&
            empty($_POST["bdate"]) && empty($_POST["gender"]) && empty($_POST["residence"]) && empty($_POST["nationality"]) && empty($_POST["Qualification"]) && empty($_POST["WorkStatus"]) && empty($_POST["email"]) && empty($_POST["password"])) {
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
        //Last Name validation 
        //if (empty($_POST["LastName"])) {
        //   $LnameErr = "تأكد من تعبئة البيانات المطلوبة.";
        // }
        //   if (!empty($_POST["LastName"])) {
        // if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["LastName"])) {
        //   $LnameErr = "الإسم الاخير المدخل غير صحيح";
        // }
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
                        <td><input type="text" name="FirstName" value="<?php print ($FirstName); ?>" required></td>
                        <td><label>الاسم الأول </label></td>

                    </tr>
                    <tr>
                        <td><input type="text" name="MiddleName" value="<?php print ( $MiddleName); ?>" required></td>
                        <td><label>اسم الاب </label></td>

                    </tr>
                    <tr>
                        <td><input type="text" name="LastName" value="<?php print ( $LastName); ?>" required></td>
                        <td><label>اسم العائلة</label></td>

                    </tr>
                    <tr>
                        <td><input type="date" name="bdate" value="<?php print ($DateOfBirth); ?>" required></td>
                        <td> <label>تاريخ الميلاد</label></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if ($Gender == 'f') {
                                echo "ذكر<input type='radio' name='gender' value='m' checked>";
                                echo "أنثى<input type='radio' name='gender' value='f' >";
                            } else {
                                echo "ذكر<input type='radio' name='gender' value='m' >";
                                echo "أنثى<input type='radio' name='gender' value='f' checked>";
                            }
                            ?>

                        </td>
                        <td><label> الجنس</label></td>	
                    </tr>
                    <tr> 
                        <td><select name="nationality"  value="<?php print ($nationality); ?>" required> 

                                <option value="السعودية" >السعودية</option> 
                                <option value="الكويت" >الكويت</option> 
                                <option value="البحرين" >البحرين</option> 
                                <option value="قطر" >قطر</option> 
                                <option value="الإمارات" >الإمارات</option> 
                                <option value="عمان" >عمان</option> 
                            </select></td>
                        <td><label>الجنسية</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="Nid" value=" <?php print ($VolunteerID); ?>" readonly></td> 
                        <td><label> السجل المدني/الإقامة</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="residence" value="<?php print ($residence); ?>" required></td>	
                        <td><label>مكان الإقامة</label></td>	
                    </tr>

                    <tr>
                        <td><input type="email" name="email" value="<?php print ($Email); ?>" required> </td>
                        <td><label>البريد الإلكتروني</label></td>
                    </tr>
                    <tr>
                        <td><input type="tel" name="mobile" value="<?php print ($MobileNumber); ?>" required> </td>
                        <td><label>رقم الجوال</label></td>
                    </tr>

<!--                    <tr>
       <td><button class="btn btn-danger" name="cancel" value="cancel" type="reset">إلغاء</button></td>
       <td><button class="btn btn-success" name="update" value="update" type="submit">حفظ التعديل</button></td>
   </tr>-->
                    <tr>
                        <td> <select name="Qualification"  value="<?php print ($Qualification); ?>" required> 
                                <option value="ثانوي"> ثانوي</option>
                                <option value="دبلوم">دبلوم</option>
                                <option value="بكالريوس">بكالوريس</option>
                                <option value="ماجستير">ماجستير</option>
                                <option value="دكتوراه">دكتوراه</option>
                            </select>
                        </td>
                        <td><label>المؤهل العلمي</label></td>
                    </tr>
                    <tr>
                        <td><select name="WorkStatus"  value="<?php print ($WorkStatus); ?>" required>  
                                <option value="طالب" >طالب</option> 
                                <option value="موظف" >موظف</option> 
                                <option value="لا أعمل" >لا أعمل</option> 
                            </select></td>
                        <td><label>الوظيفة</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="WorkType" value="<?php print ($WorkType); ?>" > </td>
                        <td><label>المسمى الوظيفي</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="Sector" value="<?php print ($Sector); ?>" > </td>
                        <td><label>جهة العمل</label></td>
                    </tr>
                    <tr>
                        <td><input type="email" name="email" value="<?php print ($Email); ?>" required> </td>
                        <td><label>البريد الإلكتروني</label></td>
                    </tr>
                    <tr>
                        <td><input type="tel" name="mobile" value="<?php print ($MobileNumber); ?>" required> </td>
                        <td><label>رقم الجوال</label></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="password" id ="password" value="<?php print ($Password); ?>" required> </td>
                        <td><label>كلمة المرور</label></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="repassword" value="" required></td>
                        <td><label>تأكيد كلمة المرور</label></td>
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