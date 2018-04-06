<!DOCTYPE html>
<!-- the header of the page-->
<?php
//session_start();
$_SESSION["username"] = "admin"; //0000

   $page_title = "لوحة التحكم";//page title to pass it to the header
   include("includes/Header.php"); // the header of the page
include('connection_arabic.php'); //connect to the database


if (isset($_GET['volunteer_id'])) {

    $id = $_GET['volunteer_id'];
} else {
    $id = 1; //0000 id should be none or 0
}
if (isset($_GET['action'])) {

    $action = $_GET['action'];
} else {
    $action = "none";
}

switch ($action) {
    //Remove from blacklist
    case "removeFromBlacklist":
        if (isset($_GET['volunteer_id'])) {
            $query = "UPDATE volunteer SET BlackList = 0 where VolunteerID=$id"; //0000
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

            header("Location: admin-profile.php");
        } else {
            header("Location: admin-profile.php");
        }
        break;
    //Add to blacklist
    case "addToBlacklist":
        if (isset($_GET['volunteer_id'])) {
            $query = "UPDATE volunteer SET BlackList = 1 where VolunteerID=$id"; //0000
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
            header("Location: admin-profile.php");
        } else {
            header("Location: admin-profile.php");
        }
        break;
}
?>

<style type="text/css">
    body{

        background-size:cover;
        background-attachment:fixed;
    }
</style>
<!DOCTYPE html>
<!-- the header of the page-->

<script type="text/javascript">
    function ConfirmDeleteFromBlacklist()
    {
        var x = confirm("Are you sure you want to remove the volunteer from the blacklist?");
        if (x)
            return true;
        else
            return false;
    }
    function ConfirmAddToBlacklist()
    {
        var x = confirm("Are you sure you want to add the volunteer to the blacklist?");
        if (x)
            return true;
        else
            return false;
    }
</script>

<body>
   
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
$result =$query ( "select EventID, EventName, Location from event");

//// Connect to MySQL
//if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
//    die("could not connect to database");
//}
//// open database 
//if (!mysqli_select_db($DB, "sql12229449")) {
//    die("could not open cancer store to database");
//}
//// query database 
//if (!($result = mysqli_query($DB, $query))) {
//    die("could not execute the query");
//}
//mysqli_close($DB);

$numRows="";

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
$result =$query ( "select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, VolunteerUsername, BlackList, email from volunteer, account where account.Username = volunteer.VolunteerUsername and BlackList=0");

//// Connect to MySQL
//if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
//    die("could not connect to database");
//}
//// open database 
//if (!mysqli_select_db($DB, "sql12229449")) {
//    die("could not open cancer store to database");
//}
//// query database 
//if (!($result = mysqli_query($DB, $query))) {
//    die("could not execute the query");
//}
//mysqli_close($DB);

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
            $VolunteerUsername = $row['VolunteerUsername'];
            $BlackList = $row['BlackList'];
            $email = $row['email'];
        }

        //printing volunteers' info in the table
        //طباعة بيانات المتطوعين في الجدول
        echo "<td><a Onclick='return ConfirmAddToBlacklist();' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&action=addToBlacklist'><img src=\"images/plus-black-circle.png\" alt=\"Add to blacklist\"' /></a></td>";
        echo "<td> $VolunteerUsername </td>";
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
</div>

<!--Event Volunteers-->
<div id="event_volunteers" class="tabcontent">
    <h3>المتطوعون بالفعالية</h3>
    <p>.كشف بمعلومات المتطوعين</p>

    <h4>: الفعالية</h4>


    <!-- Volunteers in each event-->
<?php
$result =$query ( "select EventID, EventName from event");

//// Connect to MySQL
//if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
//    die("could not connect to database");
//}
//// open database 
//if (!mysqli_select_db($DB, "sql12229449")) {
//    die("could not open cancer store to database");
//}
//// query database 
//if (!($result = mysqli_query($DB, $query))) {
//    die("could not execute the query");
//}
//mysqli_close($DB);

//Events' list
echo "<form method='post' name='Volunteer_selectEvent' action='admin-profile.php'>";
echo "<button type='submit' name='show'  value='show'>بحث</button> &nbsp;&nbsp;";
echo "<select id='event' name='Volunteer_selectEvent'>";
while ($row = mysqli_fetch_array($result)) {
    foreach ($row as $id => $val) {
        $EventID = $row['EventID'];
        $EventName = $row['EventName'];
    }

    echo "<option value='$EventID' >$EventName</option>";
}
echo "</select>";
echo "</form>";


