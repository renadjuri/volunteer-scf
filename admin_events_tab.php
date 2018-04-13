
<!-- Tab Name -->
<legend> <h1>الفعاليات</h1></legend>

<br>
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
    <a href="admin_add_event.php" tabindex="5" class="btn btn-success">اضافة فعالية</a>

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

                                $query = "select Task from taskofevent where Event_ID = '$EventID'";
                                $Task = mysqli_query($con, $query);

                                $numtasks = "";

                                $numtasks = mysqli_num_rows($Task);
                                if ($numDates <= 0) {
                                    $Tasks[] = "لم يتم تحديد مهام الفعالية";
                                } else {
                                    while ($task = mysqli_fetch_array($Task)) {

                                        $Tasks[] = $task['Task'];
                                    }
                                }
                                $IMAGE = "select EventImage from event where EventID = '$EventID'";
                                $re = mysqli_query($con, $IMAGE);
                                //  $result =mysqli_fetch_array($re);
                                // this is code to display 
                                // echo '<time><img src="' . base64_encode($result['EventImage']) . '"/></time>';
                            }
                            ?>


                            <time><img /></time>


                            <div class = "info">
                                <h2 class = "title"> <?php echo $EventName; ?></h2>
                                <h2 class = "desc">  <?php echo $EventDescription; ?> </h2>
                                <p class = "desc"><b> الموقع: </b><?php echo $Location; ?> </p>
                                <p class = "desc"><b> الموعد:</b> <?php echo implode(', ', $DateofEvent); ?> </p>
                                <p class = "desc"><b> المهام:</b> <?php echo implode(', ', $Tasks); ?> </p>
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
                                        <form method="post" id='editform' action="#"> 

                                            <input type="hidden" name="ID" value="<?php echo $EventID; ?>"/>
                                            <button href="#" type="submit" name="edit" class="btn btn-success" 
                                                    ata-toggle = "tooltip" data-placement = "bottom" title = "تعديل الفعالية" >
                                                <span class="glyphicon glyphicon-edit"></span> </button>
                                            </span>
                                        </form>  
                                        <?php
                                        if (isset($_POST['edit'])) {
                                            include("admin_edit_event.php");
                                        }
                                        ?>
                                    </li>
                                    <br>
                                    <li style = "width:33%;" > 

                                        <form method="post" id='deleteform' action="#"> 
                                            <input type="hidden" name="ID" value="<?php echo $EventID; ?>"/>
                                            <button class="btn btn-danger" type="submit" name="submit"  
                                                    onclick="return confirm('هل انت متأكد من حذف هذه الفعالية؟');"
                                                    ata-toggle = "tooltip" data-placement = "bottom" title = "حذف الفعالية">
                                                <span class="glyphicon glyphicon-trash"></span> </button>
                                            </span>
                                        </form>   
                                    </li>                                   


                                    <?php
                                    if (isset($_POST['submit'])) {
                                        $ID = $_POST['ID']; // if delete was requested AND an id is present...
                                        $sql = "DELETE FROM `event` WHERE `EventID` = '" . $ID . "'";
                                        $Delete = mysqli_query($con, $sql);
                                        echo "<meta http-equiv='refresh' content='0'>";
                                    }
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


