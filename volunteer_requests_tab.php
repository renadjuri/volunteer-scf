<!-- the header of the page-->
<?php
$page_title = "الصفحة الشخصية"; //page title to pass it to the header
include("includes/Header2.php"); // the header of the page
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");
$page = 'volunteer_requests_tab'; //page title to pass it to admin profile tabs
include("includes/volunteer_tabs.php"); // Admin profile tabs
$_SESSION["username"];
?>


<body>



    <!-- Tab Name -->
<legend>  <h1>طلبات التطوع  &nbsp;</h1></legend>

<div class="row">
    <div class="[col-sm-8 col-md-7 ]">

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
                if ($Status == 0){$Status = "جاري معالجة الطلب";}
                else if ($Status == 1){$Status = "تم قبول الطلب";}
                else if ($Status == 1){$Status = "تم رفض الطلب";}
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
        <br>
        <br>
    </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!--Footer of the page -->


<?php include('includes/footer.php'); ?>

