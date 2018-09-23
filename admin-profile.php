<?php
$page_title = "لوحة التحكم"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
$_SESSION['admin'] = "true"; //000
include("includes/connection.php"); //connecting to the database
mysqli_set_charset($con, "utf8");

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


            header("Location: admin-profile.php");
        } else {
            header("Location: admin-profile.php");
        }
        break;
    //Add to blacklist
    case "addToBlacklist":
        if (isset($_GET['volunteer_id'])) {
            if (isset($_GET['volunteer_id'])) {
                $query = "UPDATE volunteer SET BlackList = 1 where VolunteerID=$id"; //0000
                $result = mysqli_query($con, $query);

                header("Location: admin-profile.php");
            }
        } else {
            header("Location: admin-profile.php");
        }
        break;
    case "AcceptVolunteer":
        if (isset($_GET['volunteer_id'])) {
            if (isset($_GET['event_id'])) {
                $event_id = $_GET['event_id'];
                $query = "UPDATE volunteerregisterinevent SET status = 1, Admin_ID=" . $_SESSION['id'] . " where Vounteer_ID=$id and Event_ID=$event_id";
                $result = mysqli_query($con, $query);
                $query2 = "INSERT INTO volunteerparticipateonevent (Volunteer_ID, Event_ID) VALUES ('$id', '$event_id')";
                $result2 = mysqli_query($con, $query2);
//0000
                //  header("Location: admin-profile.php");
            }
        } else {
            //0000000
            //header("Location: admin-profile.php");
        }
        break;
    case "RejectVolunteer":
        if (isset($_GET['volunteer_id'])) {
            if (isset($_GET['event_id'])) {
                $event_id = $_GET['event_id'];
                $query = "UPDATE volunteerregisterinevent SET status = 2, Admin_ID=" . $_SESSION['id'] . " where Vounteer_ID=$id and Event_ID=$event_id";
                $result = mysqli_query($con, $query);

                header("Location: admin-profile.php");
            }
        } else {
            header("Location: admin-profile.php");
        }
        break;
    case "EditTask":
        // id="defaultOpen"
        //onclick="openTab(event, 'event_volunteers')"
        // echo "<script type='text/javascript'> openTab(event, 'event_volunteers');</script>"; //0000

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

if (isset($_POST['sendEmail'])) {//0000
    //	echo "out";
    if (!isset($_POST['CertificateSelection'])) {
        $error = "Please select a volunteer";
    }
    if (isset($_POST['CertificateSelection']) && is_array($_POST['CertificateSelection'])) {
        $error = "";
        //		echo "middle";
        foreach ($_POST['CertificateSelection'] as $value) {
            //			echo "inside";
            //			echo "value = $value";
            // Email code , send the certificate via email to each selected volunteer
            $query = "SELECT email FROM account, volunteer WHERE account.Username=volunteer.VolunteerUsername and volunteer.VolunteerID=$value";
            $result = mysqli_query($con, $query);

            $row = mysqli_fetch_row($result);
            //			echo "email: " . $row[0];//0000
            //$row = mysqli_fetch_array($result);
            //	$query = "";
            //	connection
        }
    }
} else {
    $error = "";
}
?>

<style type="text/css">
    body{

        background-size:cover;
        background-attachment:fixed;
    }
    .kbtn{
        text-align: center;
        display: inline-block;
        margin: 0px;
        cursor: pointer;
        border-radius: 7px; 
        font-family: ge thameen;
    }
    .kbtn:hover {
        text-decoration: none;
    }
</style>
<!DOCTYPE html>
<!-- the header of the page-->

<script type="text/javascript">
    function ConfirmDeleteFromBlacklist()
    {
        var x = confirm("هل تريد إزالة المتطوع من القائمة السوداء؟");
        if (x)
            return true;
        else
            return false;
    }
    function ConfirmAddToBlacklist()
    {
        var x = confirm("هل تريد إضافة المتطوع للقائمة السوداء؟");
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
    <br>
    <div class="container-fluid">
        <div class="tab">

            <button class="tablinks" onclick="openTab(event, 'events')" id="defaultOpen">الفعاليات</button>
            <button class="tablinks" onclick="openTab(event, 'volunteer')">المتطوعون لدى الجمعية</button>
            <button class="tablinks" onclick="openTab(event, 'event_volunteers')">المتطوعون بالفعالية </button>
            <button class="tablinks" onclick="openTab(event, 'black_list')">القائمة السوداء </button>
            <button class="tablinks" onclick="openTab(event, 'certificate')">الشهادات </button>
            <button class="tablinks" onclick="openTab(event, 'admin')" >اضافة مسؤول</button>
            <button class="tablinks" onclick="openTab(event, 'profile')" >المعلومات الشخصية</button>
        </div>


        <!--All the events-->
        <div id="events" class="tabcontent">

            <?php include("admin_events_tab.php"); ?>

        </div>

        <!--All Volunteers-->

        <div id="volunteer" class="tabcontent">
            <?php include("admin_volunteer_tab.php"); ?>
        </div>
        <!--Volunteers at events-->  
        <div id="event_volunteers" class="tabcontent">
            <?php include("admin_volunteers_at_events_tab.php"); ?>
        </div>
        <!--
    
    
        Black list
        -->    <div id="black_list" class="tabcontent">
            <?php include("admin_blacklist_tab.php"); ?>
        </div><!--
    
        Certificate
        -->   <div id="certificate" class="tabcontent">
            <?php include("admin_certificate_tab.php"); ?>
        </div><!--
    
        add admin
        -->    <div id="admin" class="tabcontent">
            <?php include("admin-signup.php"); ?>
        </div><!--
        personal information
        -->    <div id="profile" class="tabcontent">
            <?php include("admin_personal_information_tab.php"); ?>
        </div>

    </div>


    <script>
        function openTab(evt, tabName) {
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

    <?php include('includes/footer.php'); ?>