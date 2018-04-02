<!DOCTYPE html>
<?php
$page_title = "تسجيل مستخدم جديد"; //page title to pass it to the header
include("includes/Header.php"); // the header of the page
//include('server.php')
?>
<!DOCTYPE html>
<html>

    <style>

        body{
            background-size:cover;
            background-attachment:fixed;
        }
        #form-container {

            width: 600px;
            height: 850px;}
        #form-topcontainer {
            width: 590px;}

    </style>
</head>
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
                $query = "INSERT INTO volunteer (VolunteerID, FirstName, MiddleName, LastName, MobileNumber, DateOfBirth, Gender, nationality, residence, Qualification) 
         VALUES ('" . $VolunteerID . "', '" . $FirstName . "', '" . $MiddleName . "', '" . $LastName . "', '" . $MobileNumber . "', '" . $birthdate . "', '" . $gender . "', '" . $nationality . "', '" . $residence . "', '" . $qualification . "' );";

                if (!($DB = mysqli_connect('sql12.freemysqlhosting.net', 'sql12229449', 'xQDtaEtuwZ', 'sql12229449'))) {
                    die("could not connect to database");
                }
                // open database 
                if (!mysqli_select_db($DB, "sql12229449")) {
                    die("could not open cancer store to database");
                }
                // query database 
                if (!($result = mysqli_query($DB, $query))) {
                    die("could not execute the query");
                }
                mysqli_close($DB);

                //  echo "<br> لا يوجد فعاليات في الوقت الحالي";      
                echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
            }
            ?>

        </center>
</center>
<!--Footer of the page -->
<center>
    <div class="footer">
        <footer>             
            <?php include('includes/footer.php'); ?>
        </footer>
    </div>
</center>

</body>

</html>
