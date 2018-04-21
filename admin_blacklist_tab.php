
<legend> <h1>القائمة السوداء</h1></legend>

<p>كشف بمعلومات المتطوعين الذين وضعوا في القائمة السوداء</p>


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
    echo "<br><div class='row'>
    <div class='col-md-12'> <center>";
    echo "<table class='col-md-12 table-hover table-striped'>";
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
        echo "<td><a Onclick='return ConfirmDeleteFromBlacklist();' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&action=removeFromBlacklist'>"
        . "<span class='glyphicon glyphicon-remove'></span></a></td>";
        echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
        echo "<td> $VolunteerID</td>";

        echo "</tr>";
    }


    echo "</table></center> ";
    echo "<br><br><br></div> </div>";
}
?><!-- end PHP script -->
