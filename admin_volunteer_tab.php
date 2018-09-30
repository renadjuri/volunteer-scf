<?php
include("includes/Header.php"); // the header of the page
//$_SESSION['admin'] = "true"; //000
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");
$page = 'admin_volunteer_tab'; //page title to pass it to admin profile tabs
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
    //Add to blacklist
    case "addToBlacklist":
        if (isset($_GET['volunteer_id'])) {
            if (isset($_GET['volunteer_id'])) {
                $query = "UPDATE volunteer SET BlackList = 1 where VolunteerID=$id"; //0000
                $result = mysqli_query($con, $query);

                header("Location: admin_volunteer_tab.php");
            }
        } else {
            header("Location: admin_volunteer_tab.php");
        }
        break;
}
        ?>

<script type="text/javascript">
    function ConfirmAddToBlacklist()
    {
        var x = confirm("هل تريد إضافة المتطوع للقائمة السوداء؟");
        if (x)
            return true;
        else
            return false;
    }
</script>
<body>
<!-- Tab Name -->
<legend> <h1>المتطوعون لدى جمعية السرطان السعودية &nbsp;</h1></legend>

<?php
$query = "select VolunteerID, FirstName, MiddleName, LastName, MobileNumber, VolunteerUsername, BlackList, email from volunteer, account where account.Username = volunteer.VolunteerUsername and BlackList=0";

$result = mysqli_query($con, $query);

?>
<div class='row'> 
  <div class="col-md-9">
<?php
$numRows = mysqli_num_rows($result);
if ($numRows <= 0) {
    echo "<div class='row'><center> لا يوجد متطوعين في الوقت الحالي </center><br><br>";
    echo "<br><br><br><br><br><br><br></div>";
} else {
    //creating a table for listing all the volunteers
    // إنشاء جدول لإضافة جميع المتطوعين المسجلين بالموقع
    echo "  <div class='col-md-12'>";
    echo "<table class='col-md-12 table table-hover table-striped'>";
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
        echo "<td><a style= 'color:red;' Onclick='return ConfirmAddToBlacklist();' href='admin_volunteer_tab.php?volunteer_id=" . $VolunteerID . "&action=addToBlacklist'> <span class='glyphicon glyphicon-plus-sign'></span> </a></td>";
        echo "<td> $VolunteerUsername </td>";
        echo "<td> $email </td>";
        echo "<td> $MobileNumber </td>";
        echo "<td>" . $FirstName . "&nbsp" . $MiddleName . "&nbsp" . $LastName . "</td>";
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
</body>

    <?php include('includes/footer.php'); ?>