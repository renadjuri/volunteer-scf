<?php
include("includes/Header.php"); // the header of the page
//$_SESSION['admin'] = "true"; //000
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");
$page = 'admin_certificate_tab'; //page title to pass it to admin profile tabs
include("includes/admin_tabs.php"); // Admin profile tabs
        

if (isset($_GET['volunteer_id'])) {

    $id = $_GET['volunteer_id'];
} else {
    $id = 1; //0000 id should be none or 0
}
        ?>
<style type="text/css">
    body{

        background-size:cover;
        background-attachment:fixed;
    }
    a:hover{
        text-decoration: none;
    }
</style>
<script type="text/javascript">
    function ConfirmDeleteFromBlacklist()
    {
        var x = confirm("هل تريد إزالة المتطوع من القائمة السوداء؟");
        if (x)
            return true;
        else
            return false;
    }
    function checkboxAll()
    {
        var checkboxes = document.getElementsByTagName('input'), val = null;


        for (var i = 0; i < checkboxes.length; i++)
        {
            if (checkboxes[i].type == 'checkbox')
            {
                if (val === null)
                    val = checkboxes[i].checked;
                {
                    checkboxes[i].checked = val;
                }
            }
        }
    }
    function sendEmailConfirmation()
    {
        var x = confirm("هل تريد إرسال الشهادة للمتطوعين المحددين؟");
        if (x)
            return true;
        else
            return false;
    }
</script>
<!-- Certificates for volunteers-->
<!-- Tab Name -->
<legend> <h1>الشهادات&nbsp;</h1></legend>

    <?php
//0000000000000000000000000000000000000000000000000000000
    $query = "select EventID, EventName from event";

    $result = mysqli_query($con, $query);

    $error = ""; //0000000 remove error variable
//Events' list
    echo "<br>"; 
    echo "<br><div class='row'>
    <div class='col-md-9'>";
    echo "<form method='post' class='form-inline' name='selectEvent' action='admin_certificate_tab.php'>";
    echo "<span style='color:red;'>$error</span>"; //0000
    echo "<button class='btn btn-success' type='submit' name='show'  value='show'>بحث</button> &nbsp;&nbsp;";
    echo "<div class='form-group'>";
    echo "<select class='form-control' id='event' name='selectEvent'>";
    while ($row = mysqli_fetch_array($result)) {
        foreach ($row as $id => $val) {
            $EventID = $row['EventID'];
            $EventName = $row['EventName'];
        }

        echo "<option value='$EventID' >$EventName</option>"; //0000 to keep same value when post back try --> " . <?php echo (isset($_POST["selectEvent"] && $_POST["selectEvent"] == "$EventID")?"selected='selected'":"";?->
    }
    echo "</select>";
    echo "</div>";
    echo "</form>";


    if (isset($_POST["selectEvent"])) {

        $selectEvent = $_POST["selectEvent"];
        $query = "select DISTINCT VolunteerID, FirstName, MiddleName, LastName, MobileNumber, email from volunteer, account, volunteerparticipateonevent where account.Username = volunteer.VolunteerUsername and volunteer.VolunteerID = volunteerparticipateonevent.Volunteer_ID and volunteer.BlackList=0 and volunteerparticipateonevent.Event_ID = $selectEvent";

        $result = mysqli_query($con, $query);


        $numRows = mysqli_num_rows($result);
        if ($numRows <= 0) {
            echo "<br> <div class='row'>
    <div class='[ col-sm-12 col-sm-offset-1 col-md-11 ]'>  لا يوجد متطوعين في الوقت الحالي </div></div>";
        } else {
            echo "<form name='SendCertificateForm' method='POST'>"; //action='0000.php?AID=<?php echo $AID
            //creating a table for listing the volunteers in the selected event
            // إنشاء جدول لإضافة المتطوعين المشاركين بالفعالية المحددة
            echo "<br>";
            echo "<div>";
            echo "<table class='col-md-12 table-hover table-striped'>";
            echo "<tr>";
            //echo "<th> المهمه </th>";  // 0000 add to the table
            echo "<th> الشهاده</th>";
            echo "<th>البريد الإلكتروني</th>";
            echo "<th>رقم الجوال </th>";
            echo "<th>الاسم الثلاثي</th>";
            echo "<th>السجل المدني</th>";
            echo "<th><input type='checkbox' name='SelectAll' id='SelectAll' onchange='checkboxAll(this)'> </th>";
            echo "</tr>";
            //$num = 0; //7777
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
                //$num += 1; //7777
                //printing volunteers' info in the table
                //طباعة بيانات المتطوعين في الجدول
                echo "<td><a target='_blank' href='tcpdf/examples/certificate-English-email.php?volunteer_id=" . $VolunteerID . "&event_id=" . $selectEvent . "'><img src=\"images/certificate.png\" alt=\"Certificate\" ' /></a></td>";
                echo "<td> $email </td>";
                echo "<td> $MobileNumber </td>";
                echo "<td>" . $FirstName . " " . $MiddleName . " " . $LastName . "</td>";
                echo "<td> $VolunteerID</td>";
                //echo "<td><input type='checkbox' name='" . $num ."' />&nbsp;</td>"; //7777
                echo "<td> <input type='checkbox' name=CertificateSelection[] value=$VolunteerID> </td>";
                echo "</tr>";
            }
            echo "$error"; //0000
            echo "</table>";
            echo "<br><br><br>";
            echo "</div>";
            echo "<br><br><button Onclick='return sendEmailConfirmation();' type='submit' class='btn btn-success' name='sendEmail' id='sendEmail' value='Send Certificate'> إرسال الشهادة </button>";
            echo "</form>";
            
              echo "</div>";
        }
    }
    ?>
</div> </div>
</body>

    <?php include('includes/footer.php'); ?>
