<?php
include("includes/Header.php"); // the header of the page
//$_SESSION['admin'] = "true"; //000
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");
$page = 'admin_blacklist_tab'; //page title to pass it to admin profile tabs
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
    //Remove from blacklist
    case "removeFromBlacklist":
        if (isset($_GET['volunteer_id'])) {

            $query = "UPDATE volunteer SET BlackList = 0 where VolunteerID=$id"; //0000
            $result = mysqli_query($con, $query);


            header("Location: admin_blacklist_tab.php");
        } else {
            header("Location: admin_blacklist_tab.php");
        }
        break;
}
        ?>

<script type="text/javascript">
    function ConfirmDeleteFromBlacklist()
    {
        var x = confirm("هل تريد إزالة المتطوع من القائمة السوداء؟");
        if (x)
            return true;
        else
            return false;
    }
</script>
<body>
<legend> <h1>القائمة السوداء&nbsp;</h1></legend>

<p>كشف بمعلومات المتطوعين الذين وضعوا في القائمة السوداء &nbsp;&nbsp;</p>


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
    echo "<br>     <div class='row'> ";
    echo "<div class='[ col-sm-8 col-sm-offset-2 col-md-7 ]'>";
    echo "<table class='table-hover table-striped'>";
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
        echo "<td><a Onclick='return ConfirmDeleteFromBlacklist();' href='admin_blacklist_tab.php?volunteer_id=" . $VolunteerID . "&action=removeFromBlacklist'>"
        . "<span class='glyphicon glyphicon-remove'></span></a></td>";
        echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
        echo "<td> $VolunteerID</td>";

        echo "</tr>";
    }


    echo "</table></center> ";
    echo "<br><br><br></div> </div>";
}
?><!-- end PHP script -->
</body>

    <?php include('includes/footer.php'); ?>
