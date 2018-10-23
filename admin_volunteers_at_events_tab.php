<?php
include("includes/Header2.php"); // the header of the page
//$_SESSION['admin'] = "true"; //000
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");
$page = 'admin_volunteers_at_events_tab'; //page title to pass it to admin profile tabs
include("includes/admin_tabs.php"); // Admin profile tabs


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

    case "AcceptVolunteer":
        if (isset($_GET['volunteer_id'])) {
            if (isset($_GET['event_id'])) {
                $event_id = $_GET['event_id'];
                $query = "UPDATE volunteerregisterinevent SET status = 1, Admin_ID=" . $_SESSION['id'] . " where Vounteer_ID=$id and Event_ID=$event_id";
                $result = mysqli_query($con, $query);
                $query2 = "INSERT INTO volunteerparticipateonevent (Volunteer_ID, Event_ID) VALUES ('$id', '$event_id')";
                $result2 = mysqli_query($con, $query2);
            }
        }
        break;
    case "RejectVolunteer":
        if (isset($_GET['volunteer_id'])) {
            if (isset($_GET['event_id'])) {
                $event_id = $_GET['event_id'];
                $query = "UPDATE volunteerregisterinevent SET status = 2, Admin_ID=" . $_SESSION['id'] . " where Vounteer_ID=$id and Event_ID=$event_id";
                $result = mysqli_query($con, $query);
            }
        } else {
            header("Location: admin_volunteers_at_events_tab.php");
        }
        break;
    case "SaveEditTask":
        if (isset($_POST["TasksDropdown"])) {
            $newTask = $_POST["TasksDropdown"];
            if (isset($_GET['volunteer_id'])) {
                if (isset($_GET['event_id'])) {
                    $event_id = $_GET['event_id'];
                    $query = "UPDATE volunteerregisterinevent SET Task ='" . $newTask . "' where Vounteer_ID=$id and Event_ID=$event_id";
                    $result = mysqli_query($con, $query);

                    // header("Location: admin-profile.php");
                    //  echo "<script type='text/javascript'> openTab(event, 'event_volunteers');</script>";
                }
            }
        } else {
            //header("Location: admin-profile.php");
        }
        break;
}
?>


<script type="text/javascript">
    function ConfirmAcceptVolunteer()
    {
        var x = confirm("هل تريد قبول المتطوع في الفعالية المحددة؟");
        if (x)
            return true;
        else
            return false;
    }
    function ConfirmRejectVolunteer()
    {
        var x = confirm("هل تريد رفض المتطوع من الفعالية المحددة؟");
        if (x)
            return true;
        else
            return false;
    }
</script>
<body>
    <!-- Tab Name -->
<legend> <h1>المتطوعون بالفعاليات&nbsp;</h1></legend>

<!-- Volunteers in each event-->
<?php
$query = "select EventID, EventName from event";
$result = mysqli_query($con, $query);

//Events' list
echo " <div class='row'> ";
echo "<div class='[ col-sm-8 col-sm-offset-1 col-md-7 ]'>";
echo "<form method='post' class='form-inline' name='Volunteer_selectEvent' action='admin_volunteers_at_events_tab.php'>";
echo "<button type='submit' class='btn btn-success' name='show'  value='show'>عرض</button> &nbsp;&nbsp;";
echo "<div class='form-group'>";
echo "<select class='form-control' id='event' name='Volunteer_selectEvent'>";
while ($row = mysqli_fetch_array($result)) {
    foreach ($row as $id => $val) {
        $EventID = $row['EventID'];
        $EventName = $row['EventName'];
    }
    if (isset($_POST["Volunteer_selectEvent"]) || isset($_GET['event_id']) || $action == 'EditTask') {
        $Volunteer_selectEvent = $_POST["Volunteer_selectEvent"];
        if (isset($_GET['event_id'])) {
            $Volunteer_selectEvent = $_GET['event_id'];
        }
        if ($Volunteer_selectEvent == $EventID) {
            echo "<option value='$EventID' selected>$EventName</option>";
        } else {
            echo "<option value='$EventID' >$EventName</option>";
        }
    } else {
        echo "<option value='$EventID' >$EventName</option>";
    }
}
echo "</select>";

echo "</div></form><br><br>";

