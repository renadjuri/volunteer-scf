<!-- Tab Name -->
<legend> <h1>المتطوعون بالفعاليات</h1></legend>

<!-- Volunteers in each event-->
<?php
$query = "select EventID, EventName from event";
$result = mysqli_query($con, $query);

//Events' list
echo "<br> <div class='row'>
    <div class='[ col-sm-12 col-sm-offset-1 col-md-8 ]'> ";
echo "<form method='post' class='form-inline' name='Volunteer_selectEvent' action='admin-profile.php'>";
echo "<button type='submit' class='btn btn-success' name='show'  value='show'>بحث</button> &nbsp;&nbsp;";
echo "<div class='form-group'>";
echo "<select class='form-control' id='event' name='Volunteer_selectEvent'>";
while ($row = mysqli_fetch_array($result)) {
    foreach ($row as $id => $val) {
        $EventID = $row['EventID'];
        $EventName = $row['EventName'];
    }

    echo "<option value='$EventID' >$EventName</option>";
}
echo "</select>";
echo "</div>";
echo "</form></div>";

if ((isset($_POST["Volunteer_selectEvent"])) || (isset($_GET['event_id']))) {
    //00000
    if (isset($_POST["Volunteer_selectEvent"])) {
        $Volunteer_selectEvent = $_POST["Volunteer_selectEvent"];
    }
    if (isset($_GET['event_id'])) {
        $Volunteer_selectEvent = $_GET['event_id'];
    }
    //         $query = "select DISTINCT VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and"
    //                 . " volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $Volunteer_selectEvent";

    $query = "SELECT Vounteer_ID, volunteer.FirstName, volunteer.MiddleName, volunteer.LastName, Task FROM volunteerregisterinevent, volunteer WHERE volunteer.VolunteerID=volunteerregisterinevent.Vounteer_ID and Status=0 and volunteer.BlackList=0 and Event_ID=$Volunteer_selectEvent";

    $result = mysqli_query($con, $query);

    $numRows = mysqli_num_rows($result);
    if ($numRows <= 0) {
        echo "<br><div class='row'> لا يوجد طلبات للتطوع في هذه الفعالية حاليا </div>";
    } else {
        echo "<br> <div class='row'>";
        //creating a table for listing the volunteers in the selected event
        // إنشاء جدول لإضافة المتطوعين المشاركين بالفعالية المحددة
        echo "<div class='[ col-sm-12 col-sm-offset-1 col-md-8 ]'>";
        echo "<table class='col-md-12 table-hover table-striped'>";
        echo "<tr>";
        echo "<th> </th>";
        echo "<th>تعديل المهمه </th>";
        if ($action == 'EditTask') {
            echo "<th></th>";
        }
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
            echo "<td width='120'>  <a class='kbtn btn-lg' style= 'color:red;' Onclick='return ConfirmRejectVolunteer();' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent . "&action=RejectVolunteer'> <span class='glyphicon glyphicon-remove-circle'></span> </a>"
            . "<a class='kbtn btn-lg' style= 'color:green;' Onclick='return ConfirmAcceptVolunteer();' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent . "&action=AcceptVolunteer'> <span class='glyphicon glyphicon-ok-circle'></span> </a> </td>";


            //------------------------if the action is Edittask------------------------------------------
            if ($action == 'EditTask' && $_GET['volunteer_id'] == $VolunteerID) {
                // echo "<td colspan = '2' align = 'center'><h6 align = 'center'>

                echo "<form method ='post' class='form-inline' name ='TasksDropdown' action ='admin-profile.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent . "&action=SaveEditTask'>";
                /////        echo "<td><a class='btn btn-lg' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent 
                /////                 . "&action=SaveEditTask'> حفظ&nbsp<span class='glyphicon glyphicon-floppy-saved'></span> <button style='border:0 background:none' type='submit' name='TasksDropdown'  value=''></button></a> </td>";
                echo "<td><button type='submit' style='background-color: transparent; border: none; color: white; text-align: center; text-decoration: none; display: inline-block;' >"
                . " <a class='kbtn btn-lg'>  حفظ&nbsp <span class='glyphicon glyphicon-floppy-saved'></span></a></button> </td>";

                echo "<input type='hidden' name='id' value='$EventID'>";
                echo "<div class='form-group'>";
                echo "<td width='30'><a style= 'color:grey;' href='admin-profile.php'> <span class='glyphicon glyphicon-remove'></span> </a></td>";
                echo "<td> <select class='form-control' name ='TasksDropdown'>";
                $query2 = "SELECT * FROM taskofevent where Event_ID = $Volunteer_selectEvent";

                $result2 = mysqli_query($con, $query2);
                while ($row2 = mysqli_fetch_array($result2)) {
                    echo'<option value="' . $row2['Task'] . '">';
                    echo $row2['Task'];
                    echo"</option>";
                }

                echo "</select></td>";
                echo "</div>";
                echo "</form>";
            } else {
                echo "<td><a class='kbtn btn-lg' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&event_id=" . $Volunteer_selectEvent . "&action=EditTask'> تعديل&nbsp<span class='glyphicon glyphicon-edit'></span> </a> </td>";
                if ($action == 'EditTask') {
                    echo "<td></td>";
                }
                echo "<td> $Task </td>";
            }
            //------------------------------------------------------------------
            echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
            echo "<td> $VolunteerID</td>";

            echo "</tr>";
        }

        echo "</table>";
        echo "<br><br>";
        echo "</div> </div>";
    }


    echo "<br><br><br><br><br> <div class='row'>
           <div class='[ col-sm-12 ]'> ";

    echo "<legend> <h3>المتطوعون المقبولون بالفعالية</h3></legend> </div></div>";
//                    $query = "select DISTINCT VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and"
//                    . " volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteerparticipateonevent.Event_ID = $Volunteer_selectEvent";

    $query = "SELECT Vounteer_ID, volunteer.FirstName, volunteer.MiddleName, volunteer.LastName, Task FROM volunteerregisterinevent, volunteer WHERE volunteer.VolunteerID=volunteerregisterinevent.Vounteer_ID and Status=1 and volunteer.BlackList=0 and Event_ID=$Volunteer_selectEvent";

    $result = mysqli_query($con, $query);


    $numRows = mysqli_num_rows($result);
    if ($numRows <= 0) {
        echo "<br> لا يوجد متطوعين مقبولين حتى الآن";
    } else {

        //creating a table for listing the volunteers in the selected event
        // إنشاء جدول لإضافة المتطوعين المقبولون بالفعالية المحددة
        echo "<div class='row'>";
        echo "<table class='col-sm-12 col-sm-offset-1 col-md-8 table-hover table-striped'>";
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
        echo "<br><br><br>";
        echo "</div>";
    }
}
?>
<br><br><br><br>
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
echo "<br> </div>";
//  }
?>
   


