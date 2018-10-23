<?php
$page_title = "تفاصيل عن الفعالية"; //page title to pass it to the header
include("includes/Header2.php"); // the header of the page
?>


<style>
    body{
        background-size:cover;
        background-attachment:fixed;
    }
    table {
        border: 1px solid black;
        border-collapse: collapse;
        background: #FCFBF9;
    }

    table:hover {background-color:#f5f5f5;}

    hr.style4 {
        border-top: 1px dotted #f5f5f5;
        width:600px;
    }
</style>	


<body>
    <!-- Page Header -->
    <header class="masthead inner" style="background-image: url('images/header-5.jpg')">
      <div class="overlay"></div>
      <div class="container-fluid p-r-l-51 p-t-160 ">
        <div class="row">
          <div class="col-lg-12 col-md-12 mx-auto">
            <div class="">
              <h2 class="yellow-text">الفعاليات</h2>
              <h4 class="subheading white-text">قم بالتسجيل بأحد الفعاليات التابعة لجمعية السرطان السعودية</h4>
            </div>
          </div>
        </div>
      </div>
    </header>


    <?php
    if (isset($_GET['EventID'])) {

        $EventID = $_GET['EventID'];
        $regbef = 'false';
        require 'includes/connection.php'; //connecting to the database
        if (isset($_SESSION['id'])) {
            $VoluID = $_SESSION['id'];

            $query1 = "select Vounteer_ID from volunteerregisterinevent where Event_ID='" . $EventID . "' and Vounteer_ID='" . $VoluID . "'";

            $result = mysqli_query($con, $query1);
            $rownum = mysqli_num_rows($result);
            if ($rownum >= 1) {
                $regbef = 'true';
            }
        }
        if (isset($_GET['reg'])) {
            $register = $_GET['reg'];

            if ($register === 'false') {
                $msg = '<div style="width: 700px; margin-left: auto; margin-right: auto;" class="alert alert-danger"> تأكد من تسجيل دخولك قبل التسجيل&ensp;'
                        . '<span class= "glyphicon glyphicon-send"></span> '
                        . 'ً</div>';

                echo $msg;
            } else if ($register === 'true') {
//            if(isset($_GET['regbef'])){//00000Kh
//            $regbefore= $_GET['regbef'];
//            //check if the volunteer registered in the same event before
//            if($regbefore === 'true'){
//                $msg = '<div style="width: 700px; margin-left: auto; margin-right: auto;" class="alert alert-danger">أنت مشارك في هذه الفعالية  &ensp;'
//                    . '<span class= "glyphicon glyphicon-send"></span> '
//                    . '</div>';
//            }else if($regbefore === 'false'){
//             
                $msg = '<div style="width: 700px; margin-left: auto; margin-right: auto;" class="alert alert-success">تم تسجيلك بنجاح&ensp;'
                        . '<span class= "glyphicon glyphicon-send"></span>'
                        . '</div>';

                //}
                echo $msg;
                //}
            }
        }
        //  if (isset($_GET['EventID'])) {
        //$EventID = $_GET['EventID'];
        // require 'includes/connection.php'; //connecting to the database
        mysqli_set_charset($con, "utf8");
        $get_events = "select * from event where EventID=$EventID";
        $run_events = mysqli_query($con, $get_events);
        while ($row_events = mysqli_fetch_array($run_events)) {

            $EventID = $row_events['EventID'];
            $EventName = $row_events['EventName'];
            $EventDescription = $row_events['EventDescription'];
            $EventImage = $row_events['EventImage'];
            $Location = $row_events['Location'];
            echo "

	 
		<table  style='height:40px; width:700px; margin-top:5px; margin-left: auto; margin-right: auto; border:2px #F8F7F3 solid;' >
		

<tr>
		
			<td   width='700'style='vertical-align: top;'> <strong><p align='center' > $EventName </p></strong>
			<p align='center'>   $EventDescription</p></td>
			
       <p> </tr>

		<tr>
		<td   width='400'style='vertical-align: top;'><p align='center'>  $Location </p></td>            
        </tr>
        <tr>
        <td  style='vertical-align: top;'> <p align='center'>:تاريخ الفعالية</p><p align='center' >";
            $qry2 = "SELECT * FROM dateofevent where Event_ID=$EventID";
            $result2 = mysqli_query($con, $qry2);

            while ($row = mysqli_fetch_array($result2)) {
                $Date = $row['Date'];
                echo "$Date <br> ";
            }
            echo" </p></td>
        </tr>
        <tr>
         </td>
            <td  style='vertical-align: top;'> <p align='center'>:للتسجيل في الفعالية اختر المهمة المطلوبة</p> 
            </td>
        </tr>
        <tr>
            <td colspan='2' align='center'><h6 align='center'>
            <form method='post' action='EventRegistration.php'>
            <input type='hidden' name='id' value='$EventID'>
                <center>
            <select class='form-control' name='TaskOption'>";
            $qry2 = "SELECT * FROM taskofevent where Event_ID=$EventID";

            $result2 = mysqli_query($con, $qry2);
            while ($row = mysqli_fetch_array($result2)) {
                $task = $row['Task'];
                echo "<option value='$task' >$task</option>";
            }

            echo " </select> </center>
                    <br>
                    <br>";


            if ($regbef == 'true') {
                echo "<strong><p style='color:red; font-size:14px;'>أنت مشارك في هذه الفعالية</p></strong>";
            } else {
                echo "<button type='submit' class='btn btn-success'>تسجيل</button>";
            }
            echo "</form></h6></td>
		</tr>
        </table >
        <hr class='style4'>";
        }
    }
    ?>


    <div class="row">

        <div class="col-sm-12">
            <a href="events.php" style="color:#fff; margin-right: 970px;" class="btn btn-success">عودة</a>
        </div></div>
    <br>
    <br>
    <!--Footer of the page -->

<?php include('includes/footer.php'); ?>
<script>
    $.fn.select2.defaults.set("theme", "bootstrap");
        $("select.form-control").select2({
            width: 150,
            dir: 'rtl'
        })
</script>
