<!DOCTYPE html>
<!-- the header of the page-->
<?php
$page_title = "الفعاليات"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>

<style type="text/css">
    body{
        background-size:cover;
        background-attachment:fixed;
    }
    table {
        border: 1px solid black;
        border-collapse: collapse;
        background: #FCFBF9;
    }
    td {
        border: none;
    }

    table:hover {background-color:#f5f5f5;}

    hr.style4 {
        border-top: 1px dotted #f5f5f5;
        width:600px;
    }

</style>
<!-- Style CSS -->

<link href="css/eventlist.css" rel="stylesheet" type="text/css" />
<body>

    <br>


    <?php
    require 'includes/connection.php'; //connecting to the database
    mysqli_set_charset($con, "utf8");

    $get_events = "select * from event ";

    $run_events = mysqli_query($con, $get_events);
    $numRows = mysqli_num_rows($run_events);
    ?>

    <div class="row ">
        <div class="[col-sm-10 col-sm-offset-2 col-md-8 ]">
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
                                $Tasks = array();
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



                                $sql = "select EventImage from event where EventID = '$EventID'";
                                $result1 = mysqli_query($con, $sql);
                                $numimages = mysqli_num_rows($result1);
                                if ($numimages <= 0) {
                                    $Image = "https://placehold.it/50x80?text=IMAGE";
                                } else {
                                    while ($image = mysqli_fetch_array($result1)) {

                                        $Image = 'data:image/jpeg;base64,' . base64_encode($image['EventImage']) . '"';
                                    }
                                }
                            }
                            ?>


                            <time><img  src="<?php echo$Image ?>" /></time>


                            <div class = "info">
                                <h2 class = "title"> <?php echo $EventName; ?></h2>
                                <h2 class = "desc">  <?php echo $EventDescription; ?> </h2>
                                <br>
                                <p class = "desc"><b> الموقع: </b><?php echo $Location; ?> </p>
                                <p class = "desc"><b> الموعد:</b> <?php echo implode(', ', $DateofEvent); ?> </p>
                                
                                <p align='left'><a href='Details.php?EventID=<?php echo $EventID ?>'  > .الإطلاع على المزيد</a></p>
                                
                                        <ul>
                                            <li style = "width:34%;"> <?php echo $MaleNum; ?> <span class = "fa fa-male"
                                                                                                    ata-toggle = "tooltip" data-placement = "bottom" title = "عدد الذكور"></span></li>
                                            <li style = "width:34%;"><?php echo $FemaleNum; ?> <span class = "fa fa-female" 
                                                                                                     ata-toggle = "tooltip" data-placement = "bottom" title = "عدد الإناث"></span></li>
                                        </ul>
                            </div>
                            <div class = "edit">
                                <ul>
                                    <br>
                                    <li style = "width:33%;" >

                                    </li>
                                    <br>
                                    <li style = "width:33%;" > 

                                    </li>                                   


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
     