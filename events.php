<?php
$page_title = "الفعاليات"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>

<style type="text/css">
    body{
        background-size:cover;
        background-attachment:fixed;
    }
    .event-list > li > time {

        color: rgb(255, 255, 255);
        background-color:#8db792 ;
        padding: 5px;
        text-align: center;
        text-transform: uppercase;
        display: inline-block;
        width: 150px;
        height: 130px;
        padding: 0px;
        margin: 0px;
        float: right;
    }
    .event-list > li {
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
        padding: 0px;
    }


    .event-list > li > .info {
        padding-top: 5px;

        overflow: hidden;
        position: relative;
        height: 100%;
        text-align: right;
        padding-right: 40px;
    }
</style>
<!-- Style CSS -->

<link href="css/eventlist.css" rel="stylesheet" type="text/css" />
<body>
        <!-- Page Header -->
    <header class="masthead" style="background-image: url('images/header-2.png')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>الفعاليات</h1>
              <span class="subheading">قم بالتسجيل بأحد الفعاليات التابعة لجمعية السرطان السعودية</span>
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

    <div class="row ">
        <div class="[col-sm-8 col-sm-offset-2 col-md-8 ]">
            <ul class="event-list">
                <?php
                if ($numRows <= 0) {
                    echo "<br> لا يوجد فعاليات في الوقت الحالي";
                } else {
                    while ($row = mysqli_fetch_array($run_events)) {
                        ?>
                        <li>
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


                            <time><?php echo $Image; ?></time>
                            
                            <div class = "info">
                                <h2 class = "title"> <?php echo $EventName; ?></h2>
                                <h2 class = "desc">  <?php echo $EventDescription; ?> </h2>
                                <br>
                                <p class = "desc"><b> الموقع: </b><?php echo $Location; ?> </p>
                                <p class = "desc"><b> الموعد:</b> <?php echo implode(', ', $DateofEvent); ?> </p>

                                <div align='left'>&nbsp;&nbsp;<a href='Details.php?EventID=<?php echo $EventID ?>' class="btn btn-success">تسجيل</a></div>

                                <ul>
                                    <li style = "width:34%;"> <?php echo $MaleNum; ?> <span class = "fa fa-male"
                                                                                            ata-toggle = "tooltip" data-placement = "bottom" title = "عدد الذكور"></span></li>
                                    <li style = "width:34%;"><?php echo $FemaleNum; ?> <span class = "fa fa-female" 
                                                                                             ata-toggle = "tooltip" data-placement = "bottom" title = "عدد الإناث"></span></li>
                                </ul>
                            </div>

                        </li>
                    <?php }
                    ?>
                </ul>
            <?php } ?>
        </div>
    </div>
    <br>
    <br>
    <!--Footer of the page -->

    <?php include('includes/footer.php');
    ?>
     