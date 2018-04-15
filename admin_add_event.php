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
    $Task1 = $_POST['task1'];
    $Task2 = $_POST['task2'];
    $Task3 = $_POST['task3'];
    $Task4 = $_POST['task4'];
    $Task5 = $_POST['task5'];
    $Task6 = $_POST['task6'];
    $Task7 = $_POST['task7'];
    $Task8 = $_POST['task8'];
    
    $encoded_image = "Not uploaded";

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
    }

    $q = " INSERT INTO event ( EventName, EventDescription, MaleNum, FemaleNum, Location, EventImage, Admin_ID) VALUES"
            . " ('" . $eventName . "' , '" . $description . "' , '" . $MaleNum . "' , '" . $FemaleNum . "' , '" . $Location . "' , '" . $encoded_image . "' , '" . $ID . "')";

    $add = mysqli_query($con, $q);

    if ($add) {
        $last_insert_id = mysqli_insert_id($con);
        if ($last_insert_id) {
            $query = "INSERT INTO `dateofevent` (`Event_ID`, `Date`) VALUES ('" . $last_insert_id . "','" . $dateStart . "'), ('" . $last_insert_id . "', '" . $dateEnd . "');";
            $qTasks = "INSERT INTO `taskofevent` (`Event_ID`, `Task`) VALUES ('" . $last_insert_id . "', '" . $Task1 . "'),('" . $last_insert_id . "', '" . $Task2 . "'),"
                    . "('" . $last_insert_id . "', '" . $Task3 . "'),('" . $last_insert_id . "', '" . $Task4 . "'),('" . $last_insert_id . "', '" . $Task5 . "')"
                    . ",('" . $last_insert_id . "', '" . $Task6 . "'),('" . $last_insert_id . "', '" . $Task7 . "'),('" . $last_insert_id . "', '" . $Task8 . "');";
            
            $addtasks = mysqli_query($con, $qTasks);
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


<div class="container">
    <div class="panel panel-login">
        <div class="panel-heading">
            <div class="row">       
                <div class="col-lg-12">
                    <h1>اضافة فعالية</h1>
                </div>
            </div>
            <hr>
        </div>
        <div class="panel-body">
            <form method="post" id="add_event-form"  role="form" style="display: block;"
                  autocomplete="on" >

                <table class="pull-right col-sm-10 col-sm-offset-1 float-right">
                    <tr  class="col-sm-12">
                        <td>
                            <!-- name-->
                            <input id="eventName"  name="eventName" type="text"  tabindex="1" placeholder="عنوان الفعالية " style=" text-align: right;" required="الرجاء ادخال البيانات"  
                                   value="<?php
                                   if (isset($_POST['eventName'])) {
                                       echo $_POST['eventName'];
                                   }
                                   ?>" >
                        </td>
                        <td>
                            <label type="text">مسمى الفعالية</label>
                        </td>

                    </tr>

                    <!-- description-->

                    <tr  class="col-sm-12">

                        <td>
                            <textarea class="form-control text-right" cols="80" rows="4" name="description"
                                      placeholder="تفاصيل الفعالية" tabindex="2"  
                                      ata-toggle="tooltip" data-placement="bottom" title="تفاصيل الفعالية "  value="<?php
                                      if (isset($_POST['description'])) {
                                          echo $_POST['description'];
                                      }
                                      ?>" ></textarea> 

                        </td>
                        <td>
                            <label type="text" >نبذة عن الفعالة</label>
                        </td>

                    </tr>


                    <!-- Date-->

                    <tr  class="col-sm-12">

                        <td>
                            <input id="dateEnd" name="dateEnd" type="date" style=" text-align: right;"  required=""tabindex="3"  
                                   ata-toggle="tooltip" data-placement="bottom" title="تاريخ نهاية الفعالية" value="<?php
                                   if (isset($_POST['dateEnd'])) {
                                       echo $_POST['dateEnd'];
                                   }
                                   ?>">
                        </td>
                        <td>
                            <input id="dateStart" name="dateStart" type="date" style=" text-align: right;"  required=""tabindex="4"  
                                   ata-toggle="tooltip" data-placement="bottom" title="تاريخ بداية الفعالية" value="<?php
                                   if (isset($_POST['dateStart'])) {
                                       echo $_POST['dateStart'];
                                   }
                                   ?>">
                        </td>
                        <td>
                            <label type="text">تاريخ  الفعالية</label>
                        </td>
                    </tr>


                    <!-- location-->


                    <tr  class="col-sm-12">
                        <td>

                            <input id="address" name="location" type="text" style=" text-align: right;"  required="" 
                                   placeholder="مقر الاقامة " tabindex="5"  
                                   ata-toggle="tooltip" data-placement="bottom" title="مقر اقامة الفعالية"  value="<?php
                                   if (isset($_POST['location'])) {
                                       echo $_POST['location'];
                                   }
                                   ?>">
                        </td>
                        <td>
                            <label type="text">مقر اقامة الفعالية</label>
                        </td>
                    </tr>




                    <tr  class="col-sm-12">
                        <td>
                            <label><input type="number" name="FemaleNum"  tabindex="7"
                                          ata-toggle="tooltip" data-placement="bottom" title="عدد الإناث"  value="<?php
                                          if (isset($_POST['FemaleNum'])) {
                                              echo $_POST['FemaleNum'];
                                          }
                                          ?>">أنثى   </label>
                        </td>
                        <td>

                            <label><input type="number" name="MaleNum"   tabindex="6"
                                          ata-toggle="tooltip" data-placement="bottom" title="عدد الذكور" value="<?php
                                          if (isset($_POST['MaleNum'])) {
                                              echo $_POST['MaleNum'];
                                          }
                                          ?>">ذكر   </label>
                        </td>
                        <td>
                            <label>عدد المتطوعين</label>
                        </td>

                    </tr>

                    <tr  class="col-sm-12">
                        <td>
                            <input id="tasks" name="task1" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                   if (isset($_POST['task1'])) {
                                       echo $_POST['task1'];
                                   }
                                   ?>">
                            <input id="tasks" name="task2" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                   if (isset($_POST['tasks2'])) {
                                       echo $_POST['task2'];
                                   }
                                   ?>">
                            <input id="tasks" name="task3" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                   if (isset($_POST['tasks3'])) {
                                       echo $_POST['task3'];
                                   }
                                   ?>">
                            <input id="tasks" name="task4" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                   if (isset($_POST['task4'])) {
                                       echo $_POST['task4'];
                                   }
                                   ?>">


                            <input id="tasks" name="task5" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                   if (isset($_POST['tasks5'])) {
                                       echo $_POST['task5'];
                                   }
                                   ?>">
                            <input id="tasks" name="task6" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                   if (isset($_POST['task6'])) {
                                       echo $_POST['task6'];
                                   }
                                   ?>">
                            <input id="tasks" name="task7" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                   if (isset($_POST['task7'])) {
                                       echo $_POST['task7'];
                                   }
                                   ?>">
                            <input id="tasks" name="task8" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية" value="<?php
                                   if (isset($_POST['task8'])) {
                                       echo $_POST['task8'];
                                   }
                                   ?>">
                        </td>
                        <td>
                            <label type="text">المهام</label>
                        </td>
                    </tr>

                    <tr  class="col-sm-12">


                        <td><input type="file" id="uploadFile" name="uploadFile"    tabindex="9" style="text-align: right" value="<?php
                            if (isset($_POST['uploadFile'])) {
                                echo $_POST['uploadFile'];
                            }
                            ?>">
                        </td>
                        <td>
                            <label type="text" style=" text-align: right;" ata-toggle="tooltip" data-placement="bottom" title="اختر صورة">صورة  </label>
                        </td>

                    </tr>

                    <tr  class="col-sm-12">

                        <td> 


                            <a href="admin-profile.php" tabindex="11"  name="cancel" id="cancel" class="form-control btn btn-danger" >رجوع</a>


                        </td>
                        <td>

                            <input type="submit" name="add-submit" id="add-submit" tabindex="10"
                                   class="form-control btn btn-success" value="حفظ"/>

                        </td>

                    </tr>

                    <tr>
                        <td class="col-sm-12">
                            <?php echo $error; ?>
                            <?php echo $msg; ?>	
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>


<!--Footer of the page -->

<?php include('includes/footer.php'); ?>