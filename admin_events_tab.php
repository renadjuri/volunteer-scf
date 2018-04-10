
<h3>الفعاليات</h3>
<br>
<p>.يمكنك اضافة ،حذف و تعديل الفعاليات</p> 
<!-- Style CSS -->

<link href="css/eventlist.css" rel="stylesheet" type="text/css" />

<!-- All events-->

<?php
$query = "select EventID, EventName,EventDescription,MaleNum,FemaleNum, Location from event";
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
                            }
                            ?>

                            <time datetime = "2014-07-31 1600">
                                <span class = "day">31</span>
                                <span class = "month">Jan</span>
                               <!-- <span class = "year">2014</span>-->
                                <span class = "time">4:00 PM</span>
                            </time>
                            <div class = "info">
                                <h2 class = "title"> <?php echo $EventName; ?></h2>
                                <h2 class = "desc">  <?php echo $EventDescription; ?> </h2>
                                <p class = "desc">  <?php echo $Location; ?> </p>

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
                                    <li style = "width:33%;" ><a href = "#" ata-toggle = "tooltip" data-placement = "bottom" title = "حذف الفعالية">
                                            <span class = "glyphicon glyphicon-trash"></span></a></li>

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


