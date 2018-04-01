<!DOCTYPE html>
<!-- the header of the page-->
<?php
$_SESSION["username"] = "admin"; //0000
?>
<title>لوحة تحكم الأدمن</title> <!--page title-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
<link href="css\style13.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    body{

        background-size:cover;
        background-attachment:fixed;
    }
</style>


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



<div class="tab">

    <button class="tablinks" onclick="openTab(event, 'events')">الفعاليات</button>
    <button class="tablinks" onclick="openTab(event, 'volunteer')">المتطوعون لدى الجمعية</button>
    <button class="tablinks" onclick="openTab(event, 'event_volunteers')">المتطوعون بالفعالية </button>
    <button class="tablinks" onclick="openTab(event, 'black_list')">القائمة السوداء </button>
    <button class="tablinks" onclick="openTab(event, 'certificate')">الشهادات </button>
    <button class="tablinks" onclick="openTab(event, 'profile')" id="defaultOpen">المعلومات الشخصية</button>
</div>


<div id="events" class="tabcontent">
    <h3>الفعاليات</h3>
    <p>.يمكنك اضافة ،حذف و تعديل الفعاليات</p> 


    <!-- All events-->
    <?php
    $query = "select EventID, EventName, Location from event";

    // Connect to MySQL
    if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
        die("could not connect to database");
    }
    // open database 
    if (!mysqli_select_db($DB, "sql12229449")) {
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


<!--All Volunteers-->

<div id="volunteer" class="tabcontent">
    <h3>المتطوعون لدى جمعية السرطان السعودي</h3>
    <p>كشف بمعلومات المتطوعين</p>

    <?php
    $query = "select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, VolunteerUsername, BlackList, email from volunteer, account where account.Username = volunteer.VolunteerUsername";

    // Connect to MySQL
    if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
        die("could not connect to database");
    }
    // open database 
    if (!mysqli_select_db($DB, "sql12229449")) {
        die("could not open cancer store to database");
    }
    // query database 
    if (!($result = mysqli_query($DB, $query))) {
        die("could not execute the query");
    }
    mysqli_close($DB);

    $numRows = mysqli_num_rows($result);
    if ($numRows <= 0) {
        echo "<br> لا يوجد متطوعين في الوقت الحالي";
    } else {
        //creating a table for listing all the volunteers
        // إنشاء جدول لإضافة جميع المتطوعين المسجلين بالموقع
        echo "<div>";
        echo "<table id='t01'>";
        echo "<tr>";
        echo "<th>اسم المستخدم</th>";
        echo "<th> القائمة السوداء </th>";
        //echo "<td>الدور</td>";
        echo "<th>البريد الإلكتروني</th>";
        echo "<th>رقم الجوال </th>";
        echo "<th>الاسم الثلاثي</th>";
        echo "<th>السجل المدني</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            foreach ($row as $id => $val) {
                $VolunteerID = $row['VolunteerID'];
                $FirstName = $row['FirstName'];
                $MiddleName = $row['MiddleName'];
                $LastName = $row['LastName'];
                //$Role = $row['Role'];
                $MobileNumber = $row['MobileNumber'];
                $VolunteerUsername = $row['VolunteerUsername'];
                $BlackList = $row['BlackList'];
                $email = $row['email'];
            }

            //printing volunteers' info in the table
            //طباعة بيانات المتطوعين في الجدول
            echo "<td> $VolunteerUsername </td>";
            if ($BlackList == 0) {
                $BlackList = 'لا';
            } else if ($BlackList == 1) {
                $BlackList = 'نعم';
            }
            echo "<td> $BlackList </td>";
            echo "<td> $email </td>";
            echo "<td> $MobileNumber </td>";
            echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
            echo "<td> $VolunteerID</td>";

            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }
    ?><!-- end PHP script -->



    <br><br>
    <center>
        <button class="btn">حذف</button>
        <button class="btn">اضافة للقائمة السوداء</button>
    </center>
</div>

