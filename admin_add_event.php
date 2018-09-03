<?php
$page_title = "اضافة فعالية"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>


<?php
require 'includes/connection.php'; //connecting to the database
mysqli_set_charset($con, "utf8");
$msg = $error = "";
$ID = $_SESSION['id'];
if (isset($_POST['add-submit'])) {
    $eventName = $_POST['eventName'];
    $description = $_POST['description'];
    $MaleNum = $_POST['MaleNum'];
    $FemaleNum = $_POST['FemaleNum'];
    $Location = $_POST['location'];
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];
    $Tasks = array();

    for ($i = $n = 1; $i < 9; $i++) {
        if ($_POST['task' . $i]) {
            $Tasks[$n] = $_POST['task' . $i];
            $n++;
        }
    }

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
            echo print(1);
        } else {
            $error = '<div class="alert alert-danger">صيغة الملف المرفوع غير صحيحة</div>';
        }
    } else {
        $encoded_image = "";
    }


    $q = " INSERT INTO event ( EventName, EventDescription, MaleNum, FemaleNum, Location, EventImage, Admin_ID) VALUES"
            . " ('" . $eventName . "' , '" . $description . "' , '" . $MaleNum . "' , '" . $FemaleNum . "' , '" . $Location . "' , '" . $encoded_image . "' , '" . $ID . "')";

    $add = mysqli_query($con, $q);

    if ($add) {
        $last_insert_id = mysqli_insert_id($con);
        if ($last_insert_id) {
            $query = "INSERT INTO `dateofevent` (`Event_ID`, `Date`) VALUES ('" . $last_insert_id . "','" . $dateStart . "'), ('" . $last_insert_id . "', '" . $dateEnd . "');";

            $num_values = count($Tasks);
            $addtasks = "";
            for ($i = 1; $i <= $num_values; $i++) {
                $qTasks = "INSERT INTO `taskofevent` (`Event_ID`, `Task`) VALUES ('" . $last_insert_id . "', '" . $Tasks[$i] . "');";
                $addtasks = mysqli_query($con, $qTasks);
            }

            $result = mysqli_query($con, $query);
            if ($result && $addtasks) {
                $msg = '<div class="alert alert-success">تم ضافة الفعالية بنجاح</div>';
            }
        } else {
            $msg = '<div class="alert alert-danger">حدث خطأ اثناء اضافة الفعالية الرجاء المحاولة لاحقا</div>';
        }
    }
}
?>
<!-- Style CSS -->

<link href="css/style-login.css" rel="stylesheet" type="text/css" />



<div class="panel-heading">
    <div class="row">       
        <div class="col-lg-12">
            <legend> <h1>اضافة فعالية</h1></legend>
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
                                   >
                        </td>
                        <td style="width:20%">
                            <label type="text">مسمى الفعالية</label>
                        </td>



                    </tr>

                    <!-- description-->

                    <tr>

                        <td colspan="2">
                            <textarea class="form-control text-right" cols="100"rows="4" name="description"
                                      placeholder="تفاصيل الفعالية" tabindex="2"  
                                      ata-toggle="tooltip" data-placement="bottom" title="تفاصيل الفعالية "  ></textarea> 

                        </td>
                        <td>
                            <label type="text" >نبذة عن الفعالة</label>
                        </td>

                    </tr>


                    <!-- Date-->

                    <tr>

                        <td>
                            <input id="dateEnd" name="dateEnd" type="date" style=" text-align: right;"  required=""tabindex="3"  
                                   ata-toggle="tooltip" data-placement="bottom" title="تاريخ نهاية الفعالية" >
                        </td>
                        <td>
                            <input id="dateStart" name="dateStart" type="date" style=" text-align: right;"  required=""tabindex="4"  
                                   ata-toggle="tooltip" data-placement="bottom" title="تاريخ بداية الفعالية" >
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
                                   ata-toggle="tooltip" data-placement="bottom" title="مقر اقامة الفعالية"  >
                        </td>
                        <td>
                            <label type="text">مقر اقامة الفعالية</label>
                        </td>
                    </tr>

                    <tr><td>

                            <label><input type="number" name="FemaleNum"  tabindex="7"
                                          ata-toggle="tooltip" data-placement="bottom" title="عدد الإناث"  >أنثى </label>
                        </td>
                        <td>

                            <label><input type="number" name="MaleNum"   tabindex="6"
                                          ata-toggle="tooltip" data-placement="bottom" title="عدد الذكور">ذكر </label>
                        </td>
                        <td>
                            <label>عدد المتطوعين</label>
                        </td>

                    </tr>

                    <tr>
                        <td>
                            <input id="task1" name="task1" type="text" placeholder="المهام"  tabindex="12" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية">
                            <input id="task2" name="task2" type="text" placeholder="المهام"  tabindex="13" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" >
                            <input id="task3" name="task3" type="text" placeholder="المهام"  tabindex="14" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" >
                            <input id="task4" name="task4" type="text" placeholder="المهام"  tabindex="15" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" >
                        </td>
                        <td>
                            <input id="task5" name="task5" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" >
                            <input id="task6" name="task6" type="text" placeholder="المهام"  tabindex="9" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية">
                            <input id="task7" name="task7" type="text" placeholder="المهام"  tabindex="10"style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية">
                            <input id="task8 " name="task8" type="text" placeholder="المهام"  tabindex="11"style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" >

                        </td>
                        <td>
                            <label type="text">المهام</label>
                        </td>
                    </tr>

                    <tr>

                        <td></td>
                        <td><input type="file" id="uploadFile" name="uploadFile" value=""
                                   tabindex="16" style="text-align: right" >
                        </td>

                        <td>
                            <label type="text" style=" text-align: right;" ata-toggle="tooltip" data-placement="bottom" title="اختر صورة">صورة  </label>
                        </td>


                    </tr>

                    <tr>

                        <td> 


                            <a href="admin-profile.php" tabindex="18"  name="cancel" id="cancel" class="form-control btn btn-danger" >رجوع</a>


                        </td>
                        <td>

                            <input type="submit" name="add-submit" id="add-submit" tabindex="17"
                                   class="form-control btn btn-success" value="حفظ"/>

                        </td>

                    </tr>


                </table>
            </div>
        </form>

    </div>

</div>

<!--Footer of the page -->

<?php include('includes/footer.php'); ?>