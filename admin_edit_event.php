
<?php
$page_title = "تعديل فعالية"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
//SetCookie("event","1",1); 
$EventID = $_POST['ID'];
?>

<?php
require 'includes/connection.php'; //connecting to the database
mysqli_set_charset($con, "utf8");
$msg = $error = "";
$ID = $_SESSION['id'];

$query = "select * from event where EventID=$EventID";
$result = mysqli_query($con, $query);
$numRows = mysqli_num_rows($result);
if ($numRows <= 0) {
    echo "<br> نعتذر لقد حدث خلل، نرجو الخروج و محاولة الدخول للنظام مرة أخرى";  //0000
} else {
    while ($row = mysqli_fetch_array($result)) {

        $eventName = $row['EventName'];
        $Description = $row['EventDescription'];
        $MaleNum = $row['MaleNum'];
        $FemaleNum = $row['FemaleNum'];
        $Location = $row['Location'];
        $EventImage = $row['EventImage'];
    }
}


$qry2 = "SELECT * FROM dateofevent where Event_ID=$EventID";
$result2 = mysqli_query($con, $qry2);
$Date = array();

while ($row = mysqli_fetch_array($result2)) {
    $Date[] = $row['Date'];
}


$qry3 = "SELECT * FROM taskofevent where Event_ID=$EventID";
$result3 = mysqli_query($con, $qry3);
$Tasks = array();

while ($row = mysqli_fetch_array($result3)) {
    $Tasks[] = $row['Task'];
}


if (isset($_POST['aupdate-submit'])) {
    $eventName = $_POST['eventName'];
    $description = $_POST['description'];
    $MaleNum = $_POST['MaleNum'];
    $FemaleNum = $_POST['FemaleNum'];
    $Location = $_POST['location'];

   


    if (isset($_FILES['uploadFile']['name']) && !empty($_FILES['uploadFile']['name'])) {
        //Allowed file type
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        //File extension
        $ext = strtolower(pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION));

        //Check extension
        if (in_array($ext, $allowed_extensions)) {
            //Convert image to base64
            $encoded_image = base64_encode(file_get_contents($_FILES['uploadFile']['tmp_name']));
            $encoded_image = 'data:image/' . $ext . ';base64,' . $encoded_image;
        } else {
            $error = '<div class="alert alert-danger">صيغة الملف المرفوع غير صحيحة</div>';
        }
    }else{
         $encoded_image = "Not uploaded";
    }

    $q = " UPDATE event SET EventName='$eventName' ,EventDescription='$description',MaleNum='$MaleNum',FemaleNum ='$FemaleNum', Location='$Location',EventImage='$encoded_image',
         Admin_ID='$ID'  WHERE event.EventID=  '" . $EventID . "'";


    $update = mysqli_query($con, $q);

    if ($update) {

        $query1 = "UPDATE `dateofevent` SET `Event_ID`= '$EventID' ,`Date`='" . $_POST['dateEnd'] . "' WHERE `Event_ID`='$EventID' and `Date = $Date[1]";
        $query2 = "UPDATE `dateofevent` SET `Event_ID`='$EventID',`Date`='" . $_POST['dateStart'] . "' WHERE `Event_ID`='$EventID' and `Date`= $Date[0]";



        $result = mysqli_query($con, $query1);
        $result2 = mysqli_query($con, $query2);
        if ($result && $result2) {
            $msg = '<div class="alert alert-success">تم تعديل الفعالية بنجاح</div>';
//            }
        } else {
            $msg = '<div class="alert alert-danger">حدث خطأ اثناء تعديل الفعالية الرجاء المحاولة لاحقا</div>';
        }
    }
}
?>
<!-- Style CSS -->

<link href="css/style-login.css" rel="stylesheet" type="text/css" />


