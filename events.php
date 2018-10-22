<?php
$page_title = "الفعاليات"; //page title to pass it to the header
include("includes/Header2.php"); // the header of the page
?>


<link href="css/eventlist.css" rel="stylesheet" type="text/css" />
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
    require 'includes/connection.php'; //connecting to the database
    mysqli_set_charset($con, "utf8");

    $get_events = "select * from event ";

    $run_events = mysqli_query($con, $get_events);
    $numRows = mysqli_num_rows($run_events);
    ?>

  <div class="container-fluid p-r-l-51 p-b-50">    
            <div class="row">
				
                <?php
                if ($numRows <= 0) {
                    echo "<br> لا يوجد فعاليات في الوقت الحالي";
                } else {
                    while ($row = mysqli_fetch_array($run_events)) {
                        ?>
                        <div class="col-md-4">
                            <?php
                            foreach ($row as $id => $val) {
                                $EventID = $row['EventID'];
                                $EventName = $row['EventName'];
                                $Location = $row['Location'];
                                $EventDescription = $row['EventDescription'];
                                $MaleNum = $row['MaleNum'];
                                $FemaleNum = $row['FemaleNum'];

                                $DateofEvent = array();

                                $query = "select Date from dateofevent where Event_ID = '$EventID'";
                                $Date = mysqli_query($con, $query);

                                $numDates = "";

                                $numDates = mysqli_num_rows($Date);
                                if ($numDates <= 0) {
                                    $DateofEvent[] = "لم يتم تحديد موعد الفعالية";
                                } else {
                                    while ($Dates = mysqli_fetch_array($Date)) {

                                        $DateofEvent[] = $Dates['Date'];
                                    }
                                }


                                $query = "select `EventImage` from `event` where EventID ='$EventID'";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) >= 1) {
                                    $row2 = mysqli_fetch_object($result);
                                   $Image= '<img src="'.$row2->EventImage.'" width=150; >';

                              
                                }
                            }
                            ?>


<!--                            <time><?php echo $Image; ?></time>-->
                            
                            <div class = "info info1 pos-relative">
                                <h4 class = "title"> <?php echo $EventName; ?></h4>
                                <p class = "desc">  <?php echo $EventDescription; ?> </p>
                                <p class = "desc"><b> الموقع: </b><?php echo $Location; ?> </p>
                                <p class = "desc"><b> الموعد:</b> <?php echo implode(', ', $DateofEvent); ?> </p>

<div class="row register-button">
<div class="col-md-6 text-center"><span class = "fa fa-male display-block font-30 dark-green" ata-toggle = "tooltip" data-placement = "bottom" title = "عدد الذكور"></span><p class="font-20"><?php echo $MaleNum; ?> </p></div>
<div class="col-md-6 text-center"><span class = "fa fa-female display-block font-30 dark-green" ata-toggle = "tooltip" data-placement = "bottom" title = "عدد الإناث"></span><p class="font-20"><?php echo $FemaleNum; ?> </p></div>


	<div class="col-md-12 text-center">
	<a href='Details.php?EventID=<?php echo $EventID ?>' class="btn btn-success btn-block">تسجيل</a>
		
	</div>
</div>

                           
                            </div>

                        </div>
                    <?php }
                    ?>
			</div>
            <?php } ?>
      
  </div>
    <!--Footer of the page -->

    <?php include('includes/footer.php');
    ?>
     