if ((isset($_POST["Volunteer_selectEvent"])) || (isset($_GET['event_id']))) {
    //00000
    if (isset($_POST["Volunteer_selectEvent"])) {
        $Volunteer_selectEvent = $_POST["Volunteer_selectEvent"];
    }
    if (isset($_GET['event_id'])) {
        $Volunteer_selectEvent = $_GET['event_id'];
    }

    $query = "SELECT Vounteer_ID, volunteer.FirstName, volunteer.MiddleName, volunteer.LastName, Task FROM volunteerregisterinevent, volunteer WHERE volunteer.VolunteerID=volunteerregisterinevent.Vounteer_ID and Status=0 and volunteer.BlackList=0 and Event_ID=$Volunteer_selectEvent";
    $result = mysqli_query($con, $query);
    $numRows = mysqli_num_rows($result);
    // echo " <div class='row'> ";
    //  echo "<div class='[ col-sm-8 col-sm-offset-2 col-md-7 ]'>";
    if ($numRows <= 0) {

        echo "<div> لا يوجد طلبات للتطوع في هذه الفعالية حاليا </div>";
        echo "<br>";
        echo "<br>";
    } else {

        //echo "<br><br><br>";
        //creating a table for listing the volunteers in the selected event
        // إنشاء جدول لإضافة المتطوعين المشاركين بالفعالية المحددة
        echo "<table table-hover table-striped' style='width:100%;'>";
        echo "<tr>";
        echo "<th> </th>";
        echo "<th>تعديل المهمه </th>";
        echo "<th>المهمه </th>";
        if ($action == 'EditTask') {
            echo "<th></th>";
        }
        echo "<th>الاسم الثلاثي</th>";
        echo "<th>السجل المدني</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            foreach ($row as $id => $val) {
                $VolunteerID = $row['Vounteer_ID'];
                $FirstName = $row['FirstName'];
                $MiddleName = $row['MiddleName'];
                $LastName = $row['LastName'];
                $Task = $row['Task'];
            }

            //printing volunteers' info in the table
            //طباعة بيانات المتطوعين في الجدول
            echo "<td width='120'>  <a class='kbtn btn-lg' style= 'color:red;' Onclick='return ConfirmRejectVolunteer();' href='admin_volunteers_at_events_tab.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent . "&action=RejectVolunteer'> <span class='glyphicon glyphicon-remove-circle' ata-toggle = 'tooltip' data-placement = 'bottom' title ='رفض الطلب'></span> </a>"
            . "<a class='kbtn btn-lg' style= 'color:green;' Onclick='return ConfirmAcceptVolunteer();' href='admin_volunteers_at_events_tab.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent . "&action=AcceptVolunteer'> <span class='glyphicon glyphicon-ok-circle' ata-toggle = 'tooltip' data-placement = 'bottom' title ='قبول الطلب'></span> </a> </td>";


            //------------------------if the action is Edittask------------------------------------------
            if ($action == 'EditTask' && $_GET['volunteer_id'] == $VolunteerID) {
                // echo "<td colspan = '2' align = 'center'><h6 align = 'center'>

                echo "<form method ='post' class='form-inline' name ='TasksDropdown' action ='admin_volunteers_at_events_tab.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent . "&action=SaveEditTask'>";
                /////        echo "<td><a class='btn btn-lg' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent 
                /////                 . "&action=SaveEditTask'> حفظ&nbsp<span class='glyphicon glyphicon-floppy-saved'></span> <button style='border:0 background:none' type='submit' name='TasksDropdown'  value=''></button></a> </td>";
                echo "<td><button type='submit' style='background-color: transparent; border: none; color: white; text-align: center; text-decoration: none; display: inline-block;' >"
                . " <a class='kbtn btn-lg'>  حفظ&nbsp <span class='glyphicon glyphicon-floppy-saved' ata-toggle = 'tooltip' data-placement = 'bottom' title ='حفظ المهمه الجديدة'></span></a></button> </td>";

                echo "<input type='hidden' name='id' value='$EventID'>";
                //echo "<div class='form-group'>";

                echo "<td> <select class='form-control' name ='TasksDropdown'>";
                $query2 = "SELECT * FROM taskofevent where Event_ID = $Volunteer_selectEvent";

                $result2 = mysqli_query($con, $query2);
                while ($row2 = mysqli_fetch_array($result2)) {
                    if ($row2['Task'] == $Task) {
                        echo'<option value="' . $row2['Task'] . '" selected>' . $row2['Task'] . '</option>';
                    } else {
                        echo'<option value="' . $row2['Task'] . '">' . $row2['Task'] . '</option>';
                    }
                }

                echo "</select></td>";
                echo "<td><a style='color:grey;' href='admin_volunteers_at_events_tab.php?event_id=$Volunteer_selectEvent'> <span style='padding-right:100%;' class='glyphicon glyphicon-remove' ata-toggle = 'tooltip' data-placement = 'bottom' title ='إلغاء التعديل'></span> </a></td>";

                //echo "</div>";
                echo "</form>";
            } else {
                echo "<td><a class='kbtn btn-lg' href='admin_volunteers_at_events_tab.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent . "&action=EditTask'> تعديل&nbsp<span class='glyphicon glyphicon-edit'></span> </a> </td>";
                echo "<td> $Task </td>";
                if ($action == 'EditTask') {
                    echo "<td></td>";
                }
            }
            //------------------------------------------------------------------
            echo "<td>" . $FirstName . "&nbsp" . $MiddleName . "&nbsp" . $LastName . "</td>";
            echo "<td> $VolunteerID</td>";

            echo "</tr>";
        }

        echo "</table>";
        // echo "</div></div>";
    }

    //echo " <div class='row'> ";
    //echo "<div class='[ col-sm-8 col-sm-offset-2 col-md-7 ]'>";
    echo "<br><legend> <h4><strong>المتطوعون المقبولون بالفعالية</strong></h4></legend> ";
