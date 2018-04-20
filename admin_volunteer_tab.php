
<!-- Tab Name -->
<legend> <h1>المتطوعون لدى جمعية السرطان السعودية</h1></legend>

<?php
$query = "select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, VolunteerUsername, BlackList, email from volunteer, account where account.Username = volunteer.VolunteerUsername and BlackList=0";

$result = mysqli_query($con, $query);

?><div class='row'> 
  <div class="[ col-sm-12 col-sm-offset-1 col-md-9 ]">
<?php
$numRows = mysqli_num_rows($result);
if ($numRows <= 0) {
    echo "<div class='row'><center> لا يوجد متطوعين في الوقت الحالي </center><br><br>";
    echo "<br><br><br><br><br><br><br></div>";
} else {
    //creating a table for listing all the volunteers
    // إنشاء جدول لإضافة جميع المتطوعين المسجلين بالموقع
    echo "  <div class='[ col-sm-12 col-sm-offset-1 col-md-9 ]'>";
    echo "<table class='table table-hover table-striped'>";
    echo "<tr>";
    echo "<th>اضافة للقائمة السوداء</th>";
    echo "<th> اسم المستخدم </th>";
    echo "<th>البريد الإلكتروني</th>";
    echo "<th>رقم الجوال </th>";
    echo "<th>الاسم الثلاثي  </th>";
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
        echo "<td><a style= 'color:red;' Onclick='openTab(event, 'volunteer');return ConfirmAddToBlacklist();' href='admin-profile.php?volunteer_id=" . $VolunteerID . "&action=addToBlacklist'> <span class='glyphicon glyphicon-plus-sign'></span> </a></td>";
        echo "<td> $VolunteerUsername </td>";
        echo "<td> $email </td>";
        echo "<td> $MobileNumber </td>";
        echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
        echo "<td> $VolunteerID</td>";

        echo "</tr>";
    }

    echo "</table>";
    echo "<br><br><br></div>  ";
}
?><!-- end PHP script -->
<br>
<br>
<br>
</div>
      </div>