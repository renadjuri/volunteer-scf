<!DOCTYPE html>
<?php
$page_title = "تسجيل مستخدم جديد"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
if (is_login()) {
    $CID = $get_user_data("ID");
}
?>

<style>

  
    #form-container {

        width: 500px;
        height: 400px;}


</style>

<body>

   
    <br>
<center>
    <div id="form-container" >
        <div id="form-topcontainer">
            <h1> تسجيل مستخدم جديد </h1>
        </div>
        <center>
            <form method="post" action="#" >

                <?php //$info = $account->getRow("cancergroup", $_SESSION["userid"]); ?>
                <?php //include('errors.php'); ?>
                <table>

                    <tr> 
                        <td> <input type="text" name="VolunteerID"placeholder="سجل مدني"></td>
                        <td><b> : الاقامة/ رقم السجل المدني</b></td>  
                    </tr>
                    <tr> 
                        <td> <input type="text" name="FirstName"></td>
                        <td><b> : الأسم الأول</b></td>  
                    </tr>
                    <tr> 
                        <td> <input type="text" name="MiddleName"placeholder="اسم الاب"></td>
                        <td><b> : الأسم الثاني</b></td>  
                    </tr>

                    <tr> 
                        <td> <input type="text" name="LastName"placeholder="العائلة"></td>
                        <td><b> : العائلة</b></td>  
                    </tr>
                    <tr>
                        <td> 
                            <input type="radio" name="gender" value="f" checked >أنثى<br>
                            <input type="radio" name="gender" value="m" > ذكر<br>

                        </td>

                        <td><b> : الجنس</b></td>                
                    </tr>
                    <tr> 
                        <td> <input type="text" name="MobileNumber"placeholder="رقم الهاتف"></td>
                        <td><b> : رقم الهاتف</b></td>  
                    </tr>
                    <tr> 
                        <td> <input type="text" name="residance"placeholder="مكان الاقامة"></td>
                        <td><b>  : مكان الاقامة</b></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name="birthdate" required >
                        </td>
                        <td><b>  : تاريخ الميلاد </b></td>

                    </tr><tr>
                        <td>
                            <input type="text"  name="nationality"  maxlength="10" required >
                        </td>
                        <td><b> :الجنسية</b></td>


                    </tr>
                    <tr>
                        <td>
                            <select name="edu_select">
                                <?php
                                /* $edu_select = $info->edu_select;
                                  if ($edu_select == "Master") {
                                  $Master = " selected='true'";
                                  }
                                  if ($edu_select == "Bachelor") {
                                  $Bachelor = " selected='true'";
                                  }
                                  if ($edu_select == "secondary") {
                                  $secondary = " selected='true'";
                                  }
                                  if ($edu_select == "Other") {
                                  $Other = " selected='true'";
                                  } */
                                ?>
                                <option value="Master" >ماجستير</option>
                                <option value="Bachelor" >بكالوريوس</option>
                                <option value="secondary"  >ثانوي</option>
                                <option value="Other"  >أخرى</option>

                            </select>
                        </td>
                        <td><b>  : المؤهل العلمي</b></td>

                    </tr>

                    <tr>
                        <td><button type="submit" name="submit" >تسجيل </button></td>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $FirstName = $_POST['FirstName'];
                $MiddleName = $_POST['MiddleName'];
                $LastName = $_POST['LastName'];
                $VolunteerID = $_POST['VolunteerID'];
                $MobileNumber = $_POST['MobileNumber'];
                $gender = $_POST['gender'];
                $birthdate = $_POST['birthdate'];
                $nationality = $_POST['nationality'];
                $qualification = $_POST['edu_select'];
                $residence = $_POST['residance'];

               $result= $query ("INSERT INTO volunteer (VolunteerID, FirstName, MiddleName, LastName, MobileNumber, DateOfBirth, Gender, nationality, residence, Qualification) 
         VALUES ('" . $VolunteerID . "', '" . $FirstName . "', '" . $MiddleName . "', '" . $LastName . "', '" . $MobileNumber . "', '" . $birthdate . "', '" . $gender . "', '" . $nationality . "', '" . $residence . "', '" . $qualification . "' );");

                //  echo "<br> لا يوجد فعاليات في الوقت الحالي";      
                echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
            }
            ?>

        </center>
    </div>
</center>
<!--Footer of the page -->

  
    <?php include('includes/footer.php'); ?>