//                    $query = "select DISTINCT VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and"
//                    . " volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $Volunteer_selectEvent";

    $query = "SELECT Vounteer_ID, volunteer.FirstName, volunteer.MiddleName, volunteer.LastName, Task FROM volunteerregisterinevent, volunteer WHERE volunteer.VolunteerID=volunteerregisterinevent.Vounteer_ID and Status=1 and volunteer.BlackList=0 and Event_ID=$Volunteer_selectEvent";
    $result = mysqli_query($con, $query);
    $numRows = mysqli_num_rows($result);

    if ($numRows <= 0) {
        echo "<div> ";
        echo " لا يوجد متطوعين مقبولين حتى الآن";
        echo "</div>";
    } else {

        //creating a table for listing the volunteers in the selected event
        // إنشاء جدول لإضافة المتطوعين المقبولون بالفعالية المحددة

        echo "<table  table-hover table-striped' style='width:100%;'>";
        echo "<tr>";
        echo "<th>المهمه </th>";
        echo "<th>الاسم الثلاثي</th>";
        echo "<th>السجل المدني</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            foreach ($row as $id => $val) {
                $VolunteerID = $row['Vounteer_ID'];
                $FirstName = $row['FirstName'];
                $MiddleName = $row['MiddleName'];
                $LastName = $row['LastName'];
                $Task = $row['Task'];
            }

            //printing volunteers' info in the table
            //طباعة بيانات المتطوعين في الجدول
            echo "<td> $Task </td>";
            echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
            echo "<td> $VolunteerID</td>";

            echo "</tr>";
        }

        echo "</table>";
        echo "<br>";
    }
}
?>

<!--volunteer hours -->
<!--
            <center>
                <input type="date" name="date"> &nbsp  أسم الفعالية&nbsp <input type="text" align="right" name="EvnName" > &nbsp التاريخ

                <br>
                &nbsp

                <table id='t01' >
                    <tr>
                        <th align="center">مجموع الساعات</th><th align="center">وقت الخروج</th><th align="center">وقت الدخول</th><th align="center">أسم المتطوع</th>
                    </tr>
                    <tr>
                        <td align="center"></td> <td align="center"><input type="time" name="usr_time"></td> <td align="center"><input type="time" name="usr_time"></td> <td align="center"> </td>
                    </tr>

                </table>
<br><br><center>
                <button class="btn">حفظ</button>
            </center> -->

