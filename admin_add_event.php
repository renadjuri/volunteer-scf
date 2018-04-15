<?php
$page_title = "اضافة فعالية"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
?>


<?php
require 'includes/connection.php'; //connecting to the database
mysqli_set_charset($con, "utf8");
$msg = $error ="";
$ID = $_SESSION['id'];
if (isset($_POST['add-submit'])) {
    $eventName = $_POST['eventName'];
    $description = $_POST['description'];
    $MaleNum = $_POST['MaleNum'];
    $FemaleNum = $_POST['FemaleNum'];
    $Location = $_POST['location'];
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];
    $Tasks= $_POST['tasks'];
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
            $qTasks = "INSERT INTO `taskofevent` (`Event_ID`, `Task`) VALUES ('" . $last_insert_id . "', '" . $Tasks . "');";
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
    <div class="row">
        <div class="col-lg-12 ">
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
                    <div class="row">
                        <div class="col-lg-12"> 


                            <form method="post" id="add_event-form"  role="form" style="display: block;"
                                  autocomplete="on" >
                                <!-- name-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <input id="eventName" name="eventName" type="text"  tabindex="1" placeholder="عنوان الفعالية " style=" text-align: right;"  required="الرجاء ادخال البيانات">
                                            <label type="text">مسمى الفعالية</label>

                                        </div>
                                    </div>
                                </div>
                                <!-- description-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <label type="text" >نبذة عن الفعالة</label>
                                            <textarea class="form-control text-right" cols="80" rows="4" name="description"
                                                      placeholder="تفاصيل الفعالية" tabindex="2"  
                                                      ata-toggle="tooltip" data-placement="bottom" title="تفاصيل الفعالية "></textarea> 

                                        </div>
                                    </div>
                                </div>
                                <!-- Date-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <input id="dateEnd" name="dateEnd" type="date" style=" text-align: right;"  required=""tabindex="3"  
                                                   ata-toggle="tooltip" data-placement="bottom" title="تاريخ نهاية الفعالية">
                                            <input id="dateStart" name="dateStart" type="date" style=" text-align: right;"  required=""tabindex="4"  
                                                   ata-toggle="tooltip" data-placement="bottom" title="تاريخ بداية الفعالية">

                                            <label type="text">تاريخ  الفعالية</label>
                                        </div>
                                    </div>
                                </div>


                                <!-- location-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">

                                            <input id="address" name="location" type="text" style=" text-align: right;"  required="" 
                                                   placeholder="مقر الاقامة " tabindex="5"  
                                                   ata-toggle="tooltip" data-placement="bottom" title="مقر اقامة الفعالية">
                                            <label type="text">مقر اقامة الفعالية</label>
                                        </div>
                                    </div>
                                </div>





                                <div class="form-group">
                                    <div class="row">

                                        <div class="col-sm-10 col-sm-offset-1">
                                            <label><input type="number" name="FemaleNum"  tabindex="7"
                                                          ata-toggle="tooltip" data-placement="bottom" title="عدد الإناث">أنثى   </label>

                                            <label><input type="number" name="MaleNum"   tabindex="6"
                                                          ata-toggle="tooltip" data-placement="bottom" title="عدد الذكور">ذكر   </label>
                                            <label>عدد المتطوعين</label>

                                        </div>
                                    </div>
                                </div>


                                <!-- Tasks-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <input id="tasks" name="tasks" type="text" placeholder="المهام"  tabindex="8" style=" text-align: right;"  
                                                   ata-toggle="tooltip" data-placement="bottom" title="المهام الاساسية">
                                            <label type="text">المهام</label>

                                        </div>
                                    </div>
                                </div>

                                <!-- Image--> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <label type="text" style=" text-align: right;" ata-toggle="tooltip" data-placement="bottom" title="اختر صورة">صورة  </label>
                                            <input type="file" id="uploadFile" name="uploadFile"    tabindex="9" style="text-align: right">


                                        </div>
                                    </div>
                                </div>
                                <!-- Button (Double) -->
                                <div class="form-group">
                                    <div class="row">  
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="col-sm-3"  >

                                                <a href="admin-profile.php" tabindex="11"  name="cancel" id="cancel" class="form-control btn btn-danger" >رجوع</a>

                                            </div>
                                            <div class="col-sm-3">
                                                <input type="submit" name="add-submit" id="add-submit" tabindex="10"
                                                       class="form-control btn btn-success" value="حفظ"/>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <?php echo $error; ?>
                                        <?php echo $msg; ?>	
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer of the page -->

<?php include('includes/footer.php'); ?>