<!--Event Volunteers-->
<div id="event_volunteers" class="tabcontent">
    <h3>المتطوعون بالفعالية</h3>
    <p>.كشف بمعلومات المتطوعين</p>

    <h4>: الفعالية</h4>


    <!-- Volunteers in each event-->
    <?php
    $query = "select EventID, EventName from event";

    // Connect to MySQL
    if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
        die("could not connect to database");
    }
    // open database 
    if (!mysqli_select_db($DB, "sql12229449")) {
        die("could not open cancer store to database");
    }
    // query database 
    if (!($result = mysqli_query($DB, $query))) {
        die("could not execute the query");
    }
    mysqli_close($DB);

    //Events' list
    echo "<form method='post' name='selectEvent' action='admin-profile.php'>";
    echo "<button type='submit' name='show'  value='show'>بحث</button> &nbsp;&nbsp;";
    echo "<select id='event' name='selectEvent'>";
    while ($row = mysqli_fetch_array($result)) {
        foreach ($row as $id => $val) {
            $EventID = $row['EventID'];
            $EventName = $row['EventName'];
        }

        echo "<option value='$EventID' >$EventName</option>";
    }
    echo "</select>";
    echo "</form>";


    if (isset($_POST["selectEvent"])) {

        $selectEvent = $_POST["selectEvent"];

        $query = "select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $selectEvent";

        // Connect to MySQL
        if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
            die("could not connect to database");
        }
        // open database 
        if (!mysqli_select_db($DB, "sql12229449")) {
            die("could not open cancer store to database");
        }
        // query database 
        if (!($result = mysqli_query($DB, $query))) {
            die("could not execute the query");
        }
        mysqli_close($DB);

        $numRows = mysqli_num_rows($result);
        if ($numRows <= 0) {
            echo "<br> لا يوجد متطوعين في الوقت الحالي";
        } else {

            //creating a table for listing the volunteers in the selected event
            // إنشاء جدول لإضافة المتطوعين المشاركين بالفعالية المحددة
            echo "<div>";
            echo "<table id='t01'>";
            echo "<tr>";
            //echo "<th> المهمه </th>";  // 0000 add to the table
            echo "<th>البريد الإلكتروني</th>";
            echo "<th>رقم الجوال </th>";
            echo "<th>الاسم الثلاثي</th>";
            echo "<th>السجل المدني</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                foreach ($row as $id => $val) {
                    $VolunteerID = $row['VolunteerID'];
                    $FirstName = $row['FirstName'];
                    $MiddleName = $row['MiddleName'];
                    $LastName = $row['LastName'];
                    $MobileNumber = $row['MobileNumber'];
                    $email = $row['email'];
                }

                //printing volunteers' info in the table
                //طباعة بيانات المتطوعين في الجدول
                echo "<td> $email </td>";
                echo "<td> $MobileNumber </td>";
                echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                echo "<td> $VolunteerID</td>";

                echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
        }
    }
    ?>


    <br><br>
    <center>
        <button class="btn">حذف</button>
        <button class="btn">تعديل</button>
        <button class="btn">تعيين كمشرف</button>

    </center>
</div>


<!--Black list-->
<div id="black_list" class="tabcontent">
    <h3>القائمة السوداء</h3>
    <p>كشف بمعلومات المتطوعين الذين وضعوا في القائمة السوداء</p>

    <center>

        <!-- Blacklist page code-->
        <?php
        $query = "select FirstName, MiddleName, LastName, VolunteerID, BlackList from volunteer where BlackList = 1";

        // Connect to MySQL
        if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
            die("could not connect to database");
        }
        // open database 
        if (!mysqli_select_db($DB, "sql12229449")) {
            die("could not open cancer store to database");
        }
        // query database 
        if (!($result = mysqli_query($DB, $query))) {
            die("could not execute the query");
        }
        mysqli_close($DB);

        $numRows = mysqli_num_rows($result);
        if ($numRows <= 0) {
            echo "<br> لا يوجد أي متطوع في القائمة السوداء";
        } else {

            //creating a table for listing all the volunteers in the blacklist
            // إنشاء جدول لإضافة جميع المتطوعين الذين وضعوا في القائمة السوداء
            echo "<div>";
            echo "<table id='t01'>";
            echo "<tr>";
            echo "<th> القائمة السوداء </th>"; // حذف من القائمة
            echo "<th>الاسم الثلاثي</th>";
            echo "<th>السجل المدني</th>";
            echo "</tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                foreach ($row as $id => $val) {
                    $VolunteerID = $row['VolunteerID'];
                    $FirstName = $row['FirstName'];
                    $MiddleName = $row['MiddleName'];
                    $LastName = $row['LastName'];
                    $BlackList = $row['BlackList'];
                }

                //printing volunteers' info in the table
                //طباعة بيانات المتطوعين في الجدول
                echo "<td><Button type = submit value='Delete' name='Delete'>إزالة</Button> </td>";
                echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                echo "<td> $VolunteerID</td>";

                echo "</tr>";
            }


            echo "</table>";
            echo "</div>";
        }
        ?><!-- end PHP script -->

    </center>

