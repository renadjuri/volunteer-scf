
<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = "الصفحة الشخصية"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");
$username = 'nora555';
        //$_SESSION["username"];
?>


<style>
    body{
        background-size:cover;
        background-attachment:fixed;
    }
</style>	


<body>

    <br>

    <div class="tab" >
        <button class="tablinks" onclick="openfile(event, 'PersonalInfo')" id="defaultOpen">المعلومات الشخصية</button>
        <button class="tablinks" onclick="openfile(event, 'Events')">الفعاليات</button>
        <button class="tablinks" onclick="openfile(event, 'Requests')">طلبات التطوع</button>
        <button class="tablinks" onclick="openfile(event, 'Participation')">الفعاليات التي شاركت فيها</button>

    </div>

    <div id="PersonalInfo" class="tabcontent" >
        <!-- Tab Name -->
        <legend> <h1>المعلومات الشخصية</h1></legend>
        <?php
        $query = 'select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, DateOfBirth, Gender, residence, nationality, Qualification, WorkStatus, WorkType, Sector,  Email from volunteer, account  where account.Username = volunteer.VolunteerUsername and account.Username = "' . $username . '"';
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
         
           

            
            //Check if all fields are empty if true show error message 
            if ( empty($_POST["FirstName"]) && empty($_POST["mobile"]) &&
                    empty($_POST["bdate"]) && empty($_POST["gender"]) && empty($_POST["residence"]) && empty($_POST["nationality"]) && empty($_POST["Qualification"]) && empty($_POST["WorkStatus"]) && empty($_POST["email"])) {
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
                    (!empty($gender)) && (!empty($residence)) && (!empty($nationality)) && (!empty($Qualification)) && (!empty($WorkStatus)) && (!empty($Email)))  {

                
           $query = "UPDATE volunteer SET FirstName='$FirstName' , MiddleName = '$MiddleName' ,LastName='$LastName', MobileNumber = '$mobile', DateOfBirth = '$bdate', Gender = '$gender', nationality = '$nationality', residence = '$residence', WorkStatus = '$WorkStatus', WorkType = '$WorkType', Sector = '$Sector' WHERE volunteer.VolunteerUsername = '$username'";
                $result = mysqli_query($con, $query);
                
                $query = "UPDATE account SET Email='$Email' WHERE account.Username='$username'";
                $result = mysqli_query($con, $query);
          //  echo "<script type='text/javascript'>alert(' after  submitted successfully!')</script>";
               echo ' <div class="alert alert-success alert-dismissible" >تم تحديث البيانات بنجاح  &ensp;<span class= "glyphicon glyphicon-send" ></span></div>';
            //  echo' <div runat="server" id="div_warning" visible="false" class="alert alert-danger alert-dismissible" style="width: 100%">';
            echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
//header('location:volunteerprofile.php');
   
    }
        }
        
        ?>
        <div class="container">
            <div class="row">
                <div class="[col-sm-8 col-sm-offset-3 col-md-12 ]">
                    <form method="post" action = "volunteerprofile.php">
                        <table cellspacing="0" cellpadding="0">
                            <tr>
                                <td><input type="text" name="Name" value="<?php print ($FirstName . " " . $MiddleName . " " . $LastName); ?>" required></td>
                                <td><label>الاسم </label></td>		 
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

        <form method="post" action = "volunteerprofile.php">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td><input type="text" name="FirstName" value="<?php print ($FirstName); ?>" required></td>
                    <td><label>الاسم الأول </label></td>
                    
                </tr>
                <tr>
                    <td><input type="text" name="MiddleName" value="<?php print ( $MiddleName ); ?>" required></td>
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
                            </tr>
                            <tr>
                                <td><input type="text" name="WorkType" value="<?php print ($WorkType); ?>" required> </td>
                                <td><label>المسمى الوظيفي</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="Sector" value="<?php print ($Sector); ?>" required> </td>
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
                                <td><input type="password" name="password" value="" required> </td>
                                <td><label>كلمة المرور</label></td>
                            </tr>
                            <tr>
                                <td><input type="password" name="repassword" value="" required></td>
                                <td><label>تأكيد كلمة المرور</label></td>
                            </tr>
                            <tr>
                                <td><button class="btn btn-danger" name="cancel" value="cancel" type="reset">إلغاء</button></td>
                                <td><button class="btn btn-success" name="update" value="update" type="submit">حفظ التعديل</button></td>

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
                    <td><button name="update" value="update" type="submit">حفظ التعديل</button></td>
                    <td><button name="cancel" value="cancel" type="reset">إلغاء</button></td>
                </tr>
            </table>
        </form>

    </div>

    <div id="Events" class="tabcontent" >
        <div class="container">
            <div class="row">
                <div class="[col-sm-8 col-sm-offset-3 col-md-8]">
                    <!-- Tab Name -->
                    <legend> <h1>الفعاليات</h1></legend>
                    <br>
                    <!-- All events-->
                    <?php
                    $query = "select EventID, EventName, Location from event";

                    $result = mysqli_query($con, $query);


                    $numRows = mysqli_num_rows($result);
                    if ($numRows <= 0) {
                        echo "<br> لا يوجد فعاليات في الوقت الحالي";
                    } else {

                        //creating a table for listing all the events
                        // إنشاء جدول لإضافة جميع الفعاليات
                        echo "<div>";
                        echo "<table id='t01'>";
                        echo "<tr>";
                        echo "<th>موقع الفعالية</th>";
                        echo "<th>اسم الفعالية</th>";
                        echo "<th>رمز الفعالية</th>";
                        echo "</tr>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            foreach ($row as $id => $val) {
                                $EventID = $row['EventID'];
                                $EventName = $row['EventName'];
                                $Location = $row['Location'];
                            }

                            //printing events' info in the table
                            //طباعة بيانات الفعاليات في الجدول

                            echo "<td> $Location </td>";
                            echo "<td> $EventName </td>";
                            echo "<td> $EventID</td>";

                echo "</tr>";
            }
            echo "<tr>";
              echo '<td><button name="submit"  type="submit">التسجيل</button></td>';
              echo "</tr>";
            echo "</table>";
            
            echo "</div>";
        }
        ?>

    </div>

    <div id="Requests" class="tabcontent" >
        <h3>طلبات التطوع</h3>
         <?php
        $query = "select EventName, Status from volunteerregisterinevent, event, volunteer where volunteerregisterinevent.Event_ID = event.EventID and volunteerregisterinevent.Vounteer_ID = volunteer.VolunteerID and volunteer.VolunteerUsername = '$username'";

        $result = mysqli_query($con, $query);


        $numRows = mysqli_num_rows($result);
        if ($numRows <= 0) {
            echo "<br> لا يوجد فعاليات في الوقت الحالي";
        } else {

            //creating a table for listing all the events
            // إنشاء جدول لإضافة جميع الفعاليات
            echo "<div>";
            echo "<table id='t01'>";
            echo "<tr>";
            echo "<th>اسم الفعالية </th>";
            echo "<th>حالة الطلب</th>";
           //echo "<th>ساعة الخروج</th>";
          //  echo "<th>مجموع الساعات</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                foreach ($row as $id => $val) {
                    $EventName = $row['EventName'];
                    $Status = $row['Status'];
                   
                }

                //printing events' info in the table
                //طباعة بيانات الفعاليات في الجدول

                echo "<td> $EventName </td>";
                echo "<td> $Status </td>";
                

                echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
        }
        ?>
    </div>

    <div id="Participation" class="tabcontent" >
        <div class="container">
            <div class="row">
                <div class="[col-sm-8 col-sm-offset-3 col-md-8 ]">
                    <!-- Tab Name -->
                    <legend> <h1>الفعاليات التي شاركت فيها</h1></legend>

                    <?php
                    $query = "select EventName, StartingHour, EndingHour, SUM(StartingHour+EndingHour) from volunteerparticipateonevent, event, volunteer where volunteerparticipateonevent.Event_ID = event.EventID and volunteerparticipateonevent.Volunteer_ID = volunteer.VolunteerID and volunteer.VolunteerUsername = '$username'";

                    $result = mysqli_query($con, $query);


                    $numRows = mysqli_num_rows($result);
                    if ($numRows <= 0) {
                        echo "<br> لا يوجد فعاليات في الوقت الحالي";
                    } else {

                        //creating a table for listing all the events
                        // إنشاء جدول لإضافة جميع الفعاليات
                        echo "<div>";
                        echo "<table id='t01'>";
                        echo "<tr>";
                        echo "<th>اسم الفعالية </th>";
                        echo "<th>ساعة الدخول</th>";
                        echo "<th>ساعة الخروج</th>";
                        echo "<th>مجموع الساعات</th>";
                        echo "</tr>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            foreach ($row as $id => $val) {
                                $EventName = $row['EventName'];
                                $StartingHour = $row['StartingHour'];
                                $EndingHour = $row['EndingHour'];
                                $total = $row['SUM(StartingHour+EndingHour)'];
                            }

                            //printing events' info in the table
                            //طباعة بيانات الفعاليات في الجدول

                            echo "<td> $EventName </td>";
                            echo "<td> $StartingHour </td>";
                            echo "<td> $EndingHour</td>";
                            echo "<td> $total</td>";

                            echo "</tr>";
                        }

                        echo "</table>";
                        echo "</div>";
                    }
                    ?>
                    <br><br>

                    <center>
                        <button type="submit" class="btn btn-warning">التعديل</button>  
                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <div id="Alerts" class="tabcontent" >
        <div class="container">
            <div class="row">
                <div class="[col-sm-8 col-sm-offset-3 col-md-8 ]">
                    <h3>التنبيهات</h3>
                    <div class="container">
                        <img src="" alt="logo" class="right" style="width:100%;">
                        <p align="right"> أهلا بك مشاركا في العطاء مع الجمعية السعودية للسرطان</p>
                        <span class="time-left">11:01</span>
                    </div>
                </div>
            </div> </div>
    </div>
    <script>
        function openfile(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
    </script>
    <!--Footer of the page -->
</div>
</div>
</div>           
<?php include('includes/footer.php'); ?>


</body>
</html>
