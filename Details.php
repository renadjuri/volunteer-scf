<!DOCTYPE html>

<?php
   $page_title = "تفاصيل عن الفعالية";//page title to pass it to the header
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
    if (isset($_GET['EventID'])) {

        $EventID = $_GET['EventID'];
      
        $run_events = $query( "select * from event where EventID=$EventID");
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
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
	  <br>
		<table  style='height:40px; width:700px; margin-top:5px; margin-left: auto; margin-right: auto; border:1px #F8F7F3 solid;' >
		<tr>
		<td  style='vertical-align: top;'> <p>:تاريخ الفعالية</p><p align='right' >";
             $result2= $query( "SELECT * FROM dateofevent where Event_ID=$EventID");
          
            while ($row = mysqli_fetch_array($result2)) {
                $Date = $row['Date'];
                echo "$Date <br> ";
            }
            echo" </p></td>
			<td  rowspan='2' width='700'style='vertical-align: top;'> <p align='right' > $EventName </p>
			<p align='right'>   $EventDescription سيتضمن البرنامج أمسيات حوارية، حيث تقام في اليوم الأول: أمسية “الوعي الاسري”، من تقديم الدكتور/خالد الحليبي، والدكتور/ عبد السلام الصقعبي، أما اليوم الثاني فستقام أمسية حوارية بعنوان “الوعي الذاتي”، من تقديم الدكتور/محمد المقهوي والدكتور/فهد الماجد.ا </p></td>
			
			<td rowspan='3' width='200'> <p align='right' ><img src='images/events/$EventImage' height='170' width='200' alt='$EventName'></td>
       <p> </tr>

		<tr>
		<td   width='400'style='vertical-align: top;'><p align='right'>  $Location </p></td>            
        </tr>
        <tr>
            <td colspan='2' align='left'><h6 align='right'>
            <form method='post' action='EventRegistration.php'>
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
                    <button type='submit'>Submit</button>
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
