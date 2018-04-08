<!DOCTYPE html>
<!-- the header of the page-->
<?php
//session_start();
$page_title = "لوحة التحكم"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
$_SESSION['admin'] = "true"; //0000
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");

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
            $result = mysqli_query($con, $query);


            header("Location: admin-profile.php");
        } else {
            header("Location: admin-profile.php");
        }
        break;
    //Add to blacklist
    case "addToBlacklist":
        if (isset($_GET['volunteer_id'])) {

            $query = "UPDATE volunteer SET BlackList = 1 where VolunteerID=$id"; //0000

            $result = mysqli_query($con, $query);

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
        $query = "select EventID, EventName, Location from event";
        $result = mysqli_query($con, $query);


        $numRows = "";

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
        $query = "select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, VolunteerUsername, BlackList, email from volunteer, account where account.Username = volunteer.VolunteerUsername and BlackList=0";

        $result = mysqli_query($con, $query);


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
        $query = "select EventID, EventName from event";
        $result = mysqli_query($con, $query);

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
            $query = "select DISTINCT VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and"
                    . " volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $Volunteer_selectEvent";
            $result = mysqli_query($con, $query);


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



            <!--تسجيل ساعات دخول وخروج المتطوعي -->

            <center>
                <input type="date" name="date"> &nbsp  أسم الفعالية&nbsp <input type="text" align="right" name="EvnName" > &nbsp التاريخ

                <br>
                &nbsp

                <table id='t01' border=2 width=400>
                    <tr>
                        <th align="center">مجموع الساعات</th><th align="center">وقت الخروج</th><td align="center">وقت الدخول</th><th align="center">أسم المتطوع</td>
                    </tr>
                    <tr>
                        <td align="center"></td> <td align="center"><input type="time" name="usr_time"></td> <td align="center"><input type="time" name="usr_time"></td> <td align="center"> </td>
                    </tr>

                </table>

                <br><br>
                <input type="submit" name="حفظ" value="حفظ"/>
            </center>

            <?php
            echo "<select id='event' name='Admin_selectEvent'>";
            while ($row = mysqli_fetch_array($result)) {
                foreach ($row as $id => $val) {
                    $EventID = $row['EventID'];
                    $EventName = $row['EventName'];
                }

                echo "<option value='$EventID' >$EventName</option>";
            }
            echo "</select>";
            echo "</form>";


            if (isset($_POST["Admin_selectEvent"])) {

                $Admin_selectEvent = $_POST["Admin_selectEvent"];


                $query = "select volunteer.FirstName, volunteer.MiddleName, volunteer.LastName from volunteer where volunteer.Volunteer_ID = volunteerparticipateonevent.Volunteer_ID AND volunteerparticipateonevent.Event_ID = $Volunteer_selectEvent";

                $result = mysqli_query($con, $query);


                $numRows = mysqli_num_rows($result);
                if ($numRows <= 0) {
                    echo "<br> لايوجد متطوعين في الوقت الحالي";
                } else {

//creating a table for listing all the volunteer
                    // إنشاء جدول لتسجيل دخول وخروج كل متطوع بالفعالية
                    echo "<div>";
                    echo "<table id='t01'>";
                    echo "<tr>";
                    echo "<th>اسم المتطوع</th>";
                    echo "<th>وقت الدخول</th>";
                    echo "<th>وقت الخروج</th>";
                    echo "<th>مجموع الساعات</th>";
                    echo "</tr>";
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>";
                        foreach ($row as $id => $val) {
                            $FirstName = $row['FirstName'];
                            $MiddleName = $row['MiddleName'];
                            $LastName = $row['LastName'];
                            $StartingHour = $row['in_time'];
                            $EndingHour = $row['out_time'];
                            $total = $row['SUM(in_time-out_time)'];
                        }


                        //printing events' info in the table
                        //طباعة بيانات دخول وخروج المتطوعين في الجدول

                        echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                        echo "<td> $StartingHour </td>";
                        echo "<td> $EndingHour</td>";
                        echo "<td> $total</td>";

                        echo "</tr>";
                    }

                    echo "</table>";
                    echo "</div>";
                }
            }
            ?>

            <br><br><center>
                <button type="submit">حفظ</button>  

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
            $result = mysqli_query($con, $query);


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
        <!-- Certificates for volunteers-->
        <?php
        //0000000000000000000000000000000000000000000000000000000
        echo "Certificates:";
        $query = "select EventID, EventName from event";

        $result = mysqli_query($con, $query);


        //Events' list
        echo "<form method='post' name='selectEvent' action='try_AllVolunteers.php'>";
        echo "<span style='color:red;'>$error</span>"; //0000
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
            $query = "select DISTINCT VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $selectEvent";

            $result = mysqli_query($con, $query);


            $numRows = mysqli_num_rows($result);
            if ($numRows <= 0) {
                echo "<br> لا يوجد متطوعين في الوقت الحالي";
            } else {
                echo "<form name='SendCertificateForm' method='POST'>"; //action='0000.php?AID=<?php echo $AID
                //creating a table for listing the volunteers in the selected event
                // إنشاء جدول لإضافة المتطوعين المشاركين بالفعالية المحددة
                echo "<div>";
                echo "<table id='t01'>";
                echo "<tr>";
                //echo "<th> المهمه </th>";  // 0000 add to the table
                echo "<th> الشهاده</th>";
                echo "<th>البريد الإلكتروني</th>";
                echo "<th>رقم الجوال </th>";
                echo "<th>الاسم الثلاثي</th>";
                echo "<th>السجل المدني</th>";
                echo "<th><input type='checkbox' name='SelectAll' id='SelectAll' onchange='checkboxAll(this)'> </th>";
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
                    echo "<td><a href='tcpdf/examples/certificate-English-email.php?volunteer_id=" . $VolunteerID . "&event_id=" . $selectEvent . "'><img src=\"images/certificate.png\" alt=\"Certificate\" height=30 weight=30 ' /></a></td>";
                    echo "<td> $email </td>";
                    echo "<td> $MobileNumber </td>";
                    echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                    echo "<td> $VolunteerID</td>";
                    //echo "<td><input type='checkbox' name='" . $num ."' />&nbsp;</td>";
                    echo "<td> <input type='checkbox' name=CertificateSelection[] value=$VolunteerID> </td>";
                    echo "</tr>";
                }
                echo "$error"; //0000
                echo "</table>";
                echo "</div>";
                echo "<button Onclick='return sendEmailConfirmation();' type='submit' class='button' name='sendEmail' id='sendEmail' value='Send Certificate'> إرسال الشهادة </button>";
                echo "</form>";
            }
        }
        ?>
    </div>

    <!--personal information-->
    <div id="profile" class="tabcontent">
        <h3>معلومات شخصية</h3>
        <p>.المعلومات الشخصية للادمن</p>
        <?php
        $query = 'select AdminID, FirstName, MiddleName, LastName, AdminUsername, Email, password from admin, account where account.Username = admin.AdminUsername and account.Username = "' . $_SESSION["username"] . '"';
        $result = mysqli_query($con, $query);


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

    <!--Footer of the page -->

    <?php include('includes/footer.php'); ?>

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
