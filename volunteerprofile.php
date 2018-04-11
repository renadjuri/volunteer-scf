
<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = "الصفحة الشخصية"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");
$username = 'basma123';
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
        <h3>المعلومات الشخصية</h3>
        <?php
        $query = 'select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, DateOfBirth, Gender, residence, nationality, Qualification, WorkStatus,  Email from volunteer, account  where account.Username = volunteer.VolunteerUsername and account.Username = "' . $username . '"';
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
            
            $Name = $_POST["Name"];
            $mobile = $_POST["mobile"];
            $bdate = $_POST["bdate"];                      
            $gender = $_POST["gender"];
            $residence = $_POST["residence"];
            $nationality = $_POST["nationality"];
            $Qualification = $_POST["Qualification"];
            $Email = $_POST["email"];
         
           $query = "UPDATE volunteer SET MobileNumber = '$MobileNumber',residance = '$residence' WHERE volunteer.VolunteerUsername = '$username'";
                $result = mysqli_query($con, $query);
          //  echo "<script type='text/javascript'>alert(' after  submitted successfully!')</script>";
               echo ' <div class="alert alert-success alert-dismissible" >تم تحديث البيانات بنجاح  &ensp;<span class= "glyphicon glyphicon-send" ></span></div>';
            //  echo' <div runat="server" id="div_warning" visible="false" class="alert alert-danger alert-dismissible" style="width: 100%">';
                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
//header('location:volunteerprofile.php');

            /*
            //Check if all fields are empty if true show error message 
            if (empty($_POST["VolunteerID"]) && empty($_POST["FirstName"]) && empty($_POST["MiddleName"]) &&
                    empty($_POST["LastName"]) && empty($_POST["MobileNumber"]) && empty($_POST["DateOfBirth"]) && empty($_POST["residence"]) && empty($_POST["nationality"]) && empty($_POST["Qualification"]) && empty($_POST["Email"])) {
                echo "<p class='error'>
						تأكد من تعبئة البيانات المطلوبة 	
						 </p>";
            } else {
                //Email validation  
                if (empty($_POST["Email"])) {
                    $EmailErr = "تأكد من تعبئة البيانات المطلوبة.";
                } else if (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
                    $EmailErr = "البريد الإلكتروني غير صحيح";
                }
                //First Name validation 
                if (empty($_POST["FirstName"])) {
                    $FnameErr = "تأكد من تعبئة البيانات المطلوبة.";
                } else if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["FirstName"])) {
                    $FnameErr = "الإسم المدخل غير صحيح";
                }
                //Last Name validation 
                if (empty($_POST["LastName"])) {
                    $LnameErr = "تأكد من تعبئة البيانات المطلوبة.";
                }

                if (!empty($_POST["LastName"])) {
                    if (!preg_match("/[a-z A-Z ا-ي ]/", $_POST["LastName"])) {
                        $LnameErr = "الإسم الاخير المدخل غير صحيح";
                    }
                }
            }*/
             
           // if ((!empty($_POST["VolunteerID"])) && (!empty($_POST["FirstName"])) && (!empty($_POST["MiddleName"])) &&
                   // (!empty($_POST["LastName"])) && (!empty($_POST["mobile"])) && (!empty($_POST["DateOfBirth"])) && (!empty($_POST["residence"])) && (!empty($_POST["nationality"])) && (!empty($_POST["Qualification"])) && (!empty($_POST["Email"]))) {

                
                /*
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
                  $Email = $row['Email'];
                  }
                  } */

                    
      
   
    }
         //   }
        
        ?>

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

                    </td>
                    <td><label> الجنس</label></td>	
                </tr>
                <tr> 
                    <td><select name="nationality"  value="<?php print ($nationality); ?>" required>  
                            <option value="سعودي" >سعودي</option> 
                            <option value="كويتي" >كويتي</option> 
                            <option value="بحريني" >بحريني</option> 
                            <option value="قطري" >قطري</option> 
                            <option value="أماراتي" >إماراتي</option> 
                            <option value="عماني" >عماني</option> 
                        </select></td>
                    <td><label>الجنسية</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="Nid" value=" <?php print ($VolunteerID); ?>"></td> 
                    <td><label> السجل المدني/الإقامة</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="residence" value="<?php print ($residence); ?>" required></td>	
                    <td><label>مكان الإقامة</label></td>	
                </tr>

                <tr>
                    <td><select name="Qualification" value="<?php print ($Qualification); ?>" required>

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
                    <td><button name="update" value="update" type="submit">حفظ التعديل</button></td>
                    <td><button name="cancel" value="cancel" type="reset">إلغاء</button></td>
                </tr>
            </table>
        </form>

    </div>

    <div id="Events" class="tabcontent" >
        <h3>الفعاليات</h3>
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

            echo "</table>";
            echo "</div>";
        }
        ?>

    </div>

    <div id="Requests" class="tabcontent" >
        <h3>طلبات التطوع</h3>
        <center>
            <table border=2 width=300>
                <tr>
                    <td>حالة الطلب</td><td>المهام</td><td>إسم الفعالية</td>
                </tr>
            </table>
    </div>

    <div id="Participation" class="tabcontent" >
        <h3>الفعاليات التي شاركت فيها</h3>

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
            <button type="submit">التعديل</button>  
            <button type="submit">حفظ التعديل</button>
        </center>
    </div>

    <div id="Alerts" class="tabcontent" >
        <h3>التنبيهات</h3>
        <div class="container">
            <img src="" alt="logo" class="right" style="width:100%;">
            <p align="right"> أهلا بك مشاركا في العطاء مع الجمعية السعودية للسرطان</p>
            <span class="time-left">11:01</span>
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
        <center>
            <div class="footer">
                <footer>             
                    <?php include('includes/footer.php'); ?>
                </footer>
            </div>
        </center>
</body>
</html>
