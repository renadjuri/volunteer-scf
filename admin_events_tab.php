
<h1>الفعاليات</h1>
<br>
<p>.يمكنك اضافة ،حذف و تعديل الفعاليات</p> 
<!-- Style CSS -->

<link href="css/eventlist.css" rel="stylesheet" type="text/css" />

<!-- All events-->

<?php
$query = "select EventID, EventName,EventDescription,MaleNum,FemaleNum, Location,EventImage from event";
$result = mysqli_query($con, $query);


$numRows = "";

$numRows = mysqli_num_rows($result);
?>


<div class="container">
    <div class="row">
        <div class="[ col-sm-12 col-sm-offset-1 col-md-9 ]">
            <ul class="event-list">
                <?php
                if ($numRows <= 0) {
                    echo "<br> لا يوجد فعاليات في الوقت الحالي";
                } else {
                    while ($row = mysqli_fetch_array($result)) {
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
                                $EventImage = $row['EventImage'];
                                $DateofEvent = array();

                                $query = "select Date from dateofevent where Event_ID = '$EventID'";
                                $Date = mysqli_query($con, $query);

                                $numDates = "";

                                $numDates = mysqli_num_rows($Date);
                                if ($numDates <= 0) {
                                    $DateofEvent[] = "لم يتم تحديد موعد الفعالية";
                                } else {
                                    while ($Dates = mysqli_fetch_array($Date)) {
                                        foreach ($Dates as $id => $val) {
                                            $DateofEvent[] = $Dates['Date'];
                                        }
                                    }
                                }
                            }
                            ?>

                            <time>

                                <img src="https://placehold.it/120x120?text=IMAGE"/>
        <!--                                <img> 
                                //<?php echo $EventImage; ?>
        </img>-->

                            </time>
                            <div class = "info">
                                <h2 class = "title"> <?php echo $EventName; ?></h2>
                                <h2 class = "desc">  <?php echo $EventDescription; ?> </h2>
                                <p class = "desc"><b> الموقع: </b><?php echo $Location; ?> </p>
                                <p class = "desc"><b> الموعد:</b> <?php echo implode(', ', $DateofEvent); ?> </p>
                                <ul>
                                    <li style = "width:34%;"> <?php echo $MaleNum; ?> <span class = "fa fa-male"
                                                                                            ata-toggle = "tooltip" data-placement = "bottom" title = "عدد الذكور"></span></li>
                                    <li style = "width:34%;"><?php echo $FemaleNum; ?> <span class = "fa fa-female" 
                                                                                             ata-toggle = "tooltip" data-placement = "bottom" title = "عدد الإناث"></span></li>
                                </ul>
                            </div>
                            <div class = "edit">
                                <ul>
                                    <li style = "width:33%;" ><a href = "#" ata-toggle = "tooltip" data-placement = "bottom" title = "تعديل الفعالية">
                                            <span class = "glyphicon glyphicon-edit"></span></a></li>
                                    <br>
                                    <li style = "width:33%;" ><a href="#" ata-toggle = "tooltip" data-placement = "bottom" title = "حذف الفعالية">
                                            <span class = "glyphicon glyphicon-trash"></span></a></li>

                                    <?php
                                    
//                                    if (isset($_GET['id'])) { // if delete was requested AND an id is present...
//                                        $sql = "DELETE FROM `event` WHERE `EventID` = '" . $_GET['id'] . "'";
//                                        $result = mysqli_query($con, $sql);
//                                    }
                                    ?>

                                </ul>
                            </div>
                        </li>
                    <?php }
                    ?>
                </ul>
                <?php
            }
            ?>
        </div>
    </div>
</div>


