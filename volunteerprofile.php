<?php
$_SESSION["username"] = "nora555"; //0000
$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>الصفحة الشخصية</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
        <link href="css\style13.css" rel="stylesheet" type="text/css" />

        <style>
            body{
                background-image:url("images/orange wallpaper.jpg");
                background-size:cover;
                background-attachment:fixed;
            }
        </style>	
    </head>

    <body>
        <!--Navigation menu-->
    <center><img src="images/logo.png" id="logo" ></center>

    <ul>
        <li><a href="index.php">الرئيسية </a></li>
        <li><a href="events.php">الفعاليات</a></li>
        <li><a href="includes/CharterofVolunteerism.pdf">ميثاق  التطوع</a></li>
        <li><a href="Contact_us.php">اتصل بنا</a></li>

    </ul>


    <br>
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
        $query = 'select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, DateOfBirth, Gender, residence, nationality, Qualification, Email from volunteer, account  where account.Username = volunteer.VolunteerUsername and account.Username = "' . $username . '"';
// Connect to MySQL
        if (!($DB = mysqli_connect('localhost', 'root', '', 'cancergroup'))) {
            die("could not connect to database");
        }
        // open database 
        if (!mysqli_select_db($DB, "cancergroup")) {
            die("could not open cancer store to database");
        }
        // query database 
        if (!($result = mysqli_query($DB, $query))) {
            die("could not execute the query");
        }
        mysqli_close($DB);

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
        }
        ?>

        <form method="post" action = "test.php">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td><input type="text" name="Name" value="<?php print ($FirstName . $MiddleName . $LastName); ?>" required></td>
                    <td><label>الاسم</label></td>		 
                </tr>
                <tr>
                    <td><input type="date" name="bdaytime" value="<?php print ($DateOfBirth); ?>" required></td>
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
                    <td><input type="text" name="residence" value="<?php print ($residence); ?>" required></td>	
                    <td><label>مكان الإقامة</label></td>	
                </tr>
                <tr> 
                    <td><select name="nationality"  value="" required>  
                            <option value="" ><?php print ($nationality); ?></option> 
                            <option value="kwaiti" >كويتي</option> 
                        </select></td>
                    <td><label>الجنسية</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="Nid" value=" <?php print ($VolunteerID); ?>"></td> 
                    <td><label> السجل المدني/الإقامة</label></td>
                </tr>
                <tr>
                    <td><select name="Qualification" value="" required>

                            <option value=" "> <?php print ($Qualification); ?></option>
                            <option value="">دبلوم</option>
                            <option value="">بكالوريس</option>
                            <option value="">ماجستير</option>
                            <option value="">دكتوراه</option>
                        </select>
                    </td>
                    <td><label>المؤهل العلمي</label></td>
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
                    <td><input type="text" name="password" value="" required> </td>
                    <td><label>كلمة المرور</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="repassword" value="" required></td>
                    <td><label>تأكيد كلمة المرور</label></td>
                </tr>
                <tr>
                    <td><button name="update" value="update" type="submit">حفظ التعديل</button></td>
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

        // Connect to MySQL
        if (!($DB = mysqli_connect('localhost', 'root', '', 'cancergroup'))) {
            die("could not connect to database");
        }
        // open database 
        if (!mysqli_select_db($DB, "cancergroup")) {
            die("could not open cancer store to database");
        }
        // query database 
        if (!($result = mysqli_query($DB, $query))) {
            die("could not execute the query");
        }
        mysqli_close($DB);


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

        // Connect to MySQL
        if (!($DB = mysqli_connect('localhost', 'root', '', 'cancergroup'))) {
            die("could not connect to database");
        }
        // open database 
        if (!mysqli_select_db($DB, "cancergroup")) {
            die("could not open cancer store to database");
        }
        // query database 
        if (!($result = mysqli_query($DB, $query))) {
            die("could not execute the query");
        }
        mysqli_close($DB);


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
        <div class="footer">
            <footer>             
                <?php include('includes\footer.php'); ?>
            </footer>
        </div>
    </body>
</html>
