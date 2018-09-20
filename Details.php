<?php
$page_title = "تفاصيل عن الفعالية"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
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

    <br>

    <?php
   
    if (isset($_GET['reg'])) {
        $register = $_GET['reg'];
        
        if ($register === 'false') {
             $msg = '<div class="alert alert-danger"> تأكد من تسجيل دخولك قبل التسجيل&ensp;'
                    . '<span class= "glyphicon glyphicon-send"></span> '
                    . 'ً</div>';
           
            echo $msg ;
            
        } else if ($register === 'true') {
            $msg = '<div class="alert alert-success">تم تسجيلك بنجاح&ensp;'
                    . '<span class= "glyphicon glyphicon-send"></span>'
                    . '</div>';

            echo $msg;
        }
    }
    if (isset($_GET['EventID'])) {

        $EventID = $_GET['EventID'];

        require 'includes/connection.php'; //connecting to the database
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
	  <br>
	  <br>
	  <br>
	 
		<table  style='height:40px; width:700px; margin-top:5px; margin-left: auto; margin-right: auto; border:2px #F8F7F3 solid;' >
		<tr>
                <td  width='200'> <p align='center' ><img src='images/events/$EventImage' height='170' width='200' alt='$EventName'></td>
                </tr>

<tr>
		
			<td   width='700'style='vertical-align: top;'> <p align='center' > $EventName </p>
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
            <select name='TaskOption'>";
            $qry2 = "SELECT * FROM taskofevent  
													 
													  where Event_ID=$EventID";


            $result2 = mysqli_query($con, $qry2);
            while ($row = mysqli_fetch_array($result2)) {
                echo'<option value="' . $row['Task'] . '">';
                echo $row['Task'];
                echo"</option>";
            }

            echo" </select> 
                    <br>
                    <br>

                    <button type='submit'>التسجيل</button>
                    </form></h6></td>
		</tr>
        </table >
        <hr class='style4'>";
        }
    }
    ?>
    <br>
    <br>
    <!--Footer of the page -->

    <?php include('includes/footer.php'); ?>
