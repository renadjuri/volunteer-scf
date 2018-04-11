<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = "لوحة التحكم"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
$_SESSION['admin'] = "true";
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

            $query = "UPDATE volunteer SET BlackList = 1 where VolunteerID=$id"; //0000

            $result = mysqli_query($con, $query);

            header("Location: admin-profile.php");
        } else {
            header("Location: admin-profile.php");
        }
        break;
}
?>

<style type="text/css">
    body{

        background-size:cover;
        background-attachment:fixed;
    }
</style>
<!DOCTYPE html>
<!-- the header of the page-->

<script type="text/javascript">
    function ConfirmDeleteFromBlacklist()
    {
        var x = confirm("Are you sure you want to remove the volunteer from the blacklist?");
        if (x)
            return true;
        else
            return false;
    }
    function ConfirmAddToBlacklist()
    {
        var x = confirm("Are you sure you want to add the volunteer to the blacklist?");
        if (x)
            return true;
        else
            return false;
    }
</script>

<body>

    <br>



    <div class="tab">

        <button class="tablinks" onclick="openTab(event, 'events')" id="defaultOpen">الفعاليات</button>
        <button class="tablinks" onclick="openTab(event, 'volunteer')">المتطوعون لدى الجمعية</button>
        <button class="tablinks" onclick="openTab(event, 'event_volunteers')">المتطوعون بالفعالية </button>
        <button class="tablinks" onclick="openTab(event, 'black_list')">القائمة السوداء </button>
        <button class="tablinks" onclick="openTab(event, 'certificate')">الشهادات </button>
        <button class="tablinks" onclick="openTab(event, 'profile')" >المعلومات الشخصية</button>
    </div>


    <!--All the events-->
    <div id="events" class="tabcontent">

        <?php include("admin_events_tab.php"); ?>

    </div>
    <div id="addevent" class="tabcontent">
        <?php include("admin_add_event.php"); ?>
    </div>
    <!--All Volunteers-->

    <div id="volunteer" class="tabcontent">
        <?php include("admin_volunteer_tab.php"); ?>
    </div>

    <!-- Volunteers at events-->
    <div id="event_volunteers" class="tabcontent">
        <?php include("admin_volunteers_at_events_tab.php"); ?>
    </div>


    <!--Black list-->
    <div id="black_list" class="tabcontent">
          <?php include("admin_blacklist_tab.php"); ?>
    </div>

    <!--Certificate-->
    <div id="certificate" class="tabcontent">
        <?php include("admin_certificate_tab.php"); ?>
    </div>

    <!--personal information-->
    <div id="profile" class="tabcontent">
          <?php include("admin_personal_information_tab.php"); ?>
    </div>

    <!--Footer of the page -->

    <?php include('includes/footer.php'); ?>

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
