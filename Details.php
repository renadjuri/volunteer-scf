<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;  charset=utf-8" />
        <?php
        $page_title = "التفاصيل"; //page title to pass it to the header
        include('includes/Header.php'); // the header of the page
        ?>

        <style>
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

    </head>
    <body>


        <?php
        if (isset($_GET['EventID'])) {

            $EventID = $_GET['EventID'];
            $con = mysqli_connect("localhost", "root", "");

            mysqli_select_db($con, "cancergroup");

            if (!($con = mysqli_connect("localhost", "root", "")))
                die("cannot connect </body></html>");

            if (!mysqli_select_db($con, "cancergroup"))
                die("Could not open cancergroup database </body></html>");

            $get_events = "select * from event where EventID=$EventID";
            mysqli_query($con, "SET NAMES utf8");
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


                $qry2 = "SELECT * FROM dateofevent where Event_ID=$EventID";


                $result2 = mysqli_query($con, $qry2);
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
            <td colspan='2' align='left'><h6 align='right'> <select>";
                $qry2 = "SELECT * FROM taskofevent  
													 
													  where Event_ID=$EventID";


                $result2 = mysqli_query($con, $qry2);
                while ($row = mysqli_fetch_array($result2)) {
                    echo"<option>";
                    echo $row['Task'];
                    echo"</option>";
                }

                echo" </select> </h6></td>
		</tr>
        </table >
        <hr class='style4'>";
            }
        }
        ?>
        <br>
        <br>
        <!--Footer of the page -->
        <div class="footer">
            <footer>  
                <?php include('includes/footer.php'); ?>
            </footer>
        </div>
    </body>
</html>