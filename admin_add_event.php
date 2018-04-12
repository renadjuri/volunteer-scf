<?php
require 'includes/connection.php'; //connecting to the database
mysqli_set_charset($con, "utf8");
$msg = "";
$ID = $_SESSION['id'];
if (isset($_POST['add-submit'])) {
    $eventName = $_POST['eventName'];
    $description = $_POST['description'];
    $MaleNum = $_POST['MaleNum'];
    $FemaleNum = $_POST['FemaleNum'];
    $Location = $_POST['location'];
    $encoded_image = "notuploaded";

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
        }
    }

    $q = " INSERT INTO event ( EventName, EventDescription, MaleNum, FemaleNum, Location, EventImage, Admin_ID) VALUES"
            . " ('" . $eventName . "' , '" . $description . "' , '" . $MaleNum . "' , '" . $FemaleNum . "' , '" . $Location . "' , '" . $encoded_image . "' , '" . $ID . "')";

    $add = mysqli_query($con, $q);

    if ($add) {

        $msg = '<div class="alert alert-success">تم ضافة الفعالية بنجاح</div>';
    } else {
        $msg = '<div class="alert alert-danger">حدث خطأ اثناء اضافة الفعالية الرجاء المحاولة لاحقا</div>';
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
                                            <input id="dateStart" name="dateEnd" type="date" style=" text-align: right;"  required=""tabindex="3"  
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


                                <!-- notes-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <input id="notes" name="notes" type="text" placeholder="الملاحظات"  tabindex="8" style=" text-align: right;"  
                                                   ata-toggle="tooltip" data-placement="bottom" title="ملاحظات اضافية">
                                            <label type="text">الملاحظات</label>

                                        </div>
                                    </div>
                                </div>

                                <!-- Image--> 
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <label type="text" style=" text-align: right;" ata-toggle="tooltip" data-placement="bottom" title="اختيار صورة">صورة  </label>
                                            <input type="file" id="uploadFile" name="uploadFile"    tabindex="9" style="text-align: right">


                                        </div>
                                    </div>
                                </div>
                                <!-- Button (Double) -->
                                <div class="form-group">
                                    <div class="row">  
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <div class="col-sm-3"  >
                                                <input  onclick="openTab(event, 'events')"  type="submit" name="cancel" id="cancel"  tabindex="4" class="form-control btn btn-danger" 
                                                        value="الغاء"/>
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

