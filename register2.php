<?php //include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css\style13.css" rel="stylesheet" type="text/css" />

        <style>

            body{
                background-size:cover; 
                background-attachment:fixed; 
            }

        </style>
    </head>
    <body>
        <!--Navigation menu-->
    <center><img src="images/logo.png" id="logo" ></center>

    <ul>
        <li><a href="index.php">الرئيسية </a></li>
        <li><a href="events.php">الفعاليات</a></li>
        <li><a href="includes/CharterofVolunteerism.pdf">ميثاق  التطوع</a></li>
        <li><a href="Contact_us.php">اتصل بنا</a></li>

    </ul>


  
    <br>
    <center>
        <div id="form-container" >
            <div id="form-topcontainer">
                <img id="logo-form" src="images/logo.png" alt="logo" width="100" />
                <h2> التسجيل </h2>  
            </div>
            <center>

                <form method="post" action="#" >

                    <?php //$info = $account->getRow("cancergroup", $_SESSION["userid"]); ?>
                    <?php //include('errors.php'); ?>
                    <table>
                        <tr>

                            <td>

                                
                              
                                <input type="radio" name="gender" value="f" checked >أنثى<br>
                                <input type="radio" name="gender" value="m" > ذكر<br>
                            
                                </td>
                            
                            <td><b> : الجنس</b></td>
                           
                            
                        </tr>
                        <tr> 
    <td> <input type="text" name="VolunteerID"placeholder="vID"></td>
                        </tr>
                        <tr> 
                            <td> <input type="text" name="FirstName"></td>
                        </tr>
                        <tr> 
                             <td> <input type="text" name="MiddleName"placeholder="middlename"></td>
                        </tr>
                        
                        <tr> 
                             <td> <input type="text" name="LastName"placeholder="lastname"></td>
                        </tr>
                        <tr> 
                             <td> <input type="text" name="MobileNumber"placeholder="mobilen"></td>
                        </tr>
                        <tr> 
                             <td> <input type="text" name="residance"placeholder="risedance"></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" name="birthdate" required >
                            </td>
                            <td><b>  : تاريخ الميلاد </b></td>

                        </tr><tr>
                            <td>
                                <input type="text"  name="id"  maxlength="10" required >
                            </td>
                            <td><b> : السجل المدني/الإقامة</b></td>

                        </tr>
                        <tr>
                            <td>
                                <select name="edu_select">
                                    <?php
                                    /*$edu_select = $info->edu_select;
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
                                    }*/
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
                if(isset($_POST['submit'])){
                    $FirstName = $_POST['FirstName'];
                    $MiddleName = $_POST['MiddleName'];
                    $LastName = $_POST['LastName'];
                    $VolunteerID = $_POST['VolunteerID'];
                    $MobileNumber = $_POST['MobileNumber'];
                    $gender = $_POST['gender'];
                    $birthdate = $_POST['birthdate'];
                    $nationality = $_POST['id'];
                    $qualification = $_POST['edu_select'];
 $query = "INSERT INTO volunteer (VolunteerID, FirstName, MiddleName, LastName, MobileNumber, DateOfBirth, Gender, nationality, residence, Qualification) 
         VALUES ('".$VolunteerID."', '".$FirstName."', '".$MiddleName."', '".$LastName."', '".$MobileNumber."', '".$birthdate."', '".$gender."', '".$nationality."', '".$residence."', '".$qualification."' );";

        // Connect to MySQL
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
                <!--Footer of the page -->
                <div class="footer">
                    <footer>             
                        <?php include('includes/footer.php'); ?>
                    </footer>
                </div>
            </center>
            </center>
        </div>
    </body>

</html>
