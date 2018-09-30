<!-- the header of the page-->
<?php
$page_title = "الصفحة الشخصية"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");
$page = 'volunteer_event_tab'; //page title to pass it to admin profile tabs
include("includes/volunteer_tabs.php"); // Admin profile tabs
$_SESSION["username"];
?>

<body>

<div class="row">
    <div class="[col-sm-8 col-sm-offset-3 col-md-7]">
        <!-- Tab Name -->
        <legend> <h1>الفعاليات &nbsp;</h1></legend>
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
            echo '<td><button name="submit"   class="btn btn-success" type="submit">التسجيل</button></td>';
            echo "</tr>";
            echo "</table>";

            echo "</div>";
        }
        ?>

    </div>
</div>
    <?php include('includes/footer.php'); ?>