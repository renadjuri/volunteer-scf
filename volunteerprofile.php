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
        <?php include("volunteer_personal_information_tab.php"); ?>
    </div>
    <div id="Events" class="tabcontent" >

        <?php include("volunteer_event_tab.php"); ?>
    </div>

    <div id="Requests" class="tabcontent" >
        <div class="container">
            <div class="row">
                <div class="[col-sm-8 col-sm-offset-3 col-md-8 ]">
                    <!-- Tab Name -->
                    <legend>  <h1>طلبات التطوع</h1></legend>
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
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <div id="Participation" class="tabcontent" >
        <div class="container">
            <div class="row">
                <div class="[col-sm-8 col-sm-offset-3 col-md-8 ]">
                    <!-- Tab Name -->
                    <legend> <h1>الفعاليات التي شاركت فيها</h1></legend>
                    <br>
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
                    <br>
                    <br>
                    <br>
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