if (isset($_POST["Volunteer_selectEvent"])) {

    $Volunteer_selectEvent = $_POST["Volunteer_selectEvent"];

   $result = $query ("select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $Volunteer_selectEvent");

//    // Connect to MySQL
//    if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
//        die("could not connect to database");
//    }
//    // open database 
//    if (!mysqli_select_db($DB, "sql12229449")) {
//        die("could not open cancer store to database");
//    }
//    // query database 
//    if (!($result = mysqli_query($DB, $query))) {
//        die("could not execute the query");
//    }
//    mysqli_close($DB);

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

    </center>
</div>


<!--Black list-->
<div id="black_list" class="tabcontent">
    <h3>القائمة السوداء</h3>
    <p>كشف بمعلومات المتطوعين الذين وضعوا في القائمة السوداء</p>

    <center>

        <!-- Blacklist page code-->
<?php
$result = $query ( "select FirstName, MiddleName, LastName, VolunteerID, BlackList from volunteer where BlackList = 1");

//// Connect to MySQL
//if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
//    die("could not connect to database");
//}
//// open database 
//if (!mysqli_select_db($DB, "sql12229449")) {
//    die("could not open cancer store to database");
//}
//// query database 
//if (!($result = mysqli_query($DB, $query))) {
//    die("could not execute the query");
//}
//mysqli_close($DB);

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
        }

        //printing volunteers' info in the table
        //طباعة بيانات المتطوعين في الجدول
        echo "<td><a Onclick='return ConfirmDeleteFromBlacklist();' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&action=removeFromBlacklist'><img src=\"images/cross-red-circle.png\" alt=\"Remove from blacklist\"' /></a></td>";
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

<?php
//0000000000000000000000000000000000000000000000000000000
$result = $query ( "select EventID, EventName from event");

//// Connect to MySQL
//            if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
//                die("could not connect to database");
//            }
//            // open database )
//            if (!mysqli_select_db($DB, "sql12229449")) {
//                die("could not open cancer store to database");
//            }
//            // query database 
//            if (!($result = mysqli_query($DB, $query))) {
//                die("could not execute the query");
//            }
//            mysqli_close($DB);

//Events' list
echo "<form method='post' name='selectEvent' action='admin-profile.php'>";
echo "<button type='submit' name='show'  value='show'>بحث</button> &nbsp;&nbsp;";
echo "<select id='event' name='selectEvent'>";
while ($row = mysqli_fetch_array($result)) {
    foreach ($row as $id => $val) {
        $EventID = $row['EventID'];
        $EventName = $row['EventName'];
    }

    echo "<option value='$EventID' >$EventName</option>"; //0000 to keep same value when post back try --> " . <?php echo (isset($_POST["selectEvent"] && $_POST["selectEvent"] == "$EventID")?"selected='selected'":"";?->
}
echo "</select>";
echo "</form>";


if (isset($_POST["selectEvent"])) {

    $selectEvent = $_POST["selectEvent"];

    $result = $query ( "select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $selectEvent");

//    // Connect to MySQL
//            if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
//                die("could not connect to database");
//            }
//            // open database 
//            if (!mysqli_select_db($DB, "sql12229449")) {
//                die("could not open cancer store to database");
//            }
//            // query database 
//            if (!($result = mysqli_query($DB, $query))) {
//                die("could not execute the query");
//            }
//            mysqli_close($DB);

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
        echo "<th></th>";
        echo "</tr>";
        $num = 0;
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
            $num += 1;
            //printing volunteers' info in the table
            //طباعة بيانات المتطوعين في الجدول
            echo "<td> $email </td>";
            echo "<td> $MobileNumber </td>";
            echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
            echo "<td> $VolunteerID</td>";
            echo "<td><input type='checkbox' name='" . $num . "' />&nbsp;</td>";

            echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
    }
}
?>
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

$result = $query ( 'select AdminID, FirstName, MiddleName, LastName, AdminUsername, Email, password from admin, account where account.Username = admin.AdminUsername and account.Username = "' . $_SESSION["username"] . '"');
//// Connect to MySQL
//            if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
//                die("could not connect to database");
//            }
//            // open database 
//            if (!mysqli_select_db($DB, "sql12229449")) {
//                die("could not open cancer store to database");
//            }
//            // query database 
//            if (!($result = mysqli_query($DB, $query))) {
//                die("could not execute the query");
//            }
//            mysqli_close($DB);

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
        }
    }
}
?>
    <br>

    <form method="post" action="CheckAdminInfo.php">
        <table>
            <tr>
                <td><input type="text" name="name" value="<?php print ($FirstName . ' ' . $MiddleName . ' ' . $LastName); ?>" required></td>
                <td><label> الاسم</label></td>
            </tr>
            <tr>
                <td><input type="text" name="id" value="<?php print ($AdminID); ?>"></td>
                <td> <label>السجل المدني/الإقامة</label></td>
            </tr>
            <tr>
                <td><input type="text" name="username" value="<?php print ($AdminUsername); ?>"></td>
                <td> <label>اسم المستخدم</label></td>
            </tr>
            <tr>
                <td><input type="email" name="email" value="<?php print ($email); ?>" required></td>
                <td><label> البريد الإلكتروني </label></td>
            </tr>
            <tr>
                <td><input type="text" name="password" value="<?php print ($password); ?>" required></td>
                <td><label>كلمة المرور</label></td>
            </tr>
            <tr>
                <td><button class="btn" name="changePassword" type="">تغيير كلمة المرور</button></td>
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
<div class="footer">
    <footer>             
<?php include('includes/footer.php'); ?>
    </footer>
</div>

</body>
</html> 