</div>

<!--Certificate-->
<div id="certificate" class="tabcontent">
    <h3>الشهادات</h3>
    <p>.الشهادات</p>

    <h4>: الفعالية</h4>

    <select class="select">
        <option value="e1">الشرقية وردية</option>
        <option value="e2">المؤتمر العلمي العالمي</option>
        <option value="e3">الكل</option>
    </select>
    <br><br>



    <table style="width:100%" >
        <table id="t01">
            <tr>
                <th>البريد الإلكتروني</th>
                <th>رقم الجوال</th> 
                <th>السجل المدني</th>
                <th>الإسم الثلاثي</th>
                <th></th>

            </tr>
            <tr>
                <td align="center">dalia@hotmail.com</td>
                <td align="center">05645250353</td>
                <td align="center">1089377442</td>
                <td align="center">داليا محمد الهاجري </td>
                <td><input type="checkbox" name="1" />&nbsp;</td>

            </tr>
            <tr>
                <td align="center">ahmed90@hotmail.com</td>
                <td align="center">05647895233</td>
                <td align="center">1079363838</td>
                <td align="center">احمد عبدالله الدوسري</td>
                <td><input type="checkbox" name="2" />&nbsp;</td>

            </tr>
            <tr>
                <td align="center">k_1_h@gmail.com</td>
                <td align="center">05445898931</td>
                <td align="center">1076377050</td>
                <td align="center">خالد عثمان العبدالله</td>
                <td><input type="checkbox" name="3" />&nbsp;</td>

            </tr>
            <tr>
                <td align="center">sara_95@hotmail.com</td>
                <td align="center">05005251250</td>
                <td align="center">1089331556</td>
                <td align="center">ساره عبالعزيز احمد</td>
                <td><input type="checkbox" name="4" />&nbsp;</td>

            </tr>
            <tr>
                <td align="center">rana@hotmail.com</td>
                <td align="center">05401256730</td>
                <td align="center">1067377412</td>
                <td align="center">رنا محمد الراجح </td>
                <td><input type="checkbox" name="5" />&nbsp;</td>

            </tr>



        </table>
    </table>
    <br><br>

    <center>
        <button class="btn">ارسال الشهاده</button>

    </center>
    <br><br>
</div>

<!--personal information-->
<div id="profile" class="tabcontent">
    <h3>معلومات شخصية</h3>
    <p>.المعلومات الشخصية للادمن</p>
    <?php
// if (isset($_SESSION["username"])){
// $username = $_SESSION["username"];
// $query = 'select * from admin where AdminUsername="'.$username.'"';
// //include ("connection.php");
// // Connect to MySQL
    //  if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
    //     die("could not connect to database");
    //  }
    // open database 
    //  if (!mysqli_select_db($DB, "sql12229449")) {
    //      die("could not open cancer store to database");
    //   }
// // query database 
// if (!($re = mysqli_query($DB, $query))) {
// die("could not execute the query");
// }
// mysqli_close($DB);
// if (mysqli_num_rows($re) != 0) {
// while ($row = mysqli_fetch_array($re)) {
// $name = $row["FirstName"];
// $id = $row["AdminID"];
// }
// }
// }else {
// print ("You don't have a permission to access this page");
// exit;
// }
    ?>



    <form method="post" action="/CheckAdminInfo.php">

        <table>
            <tr>
                <td><input type="text" name="name" required></td>  <!--value=?php print ($name);?-->
                <td><label> الاسم</label></td>
            </tr>
            <tr>
                <td><input type="text" name="id"></td>
                <td> <label>السجل المدني/الإقامة</label></td>
            </tr>
            <tr>
                <td><input type="email" name="email" required></td>  <!--value=?php print ($email);?-->
                <td><label> البريد الإلكتروني </label></td>
            </tr>
            <tr>
                <td><input type="tel" name="mobile" required></td>
                <td><label> رقم الجوال</label></td>
            </tr>
            <tr>
                <td><input type="text" name="password" value="" required></td> <!--value=?php print ($password);?-->
                <td><label>كلمة المرور</label></td>
            </tr>
            <tr>
                <td><input type="text" name="confirmPassword" value="" required></td>
                <td><label>تأكيد كلمة المرور</label></td>
            </tr>
        </table>
        <br><br>
        <center>

            <button class="btn" name="cancel" type="submit">إلغاء</button>&nbsp;   <button class="btn" name="update" type="submit">حفظ التعديلات</button>


        </center>
    </form>
</div>



<script>
    function openTab(evt, tabName) {
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