<?php
//$query = "select volunteer.FirstName, volunteer.MiddleName, volunteer.LastName from volunteer where volunteer.Volunteer_ID = volunteerparticipateonevent.Volunteer_ID AND volunteerparticipateonevent.Event_ID = $Volunteer_selectEvent";
//$result = mysqli_query($con, $query);
//$numRows = mysqli_num_rows($result);
//if ($numRows <= 0) {
//  echo "<br> لايوجد متطوعين في الوقت الحالي";
//} else {
//creating a table for listing all the volunteer
// إنشاء جدول لتسجيل دخول وخروج كل متطوع بالفعالية
/*
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
  echo "</div>"; */
?>

<!---------------------------New code--------------------------------------------------->

<!--volunteer hours -->

<?php
/*
  echo "<br><br><br><br>";
  echo "<br> <div class='row'>";

  echo "<div class='[ col-sm-8 col-sm-offset-3 col-md-6 ]'>";
  // filtering by date dropdown list
  echo "<form method='post' class='form-inline' name='Volunteer_selectEvent' action='admin_volunteers_at_events_tab.php'>";
  echo "<button type='submit' class='btn btn-success' name='hours'  value='hours'>إدخال الساعات التطوعية</button> &nbsp;&nbsp;";
  echo "<div class='form-group'>";

  echo "<select class='form-control' id='event'  name='selectEventDate'>";

  $query = "SELECT * FROM dateofevent where Event_ID = $Volunteer_selectEvent";
  $result = mysqli_query($con, $query);

  while ($row = mysqli_fetch_array($result)) {
  echo'<option value="' . $row['Date'] . '">';
  echo $row['Date'];
  echo"</option>";
  }
  echo "</select>";
  echo "</div>";
  echo "</form></div></div>";
 */
//-----------------------------------------------------
//if (isset($_POST["hours"])) {
// $row = $_POST["Volunteer_selectEvent"];
//}
//$sHoure="00";
// $sminute='00';
// $stime='00';
// $StartingHour='$sHoure"+":"$sminute"+"$stime';
//$eHoure='00';
//$eminute='00';    //00:00:00.000000
//$etime='00';
//$EndingHour='$eHoure"+":"$eminute""+"$etime';
//$query = "Insert into volunteerparticipateonevent(StartingHour,EndingHour) values($StartingHour,$EndingHour)";
//$result = mysqli_query($con, $query);
// إنشاء جدول لتسجيل دخول وخروج كل متطوع بالفعالية
//echo "<div class='col-md-12'>";
//echo "<table class='col-md-12 table-hover table-striped'>";
//echo "<tr>";
//echo "<th> تعديل الوقت</th>";
//echo "<th>وقت الخروج</th>";
//echo "<th>وقت الدخول</th>";
//echo "<tr>";
//طباعة بيانات دخول وخروج المتطوعين في الجدول
//echo "<td> </td>";   
//echo "<td> <input type='time' name='usr_time'></td>";
//echo "<td> <input type='time' name='usr_time'></td>";
// <button type='submit' style='background-color: transparent; border: none; color: white; text-align: center; text-decoration: none; display: inline-block;' >" . " <a class='kbtn btn-lg'>  حفظ&nbsp <span class='glyphicon glyphicon-floppy-saved'></span></a></button>
//if ($action == 'EditTask') {
//echo "<th></th>";
// }
// echo "<th>ساعات الدخول</th>";
//echo "<th>ساعات الخروج</th>";
//echo "<th>تعديل الساعات</th>";
//echo "</tr>";
// while ($row = mysqli_fetch_array($result)) {
// echo "<tr>";
// foreach ($row as $id => $val) {
// $starthour = $row['starthour'];
// $endhour = $row['endhour'];
//$MiddleName = $row['MiddleName'];
// $LastName = $row['LastName'];
// $Task = $row['Task'];
//  }
//    echo "</tr>";
//}
// echo "</table>";
// echo ;
//--------------------------------------------------------------------------------------
echo "</div></div>";
//echo "<br><br><br><br><br><br><br><br> ";
//  }
?>
</body>


<?php include('includes/footer.php'); ?>
<script>
    $.fn.select2.defaults.set("theme", "bootstrap");
        $("select.form-control").select2({
            width: 250,
            dir: 'rtl'
        })
</script>