<div class="container">
    <div class="panel-heading">
        <div class="row">       
            <div class="col-lg-12">
                <legend> <h1>تعديل فعالية</h1></legend>
            </div>

        </div>

    </div>

    <div class="row">
        <div class="[ col-sm-8 col-sm-offset-3 col-md-12 ]">
            <form method="post" id="add_event-form"  role="form" style="  text-align: right;"  autocomplete="on" >
                <div class="form-group">
                    <table class='table-striped'>
                         <tr>
                            <td colspan="3">
                                <?php echo $error; ?>
                                <?php echo $msg; ?>	
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <!-- name-->
                                <input id="eventName"  name="eventName" type="text"  tabindex="1" placeholder="عنوان الفعالية " style=" text-align: right;" required="الرجاء ادخال البيانات"  
                                       value= "<?php print "$eventName"; ?>" >
                            </td>
                            <td>
                                <label type="text">مسمى الفعالية</label>
                            </td>

                        </tr>

                        <!-- description-->

                        <tr>

                            <td colspan="2">
                                <textarea class="form-control text-right" cols="100"rows="4" name="description"
                                          placeholder="تفاصيل الفعالية" tabindex="2"  
                                          ata-toggle="tooltip" data-placement="bottom" title="تفاصيل الفعالية " value="<?php print "$Description"; ?>" ></textarea> 

                            </td>
                            <td>
                                <label type="text" >نبذة عن الفعالة</label>
                            </td>

                        </tr>


                        <!-- Date-->

                        <tr>

                            <td>
                                <input id="dateEnd" name="dateEnd" type="date" style=" text-align: right;"  required=""tabindex="3"  
                                       ata-toggle="tooltip" data-placement="bottom" title="تاريخ نهاية الفعالية" value="<?php echo "$Date[1]" ?>" >
                            </td>
                            <td>
                                <input id="dateStart" name="dateStart" type="date" style=" text-align: right;"  required=""tabindex="4"  
                                       ata-toggle="tooltip" data-placement="bottom" title="تاريخ بداية الفعالية" value="<?php echo "$Date[0]" ?>" >
                            </td>
                            <td>
                                <label type="text">تاريخ  الفعالية</label>
                            </td>
                        </tr>


                        <!-- location-->
                        <tr>
                            <td colspan="2">

                                <input id="address" name="location" type="text" style=" text-align: right;"  required="" 
                                       placeholder="مقر الاقامة " tabindex="5"  
                                       ata-toggle="tooltip" data-placement="bottom" title="مقر اقامة الفعالية"  value="<?php print ($Location); ?>" >
                            </td>
                            <td>
                                <label type="text">مقر اقامة الفعالية</label>
                            </td>
                        </tr>

                        <tr><td>

                                <label><input type="number" name="FemaleNum"  tabindex="7"
                                              ata-toggle="tooltip" data-placement="bottom" title="عدد الإناث"  value="<?php print ($FemaleNum); ?>" >أنثى </label>
                            </td>
                            <td>

                                <label><input type="number" name="MaleNum"   tabindex="6"
                                              ata-toggle="tooltip" data-placement="bottom" title="عدد الذكور" value="<?php print ($MaleNum); ?>" > </label>
                            </td>
                            <td>
                                <label>عدد المتطوعين</label>
                            </td>

                        </tr>

                        <tr>
                            <td>
                                <input id="task1" name="task1" type="text" placeholder="أضف مهمة"  tabindex="12" style=" text-align: right;"  
                                       ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية"  value="<?php
if (empty($Tasks[4])) {
    
} else {
    print "$Tasks[4]";
}
?>">

                                <input id="task2" name="task2" type="text" placeholder="أضف مهمة"  tabindex="13" style=" text-align: right;"  
                                       ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية"  value="<?php
                                       if (empty($Tasks[5])) {
                                           
                                       } else {
                                           print "$Tasks[5]";
                                       }
?>">
                                <input id="task3" name="task3" type="text" placeholder="أضف مهمة"  tabindex="14" style=" text-align: right;"  
                                       ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" 
                                       value="<?php
                                       if (empty($Tasks[6])) {
                                           
                                       } else {
                                           print "$Tasks[6]";
                                       }
?>">

                                <input id="task4" name="task4" type="text" placeholder="أضف مهمة"  tabindex="15" style=" text-align: right;"  
                                       ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                       if (empty($Tasks[7])) {
                                           
                                       } else {
                                           print "$Tasks[7]";
                                       }
?>">
                            </td>
                            <td>
                                <input id="task5" name="task5" type="text" placeholder="أضف مهمة"  tabindex="8" style=" text-align: right;"  
                                       ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                       if (empty($Tasks[0])) {
                                           
                                       } else {
                                           print "$Tasks[0]";
                                       }
?>">
                                <input id="task6" name="task6" type="text" placeholder="أضف مهمة"  tabindex="9" style=" text-align: right;"  
                                       ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                       if (empty($Tasks[1])) {
                                           
                                       } else {
                                           print "$Tasks[1]";
                                       }
?>">

                                <input id="task7" name="task7" type="text" placeholder="أضف مهمة"  tabindex="10"style=" text-align: right;"  
                                       ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" 
                                       value="<?php
                                       if (empty($Tasks[2])) {
                                           
                                       } else {
                                           print "$Tasks[2]";
                                       }
?>"> 


                                <input id="task8 " name="task8" type="text" placeholder="أضف مهمة"  tabindex="11"style=" text-align: right;"  
                                       ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية"  value="<?php
                                       if (empty($Tasks[3])) {
                                           
                                       } else {
                                           print "$Tasks[3]";
                                       }
?>"> 

                            </td>
                            <td>
                                <label type="text">المهام</label>
                            </td>
                        </tr>

                        <tr>

                            <td></td>
                            <td><input type="file" id="uploadFile" name="uploadFile"    tabindex="16" style="text-align: right" value="<?php
                                       if (isset($_POST['uploadFile'])) {
                                           echo $_POST['uploadFile'];
                                       }
?>">
                            </td>

                            <td>
                                <label type="text" style=" text-align: right;" ata-toggle="tooltip" data-placement="bottom" title="اختر صورة">صورة  </label>
                            </td>


                        </tr>

                        <tr>

                            <td> 
                                <a href="admin_events_tab.php" tabindex="18"  name="cancel" id="cancel" class="form-control btn btn-danger" >رجوع</a>
                            </td>
                            <td>
                                <input type="submit" name="update-submit" id="aupdate-submit" tabindex="17"
                                       class="form-control btn btn-success" value="حفظ"/>
                            </td>

                        </tr>

                       
                    </table>
                </div>
            </form>

        </div>
    </div>
</div>

<!--Footer of the page -->

<?php include('includes/footer.php'); ?>